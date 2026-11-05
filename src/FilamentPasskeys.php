<?php

declare(strict_types=1);

namespace Happenv\FilamentPasskeys;

use Closure;
use Happenv\FilamentPasskeys\Exceptions\TooManyRelatedOrigins;
use Illuminate\Http\Request;
use Laravel\Passkeys\Passkeys;

class FilamentPasskeys
{
    /**
     * Resolves the WebAuthn related origins of the current request. Set once
     * while the application boots, so it holds no per-request state.
     *
     * @var (Closure(Request): iterable<mixed>)|null
     */
    protected static ?Closure $relatedOriginsResolver = null;

    /**
     * Register a callback returning the origins, e.g. `https://shop.customer.com`,
     * that may use the relying party ID besides the RP ID's own origin. Without
     * one, `filament-passkeys.related_origins.origins` is used.
     *
     * @param  (Closure(Request): iterable<mixed>)|null  $resolver
     */
    public static function relatedOriginsUsing(?Closure $resolver): void
    {
        static::$relatedOriginsResolver = $resolver;
    }

    /**
     * The related origins for the request, normalised and without duplicates.
     * Entries that are not an https origin (or http on localhost) are dropped.
     *
     * @return list<string>
     */
    public static function relatedOrigins(Request $request): array
    {
        $resolved = (static::$relatedOriginsResolver instanceof Closure)
            ? (static::$relatedOriginsResolver)($request)
            : config('filament-passkeys.related_origins.origins', []);

        $origins = [];

        foreach ((is_iterable($resolved) ? $resolved : []) as $origin) {
            $origin = static::normalizeOrigin($origin);

            if ($origin !== null) {
                $origins[$origin] = $origin;
            }
        }

        return array_values($origins);
    }

    /**
     * The origins of the `/.well-known/webauthn` file: the related origins,
     * then the RP ID's own origin. Empty when there are no related origins.
     *
     * The RP origin comes last because browsers stop at a limited number of
     * registrable domain labels while reading the list, and a same-site caller
     * never needs it. Listed first, its label would use up a slot.
     *
     * @return list<string>
     *
     * @throws TooManyRelatedOrigins
     */
    public static function webauthnOrigins(Request $request): array
    {
        $relatedOrigins = static::relatedOrigins($request);

        if ($relatedOrigins === []) {
            return [];
        }

        static::assertWithinRelatedOriginsLimit($relatedOrigins);

        $relyingPartyOrigin = static::relyingPartyOrigin();

        $relatedOrigins = array_values(array_filter(
            $relatedOrigins,
            fn (string $origin): bool => $origin !== $relyingPartyOrigin,
        ));

        if ($relatedOrigins === []) {
            return [];
        }

        return [...$relatedOrigins, $relyingPartyOrigin];
    }

    /**
     * How many distinct hosts the related origins may span, from
     * `filament-passkeys.related_origins.max_origins` (at least 1).
     */
    public static function maxRelatedOrigins(): int
    {
        return max(1, (int) config('filament-passkeys.related_origins.max_origins', 5));
    }

    /**
     * Throw when the origins span more distinct hosts than the limit, e.g. to
     * validate a domain before saving it. Origins are normalised first; invalid
     * ones and those on the RP ID's own host are not counted.
     *
     * Browsers honour origins from a limited number of registrable domain labels
     * (WebAuthn L3 "maxLabels", at least 5) and ignore the rest. Without a Public
     * Suffix List, counting hosts is conservative: there are never fewer hosts
     * than labels.
     *
     * @param  iterable<mixed>  $origins
     *
     * @throws TooManyRelatedOrigins
     */
    public static function assertWithinRelatedOriginsLimit(iterable $origins): void
    {
        $relyingPartyHost = strtolower(Passkeys::relyingPartyId());
        $hosts = [];

        foreach ($origins as $origin) {
            $host = parse_url(static::normalizeOrigin($origin) ?? '', PHP_URL_HOST);

            if (is_string($host) && ($host !== $relyingPartyHost)) {
                $hosts[$host] = true;
            }
        }

        $limit = static::maxRelatedOrigins();

        if (count($hosts) > $limit) {
            throw new TooManyRelatedOrigins(count($hosts), $limit);
        }
    }

    /**
     * The origin of the relying party ID itself, e.g. `https://example.com`.
     */
    public static function relyingPartyOrigin(): string
    {
        return 'https://' . strtolower(Passkeys::relyingPartyId());
    }

    /**
     * Run a WebAuthn ceremony with the request's related origins added to the
     * `laravel/passkeys` allowed origins, so the server accepts exactly the
     * origins the `/.well-known/webauthn` file lists. The configured value is
     * restored afterwards, so nothing carries over to the next request.
     *
     * @template TResult
     *
     * @param  Closure(): TResult  $ceremony
     * @return TResult
     *
     * @throws TooManyRelatedOrigins
     */
    public static function withRelatedOrigins(Closure $ceremony, ?Request $request = null): mixed
    {
        $webauthnOrigins = static::webauthnOrigins($request ?? request());

        if ($webauthnOrigins === []) {
            return $ceremony();
        }

        $configuredOrigins = config('passkeys.allowed_origins');

        config()->set('passkeys.allowed_origins', array_values(array_unique([
            ...(is_array($configuredOrigins) ? array_values($configuredOrigins) : []),
            ...$webauthnOrigins,
        ])));

        try {
            return $ceremony();
        } finally {
            config()->set('passkeys.allowed_origins', $configuredOrigins);
        }
    }

    /**
     * Normalise an origin to `scheme://host[:port]`: lowercase, without the
     * default port or a trailing slash. Returns null for anything that is not an
     * https origin, or an http one on `localhost` (for local development).
     */
    public static function normalizeOrigin(mixed $origin): ?string
    {
        if (! is_string($origin)) {
            return null;
        }

        $parts = parse_url(trim($origin));

        if (($parts === false) || (! isset($parts['scheme'], $parts['host']))) {
            return null;
        }

        // An origin has no credentials, path, query or fragment.
        if (isset($parts['user']) || isset($parts['pass']) || isset($parts['query']) || isset($parts['fragment'])) {
            return null;
        }

        if (! in_array($parts['path'] ?? '', ['', '/'], true)) {
            return null;
        }

        $scheme = strtolower($parts['scheme']);
        $host = strtolower($parts['host']);

        if (filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) === false) {
            return null;
        }

        $isLocalhost = ($host === 'localhost') || str_ends_with($host, '.localhost');

        if (($scheme !== 'https') && (($scheme !== 'http') || (! $isLocalhost))) {
            return null;
        }

        $port = $parts['port'] ?? null;
        $defaultPort = ($scheme === 'https') ? 443 : 80;

        return "{$scheme}://{$host}" . ((($port !== null) && ($port !== $defaultPort)) ? ":{$port}" : '');
    }
}
