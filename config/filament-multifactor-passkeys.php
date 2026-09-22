<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Redirect URL
    |--------------------------------------------------------------------------
    |
    | URL the user is redirected to after registering a passkey.
    | When null, the package falls back to Filament::getCurrentPanel()->getUrl().
    |
    */

    'redirect' => null,

    /*
    |--------------------------------------------------------------------------
    | laravel/passkeys Routes
    |--------------------------------------------------------------------------
    |
    | This package drives every passkey ceremony through Livewire and never
    | calls the HTTP routes that laravel/passkeys registers. They stay off
    | unless you enable them here, e.g. to use the @laravel/passkeys client
    | elsewhere in your application.
    |
    */

    'register_passkeys_routes' => false,
];
