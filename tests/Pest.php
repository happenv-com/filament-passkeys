<?php

use Happenv\FilamentMultiFactorPasskeys\Tests\Fixtures\User;
use Happenv\FilamentMultiFactorPasskeys\Tests\Support\VirtualAuthenticator;
use Happenv\FilamentMultiFactorPasskeys\Tests\TestCase;
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
 * The browser-facing form of options serialized into the session under the given key.
 *
 * @param  class-string  $class
 * @return array<string, mixed>
 */
function browserOptionsFromSession(string $key, string $class): array
{
    return WebAuthn::toBrowserArray(WebAuthn::fromJson(session()->get($key), $class));
}
