<?php

use Happenv\FilamentPasskeys\Support\PendingCeremony;
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
    $firstAnswer = PendingCeremony::lock('ceremony');
    expect($firstAnswer?->get())->toBeTrue();

    expect(PendingCeremony::pull('ceremony'))->toBeNull();

    $firstAnswer->release();

    expect(PendingCeremony::pull('ceremony'))->toBe('{"challenge":"abc"}');
});

it('keeps options apart per session', function (): void {
    PendingCeremony::put('ceremony', '{"challenge":"mine"}');

    session()->setId(str_repeat('b', 40));

    expect(PendingCeremony::pull('ceremony'))->toBeNull();
});
