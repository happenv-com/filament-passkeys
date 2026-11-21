<?php

namespace Happenv\FilamentPasskeys\Support;

use Illuminate\Support\Facades\Cache;

/**
 * The options of a passkey ceremony between its two requests: generated when the ceremony
 * starts, read back when the browser answers.
 *
 * They live in the cache, keyed by the session ID, and not in the session itself. Laravel
 * writes the WHOLE session at the end of every request, so any request that overlaps the
 * ceremony and was read before it started (a polling widget, a second tab) writes back a
 * session without the options, and the browser's answer then finds nothing to check against.
 * With the cookie session driver the browser additionally keeps whichever response arrived
 * last. The session ID stays the same for the whole ceremony, whatever is written to the
 * session meanwhile.
 *
 * The cache must be shared by every server, which Filament's own multi-factor providers
 * already require.
 */
final class PendingCeremony
{
    /**
     * Seconds the options outlive the WebAuthn timeout, for a user who is slow to answer.
     */
    private const GRACE_SECONDS = 300;

    public static function put(string $key, string $serializedOptions): void
    {
        Cache::put(self::cacheKey($key), $serializedOptions, self::ttl());
    }

    public static function get(string $key): ?string
    {
        $options = Cache::get(self::cacheKey($key));

        return is_string($options) ? $options : null;
    }

    public static function has(string $key): bool
    {
        return self::get($key) !== null;
    }

    /**
     * Read the options and forget them: they are single use, whether the ceremony succeeds or not.
     */
    public static function pull(string $key): ?string
    {
        $options = Cache::pull(self::cacheKey($key));

        return is_string($options) ? $options : null;
    }

    public static function forget(string $key): void
    {
        Cache::forget(self::cacheKey($key));
    }

    private static function cacheKey(string $key): string
    {
        return $key . ':' . hash('sha256', session()->getId());
    }

    private static function ttl(): int
    {
        $timeoutMilliseconds = config('passkeys.timeout', 60000);

        return (int) ceil((is_numeric($timeoutMilliseconds) ? (int) $timeoutMilliseconds : 60000) / 1000) + self::GRACE_SECONDS;
    }
}
