# Filament Multifactor Passkeys

[![Latest Version on Packagist](https://img.shields.io/packagist/v/happenv-com/filament-multifactor-passkeys.svg?style=flat-square)](https://packagist.org/packages/happenv-com/filament-multifactor-passkeys)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/happenv-com/filament-multifactor-passkeys/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/happenv-com/filament-multifactor-passkeys/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/happenv-com/filament-multifactor-passkeys.svg?style=flat-square)](https://packagist.org/packages/happenv-com/filament-multifactor-passkeys)
[![License](https://img.shields.io/github/license/happenv-com/filament-multifactor-passkeys.svg?style=flat-square)](LICENSE.md)

Multi-factor authentication for Filament panels using WebAuthn passkeys, powered by [`laravel/passkeys`](https://github.com/laravel/passkeys-server).

This package is a fork of [`jeffersongoncalves/filament-multifactor-passkeys`](https://github.com/jeffersongoncalves/filament-multifactor-passkeys), moved from `spatie/laravel-passkeys` to `laravel/passkeys`.

## Compatibility

| Filament | Laravel | PHP  |
|----------|---------|------|
| v5       | 12 / 13 | ^8.2 |

## Installation

Install the package via composer:

```bash
composer require happenv-com/filament-multifactor-passkeys
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
php artisan vendor:publish --tag="filament-multifactor-passkeys-config"
```

> `laravel/passkeys` derives the relying party ID and the allowed origins from `APP_URL`. Make sure it matches the URL your panel is served from, or passkey ceremonies will be rejected.

### Upgrading from `spatie/laravel-passkeys`

Both packages use a `passkeys` table and a `config/passkeys.php` file, so they cannot be installed side by side. Existing passkeys keep working after the switch; publish and run this package's upgrade migration **instead of** the `laravel/passkeys` one:

```bash
composer remove spatie/laravel-passkeys
php artisan vendor:publish --tag="filament-multifactor-passkeys-migrations"
php artisan migrate
```

The migration renames `authenticatable_id` to `user_id` and `data` to `credential`, and rebuilds `credential_id` from the stored credential record. It does nothing when the table already has the `laravel/passkeys` schema. Remove the old `config/passkeys.php` published by Spatie and publish the new one if you need to customise it.

## Usage

### 1. Prepare your User model

Implement the `HasPasskeysAuthentication` contract and use the `InteractsWithPasskeysAuthentication` trait. They build on the `laravel/passkeys` `PasskeyUser` contract and `PasskeyAuthenticatable` trait:

```php
use Filament\Models\Contracts\FilamentUser;
use Happenv\FilamentMultiFactorPasskeys\Concerns\InteractsWithPasskeysAuthentication;
use Happenv\FilamentMultiFactorPasskeys\Contracts\HasPasskeysAuthentication;
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

In your `PanelProvider`, register `PasskeyAuthentication` in the `multiFactorAuthentication()` array. To also expose a "Sign in with a passkey" button on the login screen, register the plugin as well:

```php
use Filament\Panel;
use Happenv\FilamentMultiFactorPasskeys\MultiFactorPasskeysPlugin;
use Happenv\FilamentMultiFactorPasskeys\PasskeyAuthentication;

public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->multiFactorAuthentication([
            PasskeyAuthentication::make(),
        ])
        ->plugin(MultiFactorPasskeysPlugin::make());
}
```

That's it. The MFA section in the user profile page now shows a "Passkey verification" entry with **Set up** / **Turn off** buttons. After a user signs in with their password, Filament asks them to confirm with one of their passkeys. The plugin also injects a passkey login button after the standard login form, allowing users to authenticate without typing email/password.

### 3. Customising the redirect URL

By default, after registering a passkey the set-up modal closes and the user stays on their profile page. To redirect them somewhere instead:

```php
PasskeyAuthentication::make()
    ->redirectUrlUsing(fn () => route('dashboard'));
```

You can also set a static URL via `config/filament-multifactor-passkeys.php`:

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

### 5. `laravel/passkeys` routes

Every ceremony runs through Livewire, so this package does not need the HTTP routes `laravel/passkeys` registers and turns them off. To keep them, e.g. for the `@laravel/passkeys` JavaScript client elsewhere in your app, set `register_passkeys_routes` to `true` in `config/filament-multifactor-passkeys.php`.

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
