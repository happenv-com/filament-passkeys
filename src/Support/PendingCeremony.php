<?php

namespace Happenv\FilamentPasskeys\Support;

use Closure;
use Illuminate\Contracts\Cache\Lock;
use Illuminate\Contracts\Cache\LockProvider;
use Illuminate\Contracts\Cache\LockTimeoutException;
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
 * Storing and consuming go through one cache lock per ceremony, so two overlapping answers
 * cannot both take the same options and an older answer cannot delete options stored after it
 * read them (`Cache::pull()` alone is a separate get and forget). Without a lock-capable store
 * they run unguarded, as Filament's own providers do.
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

    /**
     * Seconds a lock is held at most; storing or consuming takes milliseconds.
     */
    private const LOCK_SECONDS = 10;

    /**
     * Seconds to wait for the lock before giving up on the ceremony.
     */
    private const LOCK_WAIT_SECONDS = 5;

    /**
     * @throws LockTimeoutException when another request holds the ceremony for too long
     */
    public static function put(string $key, string $serializedOptions): void
    {
        self::exclusively($key, static fn (): bool => Cache::put(self::cacheKey($key), $serializedOptions, self::ttl()));
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
     * While another request holds the ceremony (an overlapping answer consuming the same options)
     * there is nothing for this one to take, so it gets none.
     */
    public static function pull(string $key): ?string
    {
        try {
            $options = self::exclusively($key, static fn (): mixed => Cache::pull(self::cacheKey($key)));
        } catch (LockTimeoutException) {
            return null;
        }

        return is_string($options) ? $options : null;
    }

    public static function forget(string $key): void
    {
        Cache::forget(self::cacheKey($key));
    }

    /**
     * @template TResult
     *
     * @param  Closure(): TResult  $callback
     * @return TResult
     */
    private static function exclusively(string $key, Closure $callback): mixed
    {
        $lock = self::lock($key);

        if (! $lock instanceof Lock) {
            return $callback();
        }

        return $lock->block(self::LOCK_WAIT_SECONDS, $callback);
    }

    /**
     * The lock that serializes storing and consuming this ceremony's options, or null when the
     * cache store cannot lock.
     */
    public static function lock(string $key): ?Lock
    {
        $store = Cache::getStore();

        return $store instanceof LockProvider
            ? $store->lock(self::cacheKey($key) . ':lock', self::LOCK_SECONDS)
            : null;
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
