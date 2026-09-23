<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Redirect URL
    |--------------------------------------------------------------------------
    |
    | URL the user is redirected to after registering a passkey. When null,
    | the set-up modal closes and the user stays on their profile page.
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

    /*
    |--------------------------------------------------------------------------
    | Multi-factor Challenge
    |--------------------------------------------------------------------------
    |
    | When a passkey is the only multi-factor method a user has turned on, the
    | challenge consists of the "Verify with passkey" button alone:
    |
    | - hide_challenge_confirm_button hides Filament's "Confirm sign in"
    |   button, which a passkey ceremony never needs.
    | - auto_start_challenge starts the passkey prompt as soon as the challenge
    |   appears. Browsers that require a fresh user gesture for WebAuthn (e.g.
    |   Safari) may refuse it; the button stays available as a fallback.
    |
    | Users with more than one method enabled always get Filament's usual screen.
    |
    */

    'hide_challenge_confirm_button' => true,

    'auto_start_challenge' => false,
];
