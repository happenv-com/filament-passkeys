# Filament Passkeys

[![Latest Version on Packagist](https://img.shields.io/packagist/v/happenv-com/filament-passkeys.svg?style=flat-square)](https://packagist.org/packages/happenv-com/filament-passkeys)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/happenv-com/filament-passkeys/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/happenv-com/filament-passkeys/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/happenv-com/filament-passkeys.svg?style=flat-square)](https://packagist.org/packages/happenv-com/filament-passkeys)
[![License](https://img.shields.io/github/license/happenv-com/filament-passkeys.svg?style=flat-square)](LICENSE.md)

Multi-factor authentication for Filament panels using WebAuthn passkeys, powered by [`laravel/passkeys`](https://github.com/laravel/passkeys-server).

This package is a fork of [`jeffersongoncalves/filament-multifactor-passkeys`](https://github.com/jeffersongoncalves/filament-multifactor-passkeys), moved from `spatie/laravel-passkeys` to `laravel/passkeys`.

## Key features

- **Passkeys as a second factor.** A native Filament multi-factor provider: after the password step, users confirm with one of their passkeys. It sits alongside Filament's app and email code providers, and users choose between the methods they have turned on.
- **Passwordless sign-in on the login page.** An optional "Sign in with a passkey" button under the login form signs users in with a discoverable credential, no email or password needed.
- **Self-service management.** Users set up and turn off passkeys from the multi-factor section of their Filament profile page.
- **A streamlined passkey-only challenge.** When a passkey is a user's only method, the prompt opens as soon as the challenge appears and Filament's redundant "Confirm sign in" button is hidden. Both are on by default and can be turned off.
- **Secure by default.** Challenges are single use and bound to the user who passed the password step, so a replayed assertion or someone else's passkey is rejected. Passwordless sign-in honours `laravel/passkeys` login authorization and `FilamentUser::canAccessPanel()`.
- **Built on `laravel/passkeys`.** Its actions handle challenge generation, verification and storage, and every ceremony runs through Livewire, so no extra routes are exposed.
- **Testing helpers.** Livewire assertions check whether signing in stops at the multi-factor challenge and whether that challenge offers a passkey.
- **Upgrade path from `spatie/laravel-passkeys`.** A migration converts existing passkeys to the `laravel/passkeys` schema.
- **Translated** into [every language Filament supports](#supported-languages) (64 locales).

## Compatibility

| Filament | Laravel | PHP  |
|----------|---------|------|
| v5       | 12 / 13 | ^8.2 |

## Installation

Install the package via composer:

```bash
composer require happenv-com/filament-passkeys
```

Publish and run the migrations from `laravel/passkeys`:

```bash
php artisan vendor:publish --tag="passkeys-migrations"
php artisan migrate
```

Publish the `laravel/passkeys` config (optional, to tweak the relying party ID, allowed origins, timeout, etc.):

```bash
php artisan vendor:publish --tag="passkeys-config"
```

Publish this package's config (optional):

```bash
php artisan vendor:publish --tag="filament-passkeys-config"
```

> `laravel/passkeys` derives the relying party ID and the allowed origins from `APP_URL`. Make sure it matches the URL your panel is served from, or passkey ceremonies will be rejected.

### Upgrading from `spatie/laravel-passkeys`

Both packages use a `passkeys` table and a `config/passkeys.php` file, so they cannot be installed side by side. Existing passkeys keep working after the switch; publish and run this package's upgrade migration **instead of** the `laravel/passkeys` one:

```bash
composer remove spatie/laravel-passkeys
php artisan vendor:publish --tag="filament-passkeys-migrations"
php artisan migrate
```

The migration renames `authenticatable_id` to `user_id` and `data` to `credential`, and rebuilds `credential_id` from the stored credential record. It does nothing when the table already has the `laravel/passkeys` schema. Remove the old `config/passkeys.php` published by Spatie and publish the new one if you need to customise it.

## Usage

### 1. Prepare your User model

Implement the `HasPasskeysAuthentication` contract and use the `InteractsWithPasskeysAuthentication` trait. They build on the `laravel/passkeys` `PasskeyUser` contract and `PasskeyAuthenticatable` trait:

```php
use Filament\Models\Contracts\FilamentUser;
use Happenv\FilamentPasskeys\Concerns\InteractsWithPasskeysAuthentication;
use Happenv\FilamentPasskeys\Contracts\HasPasskeysAuthentication;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasPasskeysAuthentication
{
    use InteractsWithPasskeysAuthentication;

    // ...
}
```

Passkey verification counts as enabled when `hasPasskeysEnabled()` returns `true`, which by default means the user has at least one passkey. If your user model is not `App\Models\User`, tell `laravel/passkeys` about it in a service provider:

```php
use Laravel\Passkeys\Passkeys;

Passkeys::useUserModel(\App\Models\Admin::class);
```

### 2. Register the MFA provider in your panel

In your `PanelProvider`, register `PasskeyAuthentication` in the `multiFactorAuthentication()` array:

```php
use Filament\Panel;
use Happenv\FilamentPasskeys\FilamentPasskeysPlugin;
use Happenv\FilamentPasskeys\PasskeyAuthentication;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->multiFactorAuthentication([
            PasskeyAuthentication::make(),
        ])
        // Optional: adds a "Sign in with a passkey" button to the login page.
        ->plugin(FilamentPasskeysPlugin::make());
}
```

That's it. The MFA section in the user profile page now shows a "Passkey verification" entry with **Set up** / **Turn off** buttons. After a user signs in with their password, Filament asks them to confirm with one of their passkeys.

Registering `FilamentPasskeysPlugin` is **optional**. Passkeys work as a second factor without it. The plugin only adds a "Sign in with a passkey" button directly on the login page, below the standard form, so users can sign in with a passkey without typing their email and password. Leave it out if you only want passkeys as a second factor.

### 3. Customising the redirect URL

By default, after registering a passkey the set-up modal closes and the user stays on their profile page. To redirect them somewhere instead:

```php
PasskeyAuthentication::make()
    ->redirectUrlUsing(fn () => route('dashboard'));
```

You can also set a static URL via `config/filament-passkeys.php`:

```php
return [
    'redirect' => '/dashboard',
];
```

### 4. Blocking passkey sign-in

The passwordless login button honours the `laravel/passkeys` authorization callback, e.g. to keep suspended accounts out:

```php
use Illuminate\Validation\ValidationException;
use Laravel\Passkeys\Passkeys;

Passkeys::authorizeLoginUsing(function ($request, $user, $passkey): bool {
    if ($user->is_suspended) {
        throw ValidationException::withMessages(['credential' => ['This account is suspended.']]);
    }

    return true;
});
```

Users who fail `FilamentUser::canAccessPanel()` are never signed in.

### 5. Passkey-only challenge

When a passkey is the only multi-factor method a user has turned on, the challenge needs nothing but the "Verify with passkey" button, since the ceremony submits the form itself. By default, the passkey prompt opens as soon as the challenge appears and Filament's "Confirm sign in" button is hidden. Two options in `config/filament-passkeys.php` turn this off:

```php
return [
    // Hide Filament's "Confirm sign in" button (default: true).
    'hide_challenge_confirm_button' => true,

    // Open the passkey prompt as soon as the challenge appears (default: true).
    'auto_start_challenge' => true,
];
```

Users with more than one method enabled always get Filament's usual challenge. Some browsers, notably Safari, only allow WebAuthn right after a user gesture and may refuse the automatic prompt; the button stays available as a fallback.

### 6. `laravel/passkeys` routes

Every ceremony runs through Livewire, so this package does not need the HTTP routes `laravel/passkeys` registers and turns them off. To keep them, e.g. for the `@laravel/passkeys` JavaScript client elsewhere in your app, set `register_passkeys_routes` to `true` in `config/filament-passkeys.php`.

### 7. Testing

The package adds assertions to Livewire's `Testable` for Filament's login page, so your own tests can check that multi-factor authentication is enforced:

```php
use Filament\Auth\Pages\Login;
use Livewire\Livewire;

Livewire::test(Login::class)
    ->fillForm(['email' => $user->email, 'password' => 'password'])
    ->call('authenticate')
    ->assertMultiFactorChallengeRequired()
    ->assertPasskeyChallengeOffered();
```

| Assertion | Passes when |
|-----------|-------------|
| `assertMultiFactorChallengeRequired()` | Signing in stopped at the multi-factor challenge. |
| `assertMultiFactorChallengeNotRequired()` | No multi-factor challenge is shown. |
| `assertPasskeyChallengeOffered()` | The challenge is shown and offers a passkey, alone or next to other methods. |
| `assertPasskeyChallengeNotOffered()` | No challenge is shown, or the challenge offers no passkey. |

## How it works

This package is a Filament adapter on top of `laravel/passkeys`. Challenge generation, attestation and assertion verification and persistence are handled by its actions; the browser side uses `@simplewebauthn/browser`.

- **Set up** is a regular Filament action with a name field. Submitting it runs `GenerateRegistrationOptions` and hands the options to the browser, which completes the ceremony and submits the form again so the action can store the passkey with `StorePasskey`.
- **Turn off** deletes each of the user's passkeys through `DeletePasskey`, so a `PasskeyDeleted` event fires for every one.
- **Login challenge** is a regular field of Filament's MFA challenge form. Its button generates options scoped to the user who passed the password step, and the field's validation rule checks the assertion with `VerifyPasskey` for that same user, so a passkey belonging to anyone else is rejected.
- **Sign in with a passkey** runs a discoverable-credential ceremony and logs the owner in on the panel's guard.

## Development

```bash
# Static analysis
composer analyse

# Code style
composer format

# Tests
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Happenv](https://github.com/happenv-com)
- [Jefferson Gonçalves](https://github.com/jeffersongoncalves) — original author
- [Laravel](https://github.com/laravel/passkeys-server) — for the underlying WebAuthn implementation
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Supported languages

The package ships translations for every locale Filament supports. Publish them with `php artisan vendor:publish --tag="filament-passkeys-translations"` to adjust any wording.

| | | | |
|---|---|---|---|
| Amharic (`am`) | Persian (`fa`) | Lithuanian (`lt`) | Slovenian (`sl`) |
| Arabic (`ar`) | Finnish (`fi`) | Mizo (`lus`) | Albanian (`sq`) |
| Azerbaijani (`az`) | Filipino (`fil`) | Latvian (`lv`) | Serbian (Cyrillic) (`sr_Cyrl`) |
| Bulgarian (`bg`) | French (`fr`) | Macedonian (`mk`) | Serbian (Latin) (`sr_Latn`) |
| Bengali (`bn`) | Hebrew (`he`) | Mongolian (`mn`) | Swedish (`sv`) |
| Bosnian (`bs`) | Hindi (`hi`) | Malay (`ms`) | Swahili (`sw`) |
| Catalan (`ca`) | Croatian (`hr`) | Burmese (`my`) | Tajik (`tg`) |
| Central Kurdish (`ckb`) | Hungarian (`hu`) | Norwegian Bokmål (`nb`) | Thai (`th`) |
| Czech (`cs`) | Armenian (`hy`) | Nepali (`ne`) | Turkish (`tr`) |
| Danish (`da`) | Indonesian (`id`) | Dutch (`nl`) | Ukrainian (`uk`) |
| German (`de`) | Italian (`it`) | Polish (`pl`) | Urdu (`ur`) |
| Greek (`el`) | Japanese (`ja`) | Portuguese (`pt`) | Uzbek (`uz`) |
| English (`en`) | Georgian (`ka`) | Portuguese (Brazil) (`pt_BR`) | Vietnamese (`vi`) |
| Spanish (`es`) | Khmer (`km`) | Romanian (`ro`) | Chinese (Simplified) (`zh_CN`) |
| Estonian (`et`) | Korean (`ko`) | Russian (`ru`) | Chinese (Hong Kong) (`zh_HK`) |
| Basque (`eu`) | Kurdish (`ku`) | Slovak (`sk`) | Chinese (Traditional) (`zh_TW`) |
