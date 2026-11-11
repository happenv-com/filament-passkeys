---
name: filament-passkeys-development
description: >-
  Add WebAuthn passkeys to Filament panels with happenv-com/filament-passkeys (built on
  laravel/passkeys). Use when making a user model passkey-capable (HasPasskeysAuthentication,
  InteractsWithPasskeysAuthentication), registering PasskeyAuthentication in
  multiFactorAuthentication() or the FilamentPasskeysPlugin "Sign in with a passkey" button,
  configuring redirectUrlUsing(), Passkeys::authorizeLoginUsing(), the passkey-only challenge,
  related origins (FilamentPasskeys::relatedOriginsUsing(), assertWithinRelatedOriginsLimit(),
  /.well-known/webauthn, TooManyRelatedOrigins), migrating from spatie/laravel-passkeys, or testing
  the login with assertMultiFactorChallengeRequired() / assertPasskeyChallengeOffered().
---

# Filament Passkeys

A Filament multi-factor authentication provider that confirms the sign-in with a WebAuthn passkey, plus an optional passwordless "Sign in with a passkey" button on the login page. It is a thin adapter: `laravel/passkeys` generates and verifies every ceremony and owns the `passkeys` table and `config/passkeys.php`; this package wires those ceremonies into Filament's MFA challenge, the profile page and the login page, all through Livewire (no extra HTTP routes).

## When to use this skill

- Turning on passkeys (as a second factor, or passwordless) in a Filament panel.
- Preparing a user model for passkeys, or a non-default user model.
- Blocking passkey sign-in for some users, or changing what happens after a passkey is registered.
- Serving a panel on several domains (customer domains, multi-tenant) with one set of passkeys.
- Switching an app from `spatie/laravel-passkeys`.
- Writing tests that check a login stops at the passkey challenge.

## Installation

```bash
composer require happenv-com/filament-passkeys
php artisan vendor:publish --tag="passkeys-migrations"   # laravel/passkeys table
php artisan migrate
```

Optional: `--tag="passkeys-config"` (RP ID, allowed origins, timeout: `laravel/passkeys`), `--tag="filament-passkeys-config"`, `--tag="filament-passkeys-views"`, `--tag="filament-passkeys-translations"`.

`laravel/passkeys` derives the relying party ID and allowed origins from `APP_URL`. If it does not match the URL the panel is served from, every ceremony is rejected. This is the first thing to check when passkeys "do not work".

Supports Filament `^4.13.3 || ^5.8`, Laravel 12 and 13, PHP 8.2+.

## User model

```php
use Filament\Models\Contracts\FilamentUser;
use Happenv\FilamentPasskeys\Concerns\InteractsWithPasskeysAuthentication;
use Happenv\FilamentPasskeys\Contracts\HasPasskeysAuthentication;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, HasPasskeysAuthentication
{
    use InteractsWithPasskeysAuthentication;

    public function canAccessPanel(Panel $panel): bool
    {
        return true; // keep the app's existing access rule; FilamentUser requires this method
    }
}
```

- `HasPasskeysAuthentication` extends `Laravel\Passkeys\Contracts\PasskeyUser`; the trait is `Laravel\Passkeys\PasskeyAuthenticatable`. That gives `passkeys()` (HasMany of `Laravel\Passkeys\Passkey`) and `hasPasskeysEnabled()` (default: `passkeys()->exists()`).
- Passkey verification counts as "enabled" for a user exactly when `hasPasskeysEnabled()` is true. Override it if your rule differs.
- Without the interface the provider throws `LogicException` ("The user model must implement ...") as soon as it touches the user.
- A user model other than `App\Models\User`: `Laravel\Passkeys\Passkeys::useUserModel(Admin::class);` in a service provider.

## Panel

```php
use Happenv\FilamentPasskeys\FilamentPasskeysPlugin;
use Happenv\FilamentPasskeys\PasskeyAuthentication;

return $panel
    ->login()
    ->profile()                                   // MFA is managed on Filament's profile page
    ->multiFactorAuthentication([
        PasskeyAuthentication::make(),
        // AppAuthentication::make(), EmailAuthentication::make() ... side by side
    ])
    ->plugin(FilamentPasskeysPlugin::make());     // optional: "Sign in with a passkey" on the login page
```

- `PasskeyAuthentication` is the second factor (provider ID `passkey`). It adds **Set up / Add passkey**, **Turn off** and a table of passkeys with **Remove** to the profile's MFA section (action names `setUpPasskeyAuthentication`, `disablePasskeyAuthentication`, `removePasskey`). Removing the last passkey turns the method off.
- `FilamentPasskeysPlugin` is **not** needed for MFA. It only renders the passwordless button (`AUTH_LOGIN_FORM_AFTER` render hook), which honours "Remember me" and returns to `url.intended`. Leave it out for passkeys as a second factor only.
- To force every user to set up MFA, use Filament's own `multiFactorAuthentication([...], isRequired: true)`.

### After registering a passkey

By default the modal closes and the user stays on the profile page.

```php
PasskeyAuthentication::make()->redirectUrlUsing(fn (): string => route('dashboard'));
```

or `'redirect' => '/dashboard'` in `config/filament-passkeys.php` (the closure wins).

### Blocking passwordless sign-in

The login button calls `laravel/passkeys`' authorization; a `ValidationException` message is shown to the user:

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

Users failing `FilamentUser::canAccessPanel()` are never signed in. The button is rate limited (5 attempts a minute per IP).

## Config (`config/filament-passkeys.php`)

| Key | Default | Effect |
|---|---|---|
| `redirect` | `null` | URL after registering a passkey. |
| `register_passkeys_routes` | `false` | The package calls `Passkeys::ignoreRoutes()` in `register()`. Set `true` only if the app also uses the `@laravel/passkeys` JS client. |
| `hide_challenge_confirm_button` | `true` | Hides Filament's "Confirm sign in" button when a passkey is the user's only MFA method. |
| `auto_start_challenge` | `true` | Opens the passkey prompt as soon as that passkey-only challenge appears. Safari may refuse it without a user gesture; the button remains. |
| `related_origins.*` | off | See below. |

Users with more than one enabled method always get Filament's usual challenge screen.

## Related origins (one RP ID, several domains)

Only needed when panels run on domains that are not the RP ID or its subdomains. Keep `passkeys.relying_party_id` on the shared RP ID, then give the package the list of other origins:

```php
// config/filament-passkeys.php
'related_origins' => [
    'enabled' => true,                       // serves GET /.well-known/webauthn
    'origins' => ['https://shop.customer.com'],
    'middleware' => ['throttle:60,1'],       // the route's WHOLE stack; it is outside `web`
    'cache_max_age' => 300,
    'max_origins' => 5,
],
```

or, dynamically, once in a service provider's `boot()` (replaces `origins`):

```php
use Happenv\FilamentPasskeys\FilamentPasskeys;
use Illuminate\Http\Request;

// Per-tenant RP ID (e.g. acme.example.com, set per request): the tenant must resolve on its
// RP ID host too, because browsers fetch https://{rpId}/.well-known/webauthn from there.
FilamentPasskeys::relatedOriginsUsing(function (Request $request): array {
    $tenant = Tenant::current();   // from the validated host: the RP ID host or a custom domain

    return $tenant?->domains->map(fn ($d): string => "https://{$d->name}")->all() ?? [];
});
```

If the resolver returns `[]` on the RP ID host, the file answers `404` and every related-origin ceremony fails. With one shared RP ID (e.g. `example.com`, no tenant on that host), return the same full list on every host instead of a per-tenant one.

What the package does with the list:

- Serves it as `{"origins": [...related, ..., "https://{rpId}"]}` (route name `filament-passkeys.related-origins`), RP origin last on purpose. `404` when the list is empty.
- During every ceremony (set-up, MFA challenge, passwordless button) it temporarily adds the RP origin and the related origins to `passkeys.allowed_origins`, then restores the config (Octane-safe).
- Origins are normalised (lowercase, no default port, no trailing slash) and de-duplicated. Anything that is not `https://host[:port]` is dropped silently: bare hosts, paths, queries, IPs, single-label hosts. `http://` survives only for `localhost` / `*.localhost`. IDNs must be punycode.
- In the browser, on an origin that is not the RP ID or a subdomain, the package checks `getClientCapabilities().relatedOrigins` and hides the button / explains instead of failing when unsupported.

Gotchas:

- **Limit**: more distinct hosts than `max_origins` (RP host not counted) throws `Happenv\FilamentPasskeys\Exceptions\TooManyRelatedOrigins` (`$count`, `$limit`) for the file and for every ceremony; the list is never truncated. Validate when a domain is added:

  ```php
  use Happenv\FilamentPasskeys\Exceptions\TooManyRelatedOrigins;

  try {
      FilamentPasskeys::assertWithinRelatedOriginsLimit([...$existingOrigins, "https://{$newDomain}"]);
  } catch (TooManyRelatedOrigins $e) {
      // "Passkeys work on at most {$e->limit} domains."
  }
  ```

  `FilamentPasskeys::maxRelatedOrigins()` returns the configured limit.
- A resolver that throws is wrapped in `RelatedOriginsResolverFailed` and surfaces as a `500` (never as "invalid passkey").
- **Security boundary**: every listed origin can obtain assertions for every user of the RP ID. Derive the list from trusted server data keyed on the validated host, never from query/header/body input; remove a domain the moment it stops pointing at you; resolve services inside the closure (`app(...)`, `$request`), do not capture them (Octane). Prefer a per-tenant RP ID when tenants bring their own domains.
- The `/.well-known/webauthn` route has no session, cookies or CSRF, but global middleware still runs. Do not define the same route in the app; a static `public/.well-known/webauthn` file wins over it. CDNs/WAFs must not redirect, challenge or over-cache it.
- The `laravel/passkeys` HTTP routes (`register_passkeys_routes`) are not covered automatically. Wrap them with a middleware appended to `passkeys.middleware` after `web`:

  ```php
  public function handle(Request $request, Closure $next): Response
  {
      return FilamentPasskeys::withRelatedOrigins(fn (): Response => $next($request), $request);
  }
  ```

- With no resolver and `origins` empty (default), nothing changes: no route, `passkeys.allowed_origins` untouched.

## Migrating from spatie/laravel-passkeys

Both use a `passkeys` table and `config/passkeys.php`, so they cannot coexist. Run this package's upgrade migration **instead of** the `laravel/passkeys` one:

```bash
composer remove spatie/laravel-passkeys
php artisan vendor:publish --tag="filament-passkeys-migrations"
php artisan migrate
```

It renames `authenticatable_id` to `user_id` and `data` to `credential`, rebuilds `credential_id`, and is a no-op on a table that already has the new schema. Delete Spatie's `config/passkeys.php`; publish `passkeys-config` again if you need one. Existing passkeys keep working.

## Testing the host

The package mixes assertions into Livewire's `Testable` for Filament's `Login` page:

```php
use Filament\Auth\Pages\Login;
use Livewire\Livewire;

it('asks users with a passkey for it', function () {
    $user = User::factory()->create();
    $user->passkeys()->create([
        'name' => 'Test key',
        'credential_id' => Str::random(32),
        'credential' => [],
    ]);

    Livewire::test(Login::class)
        ->fillForm(['email' => $user->email, 'password' => 'password'])
        ->call('authenticate')
        ->assertMultiFactorChallengeRequired()
        ->assertPasskeyChallengeOffered();
});
```

| Assertion | Passes when |
|---|---|
| `assertMultiFactorChallengeRequired()` | Sign-in stopped at the MFA challenge. |
| `assertMultiFactorChallengeNotRequired()` | No challenge is shown. |
| `assertPasskeyChallengeOffered()` | The challenge offers a passkey (alone or next to other methods). Also fails if the panel does not register `PasskeyAuthentication`. |
| `assertPasskeyChallengeNotOffered()` | No challenge, or one without a passkey. |

- A `passkeys` row is enough for `hasPasskeysEnabled()` and the challenge to appear; the credential is only read during a real ceremony. Completing a ceremony needs a real WebAuthn authenticator, so test the flow up to the challenge, not the assertion itself.
- Set the current panel first if the test does not hit a panel route: `Filament::setCurrentPanel('admin')`.

## Do not

- Do not keep `spatie/laravel-passkeys` installed, and do not publish the `laravel/passkeys` migration when upgrading from it: the upgrade migration replaces it.
- Do not register the plugin expecting it to enable MFA; register `PasskeyAuthentication` in `multiFactorAuthentication()`.
- Do not set `register_passkeys_routes` to `true` unless something else calls those routes.
- Do not put origins you do not control, or origins derived from request input, in the related origins list.
- Do not edit `passkeys.allowed_origins` at runtime yourself for related origins; the package does it per ceremony.
