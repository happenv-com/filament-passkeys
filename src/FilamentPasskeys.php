<?php

declare(strict_types=1);

namespace Happenv\FilamentPasskeys;

use Closure;
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
     * The origins of the `/.well-known/webauthn` file: the RP ID's own origin
     * first, then the related origins. Empty when there are no related origins.
     *
     * @return list<string>
     */
    public static function webauthnOrigins(Request $request): array
    {
        $relatedOrigins = static::relatedOrigins($request);

        if ($relatedOrigins === []) {
            return [];
        }

        $relyingPartyOrigin = static::relyingPartyOrigin();

        $relatedOrigins = array_values(array_filter(
            $relatedOrigins,
            fn (string $origin): bool => $origin !== $relyingPartyOrigin,
        ));

        if ($relatedOrigins === []) {
            return [];
        }

        return [$relyingPartyOrigin, ...$relatedOrigins];
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
