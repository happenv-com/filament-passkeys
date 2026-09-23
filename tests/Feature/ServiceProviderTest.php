<?php

it('publishes config file', function () {
    $config = config('filament-passkeys');

    expect($config)
        ->toBeArray()
        ->toHaveKey('redirect');
});

it('has null as default redirect', function () {
    expect(config('filament-passkeys.redirect'))->toBeNull();
});

it('loads translations', function () {
    $translation = __('filament-passkeys::provider.login_form.label');

    expect($translation)
        ->toBeString()
        ->not->toBe('filament-passkeys::provider.login_form.label');
});

it('keeps the laravel/passkeys routes off by default', function () {
    expect(config('filament-passkeys.register_passkeys_routes'))->toBeFalse()
        ->and(Route::has('passkey.login'))->toBeFalse()
        ->and(Route::has('passkey.store'))->toBeFalse();
});
