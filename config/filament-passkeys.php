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

    'auto_start_challenge' => true,

    /*
    |--------------------------------------------------------------------------
    | Related Origins
    |--------------------------------------------------------------------------
    |
    | WebAuthn Related Origin Requests let pages on other domains (e.g.
    | customer domains) use the relying party ID. The related origins come
    | from FilamentPasskeys::relatedOriginsUsing() or, without a resolver,
    | from `origins` below (e.g. ['https://shop.customer.com']). The same
    | list is added to the laravel/passkeys allowed origins while a ceremony
    | is verified, whether or not the route below is enabled.
    |
    | - enabled registers GET /.well-known/webauthn (route name
    |   `filament-passkeys.related-origins`), listing the RP ID's own origin
    |   and the related ones. It answers 404 when there are none.
    | - middleware is the route's whole middleware stack. It never runs in
    |   the `web` group, so it sets no cookies; add e.g. 'throttle:60,1'.
    | - cache_max_age is the Cache-Control max-age, in seconds.
    | - max_origins caps how many distinct hosts the related origins may span
    |   (the RP ID's own host not counted). Browsers may honour as few as 5
    |   registrable domain labels and silently ignore the rest, so a longer
    |   list throws TooManyRelatedOrigins instead of being truncated.
    |
    */

    'related_origins' => [
        'enabled' => false,

        'origins' => [],

        'middleware' => [],

        'cache_max_age' => 300,

        'max_origins' => 5,
    ],
];
