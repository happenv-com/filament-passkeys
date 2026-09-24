# Filament Passkeys

[![Latest Version](https://img.shields.io/github/v/release/happenv-com/filament-passkeys?style=flat-square&label=version)](https://github.com/happenv-com/filament-passkeys/releases)
[![Tests](https://img.shields.io/github/actions/workflow/status/happenv-com/filament-passkeys/tests.yml?label=tests&style=flat-square)](https://github.com/happenv-com/filament-passkeys/actions/workflows/tests.yml)
[![PHPStan](https://img.shields.io/github/actions/workflow/status/happenv-com/filament-passkeys/phpstan.yml?label=phpstan&style=flat-square)](https://github.com/happenv-com/filament-passkeys/actions/workflows/phpstan.yml)
[![Quality](https://img.shields.io/github/actions/workflow/status/happenv-com/filament-passkeys/quality.yml?label=code%20quality&style=flat-square)](https://github.com/happenv-com/filament-passkeys/actions/workflows/quality.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/happenv-com/filament-passkeys.svg?style=flat-square)](https://packagist.org/packages/happenv-com/filament-passkeys)
[![License](https://img.shields.io/github/license/happenv-com/filament-passkeys.svg?style=flat-square)](LICENSE.md)

Multi-factor authentication for Filament panels using WebAuthn passkeys, powered by [`laravel/passkeys`](https://github.com/laravel/passkeys-server).

```php
use Happenv\FilamentPasskeys\FilamentPasskeysPlugin;
use Happenv\FilamentPasskeys\PasskeyAuthentication;

$panel
    ->multiFactorAuthentication([
        PasskeyAuthentication::make(),
    ])
    // Optional: a "Sign in with a passkey" button on the login page.
    ->plugin(FilamentPasskeysPlugin::make());
```

## Key features

- **Passkeys as a second factor.** A native Filament multi-factor provider: after the password step, users confirm with one of their passkeys. It sits alongside Filament's app and email code providers, and users choose between the methods they have turned on.
- **Passwordless sign-in on the login page.** An optional "Sign in with a passkey" button under the login form signs users in with a discoverable credential, no email or password needed.
- **A passkey for every device.** Users can register as many passkeys as they need (Windows Hello, an Android phone, iCloud Keychain, a security key) and remove any one of them from a table on their Filament profile page. Each row shows which authenticator holds the passkey and when it was last used.
- **A streamlined passkey-only challenge.** When a passkey is a user's only method, the prompt opens as soon as the challenge appears and Filament's redundant "Confirm sign in" button is hidden. Both are on by default and can be turned off.
- **Secure by default.** Challenges are single use and bound to the user who passed the password step, so a replayed assertion or someone else's passkey is rejected. Passwordless sign-in honours `laravel/passkeys` login authorization and `FilamentUser::canAccessPanel()`.
- **Built on `laravel/passkeys`.** Its actions handle challenge generation, verification and storage, and every ceremony runs through Livewire, so no extra routes are exposed.
- **Testing helpers.** Livewire assertions check whether signing in stops at the multi-factor challenge and whether that challenge offers a passkey.
- **Upgrade path from `spatie/laravel-passkeys`.** A migration converts existing passkeys to the `laravel/passkeys` schema.
- **Translated** into [every language Filament supports](#supported-languages) (64 locales).
- **Tested.** A Pest suite runs real WebAuthn ceremonies against a virtual authenticator on every supported PHP, Laravel and Filament combination.

## Requirements

| Package            | Versions                                  |
|--------------------|-------------------------------------------|
| PHP                | ^8.2 (CI runs 8.3 – 8.5)                  |
| Laravel            | 12, 13                                    |
| Filament           | 4 (`^4.13.3`), 5 (`^5.8`)                 |
| `laravel/passkeys` | `^0.2.1`                                  |

## Installation

Install the package via Composer:

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

> `laravel/passkeys` derives the relying party ID and the allowed origins from `APP_URL`. Make sure it matches the URL your panel is served from, or passkey ceremonies will be rejected.

### Upgrading from `spatie/laravel-passkeys`

Both packages use a `passkeys` table and a `config/passkeys.php` file, so they cannot be installed side by side. Existing passkeys keep working after the switch; publish and run this package's upgrade migration **instead of** the `laravel/passkeys` one:

```bash
composer remove spatie/laravel-passkeys
php artisan vendor:publish --tag="filament-passkeys-migrations"
php artisan migrate
```

The migration renames `authenticatable_id` to `user_id` and `data` to `credential`, and rebuilds `credential_id` from the stored credential record. It does nothing when the table already has the `laravel/passkeys` schema. Remove the old `config/passkeys.php` published by Spatie and publish the new one if you need to customise it.

## Configuration

Publish this package's config (optional):

```bash
php artisan vendor:publish --tag="filament-passkeys-config"
```

| Option                          | Default | What it does                                                                                             |
|---------------------------------|---------|----------------------------------------------------------------------------------------------------------|
| `redirect`                      | `null`  | Where to send the user after registering a passkey — see [Customising the redirect URL](#3-customising-the-redirect-url). |
| `register_passkeys_routes`      | `false` | Keeps the `laravel/passkeys` HTTP routes — see [`laravel/passkeys` routes](#6-laravelpasskeys-routes).   |
| `hide_challenge_confirm_button` | `true`  | Hides Filament's "Confirm sign in" button on a passkey-only challenge — see [Passkey-only challenge](#5-passkey-only-challenge). |
| `auto_start_challenge`          | `true`  | Opens the passkey prompt as soon as a passkey-only challenge appears — see [Passkey-only challenge](#5-passkey-only-challenge). |

Optionally, publish the views and translations:

```bash
php artisan vendor:publish --tag="filament-passkeys-views"
php artisan vendor:publish --tag="filament-passkeys-translations"
```

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

That's it. The MFA section in the user profile page now shows a "Passkey verification" entry with **Set up** / **Turn off** buttons. Once a passkey is registered, **Set up** becomes **Add passkey** and a table lists every passkey with a **Remove** button. After a user signs in with their password, Filament asks them to confirm with one of their passkeys.

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

## How it works

This package is a Filament adapter on top of `laravel/passkeys`. Challenge generation, attestation and assertion verification and persistence are handled by its actions; the browser side uses `@simplewebauthn/browser`.

- **Set up** / **Add passkey** is a regular Filament action with an optional name field. Submitting it runs `GenerateRegistrationOptions` and hands the options to the browser, which completes the ceremony and submits the form again so the action can store the passkey with `StorePasskey`. The options exclude the user's existing passkeys, so the same authenticator cannot be registered twice. A passkey saved without a name is named after its authenticator, looked up by AAGUID (e.g. "Windows Hello", "Google Password Manager").
- **Remove** deletes a single passkey through `DeletePasskey`. Removing the last one turns passkey verification off, and its confirmation says so.
- **Turn off** deletes each of the user's passkeys through `DeletePasskey`, so a `PasskeyDeleted` event fires for every one.
- **Login challenge** is a regular field of Filament's MFA challenge form. Its button generates options scoped to the user who passed the password step, and the field's validation rule checks the assertion with `VerifyPasskey` for that same user, so a passkey belonging to anyone else is rejected.
- **Sign in with a passkey** runs a discoverable-credential ceremony and logs the owner in on the panel's guard.

## Testing your application

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

## Translations

### Supported languages

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

`tests/Unit/TranslationsTest.php` checks that every locale has exactly the keys English has.

## Development

```bash
composer test          # unit and feature tests
composer phpstan       # static analysis
composer cs            # fix code style: composer normalize, Rector, Pint
composer ci            # everything CI checks, locally
```

The package's JavaScript and CSS are built by `bin/build.js` into `resources/dist`, which is committed. After changing `resources/js` or `resources/css`, rebuild and commit the result — CI refuses outdated assets:

```bash
npm ci
npm run build   # or `npm run dev` to rebuild on change
npm run lint    # Prettier check, as in CI
```

## Upgrading

Breaking changes and how to migrate are described in [UPGRADING](UPGRADING.md) for every major version.

## Changelog

See [CHANGELOG](CHANGELOG.md) and [GitHub releases](https://github.com/happenv-com/filament-passkeys/releases) for what has changed recently.

## Contributing

See [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Happenv sp. z o.o.](https://happenv.com)
- [webard](https://github.com/webard)
- [Jefferson Gonçalves](https://github.com/jeffersongoncalves) — original author of [filament-multifactor-passkeys](https://github.com/jeffersongoncalves/filament-multifactor-passkeys)
- [Laravel](https://github.com/laravel/passkeys-server) — for the underlying WebAuthn implementation
- [All contributors](../../contributors)

## License

The MIT License (MIT). See [License File](LICENSE.md) for more information.

---

<p align="center">
    <a href="https://happenv.com">
        <img src="art/happenv-logo.png" alt="Happenv" width="400">
    </a>
</p>
