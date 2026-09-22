<?php

it('publishes config file', function () {
    $config = config('filament-multifactor-passkeys');

    expect($config)
        ->toBeArray()
        ->toHaveKey('redirect');
});

it('has null as default redirect', function () {
    expect(config('filament-multifactor-passkeys.redirect'))->toBeNull();
});

it('loads translations', function () {
    $translation = __('filament-multifactor-passkeys::provider.login_form.label');

    expect($translation)
        ->toBeString()
        ->not->toBe('filament-multifactor-passkeys::provider.login_form.label');
});

it('keeps the laravel/passkeys routes off by default', function () {
    expect(config('filament-multifactor-passkeys.register_passkeys_routes'))->toBeFalse()
        ->and(Route::has('passkey.login'))->toBeFalse()
        ->and(Route::has('passkey.store'))->toBeFalse();
});
