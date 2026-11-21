<?php

use Happenv\FilamentPasskeys\Support\PendingCeremony;
use Happenv\FilamentPasskeys\Tests\Fixtures\User;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Happenv\FilamentPasskeys\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passkeys\Actions\GenerateRegistrationOptions;
use Laravel\Passkeys\Actions\StorePasskey;
use Laravel\Passkeys\Passkey;
use Laravel\Passkeys\Support\WebAuthn;
use Webauthn\PublicKeyCredential;

uses(TestCase::class, RefreshDatabase::class)->in('Feature');

function createUser(string $email = 'test@example.com'): User
{
    return User::create([
        'name' => 'Test User',
        'email' => $email,
        'password' => 'password',
    ]);
}

/**
 * Run a real registration ceremony for the user with the given authenticator.
 */
function registerPasskey(User $user, VirtualAuthenticator $authenticator, string $name = 'Test key'): Passkey
{
    $options = app(GenerateRegistrationOptions::class)($user);

    return app(StorePasskey::class)(
        $user,
        $name,
        WebAuthn::fromJson($authenticator->register(WebAuthn::toBrowserArray($options)), PublicKeyCredential::class),
        $options,
    );
}

/**
 * The browser-facing form of the pending ceremony options stored under the given key.
 *
 * @param  class-string  $class
 * @return array<string, mixed>
 */
function browserOptionsFromSession(string $key, string $class): array
{
    return WebAuthn::toBrowserArray(WebAuthn::fromJson((string) PendingCeremony::get($key), $class));
}

/**
 * Stand in for a request that overlapped the ceremony: it read the session before the ceremony
 * started and, like every request, wrote the whole session back when it finished.
 *
 * @param  array<string, mixed>  $readBeforeTheCeremony
 */
function writeSessionBackFromAnOverlappingRequest(array $readBeforeTheCeremony): void
{
    session()->flush();
    session()->put($readBeforeTheCeremony);
}
