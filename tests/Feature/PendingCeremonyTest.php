<?php

declare(strict_types=1);

use Happenv\FilamentPasskeys\Support\PendingCeremony;
use Illuminate\Contracts\Cache\LockTimeoutException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Sleep;

beforeEach(function (): void {
    // Lock waits are real sleeps otherwise; faked, the timeout elapses at once.
    Sleep::fake(syncWithCarbon: true);
});

it('hands the options out once', function (): void {
    PendingCeremony::put('ceremony', '{"challenge":"abc"}');

    expect(PendingCeremony::pull('ceremony'))->toBe('{"challenge":"abc"}')
        ->and(PendingCeremony::pull('ceremony'))->toBeNull();
});

it('gives an overlapping answer nothing while another one is consuming the options', function (): void {
    PendingCeremony::put('ceremony', '{"challenge":"abc"}');

    // The first answer holds the ceremony while it takes the options.
    $firstAnswer = Cache::lock(PendingCeremony::lockName('ceremony'), 10);
    expect($firstAnswer->get())->toBeTrue();

    expect(PendingCeremony::pull('ceremony'))->toBeNull();

    $firstAnswer->release();

    expect(PendingCeremony::pull('ceremony'))->toBe('{"challenge":"abc"}');
});

it('makes a new ceremony wait while another request is consuming the previous one', function (): void {
    PendingCeremony::put('ceremony', '{"challenge":"old"}');

    // An older answer holds the ceremony while it takes the old options.
    $olderAnswer = Cache::lock(PendingCeremony::lockName('ceremony'), 10);
    expect($olderAnswer->get())->toBeTrue();

    expect(fn () => PendingCeremony::put('ceremony', '{"challenge":"new"}'))->toThrow(LockTimeoutException::class)
        ->and(PendingCeremony::get('ceremony'))->toBe('{"challenge":"old"}');

    $olderAnswer->release();

    PendingCeremony::put('ceremony', '{"challenge":"new"}');

    expect(PendingCeremony::pull('ceremony'))->toBe('{"challenge":"new"}');
});

it('keeps options apart per session', function (): void {
    PendingCeremony::put('ceremony', '{"challenge":"mine"}');

    session()->setId(str_repeat('b', 40));

    expect(PendingCeremony::pull('ceremony'))->toBeNull();
});
