# Changelog

All notable changes to `filament-multifactor-passkeys` will be documented in this file.

## Unreleased

### Breaking

- Forked as `happenv-com/filament-multifactor-passkeys` under the `Happenv\FilamentMultiFactorPasskeys` namespace. Filament assets are now published under `happenv-com/filament-multifactor-passkeys`; run `php artisan filament:assets` after upgrading.
- Replaced `spatie/laravel-passkeys` with [`laravel/passkeys`](https://github.com/laravel/passkeys-server) (`^0.2`).
- The user model now implements `Happenv\FilamentMultiFactorPasskeys\Contracts\HasPasskeysAuthentication` (extends `Laravel\Passkeys\Contracts\PasskeyUser`) and uses the `Happenv\FilamentMultiFactorPasskeys\Concerns\InteractsWithPasskeysAuthentication` trait. The `HasPasskeyAuthentication` contract and its `hasPasskeyAuthentication()` method are gone; the provider uses `hasPasskeysEnabled()`.
- The `passkeys` table uses the `laravel/passkeys` schema. Existing installs publish and run the `filament-multifactor-passkeys-migrations` upgrade migration.
- The `laravel/passkeys` HTTP routes are off by default (`register_passkeys_routes` config option).

### Security

- The MFA challenge now verifies the assertion inside Filament's challenge form, bound to the user who passed the password step. Previously it embedded Spatie's `<x-authenticate-passkey>`, which signed in the owner of any valid passkey through a separate route.
- The passwordless login button checks `FilamentUser::canAccessPanel()`, honours `Passkeys::authorizeLoginUsing()`, is rate limited, and no longer accepts a guard name from the client.

### Changed

- Removing passkeys dispatches `PasskeyDeleted` for each one.
- The `redirect` config value is now used when no `redirectUrlUsing()` callback is set.

## 2.0.1 - 2026-08-17

Fix duplicate WebAuthn listener registration when `@script` is evaluated more than once for the same component, which caused the in-flight authentication/registration ceremony to be aborted (#4).

## 2.0.0 - 2026-05-04

### Filament Multifactor Passkeys 2.0.0 — Filament v5

First public release of the Filament v5 line, tracking the 2.x branch.

#### Highlights

- Multi-factor authentication for Filament panels using **WebAuthn passkeys**, powered by [`spatie/laravel-passkeys`](https://spatie.be/docs/laravel-passkeys).
- New `PasskeyAuthentication` MFA provider — registers under `->multiFactorAuthentication([...])` and adds a **Passkey verification** entry (Set up / Turn off) to the user profile page.
- `MultiFactorPasskeysPlugin` injects a **Sign in with a passkey** button on the login screen via a Livewire `AuthenticatePasskey` component (state persisted on a Locked Livewire property).
- Auto-registers Spatie's `Route::passkeys()` macro under the `web` middleware group when not already declared.
- Sends a Filament notification on successful passkey login.
- Configurable post-auth redirect via `redirectUrlUsing(...)` or `config/filament-multifactor-passkeys.php`.
- Compiled assets are minified by default.
- `esbuild` dev dependency pinned to `^0.25.0` (clears GHSA-67mh-4wv8-2f99).

#### Compatibility

- PHP `^8.2`
- Laravel 12 / 13
- Livewire v3
- Filament v5 (`^5.3`)

#### Install

```bash
composer require jeffersongoncalves/filament-multifactor-passkeys:^2.0


```