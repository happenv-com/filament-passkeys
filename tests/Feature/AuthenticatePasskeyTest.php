<?php

use Happenv\FilamentPasskeys\Livewire\AuthenticatePasskey;
use Happenv\FilamentPasskeys\Tests\Fixtures\User;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Illuminate\Validation\ValidationException;
use Laravel\Passkeys\Passkeys;
use Livewire\Features\SupportLockedProperties\CannotUpdateLockedPropertyException;
use Livewire\Livewire;
use Webauthn\PublicKeyCredentialRequestOptions;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;

afterEach(function (): void {
    Passkeys::authorizeLoginUsing(null);
});

function passkeyLoginButton()
{
    return Livewire::test(AuthenticatePasskey::class, ['panel' => 'admin', 'redirectUrl' => '/admin']);
}

function requestLoginOptions($component): array
{
    $component
        ->call('getOptions')
        ->assertDispatched('passkey-authentication-options-ready');

    return browserOptionsFromSession(AuthenticatePasskey::OPTIONS_SESSION_KEY, PublicKeyCredentialRequestOptions::class);
}

it('signs in with a discoverable passkey', function (): void {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    $component = passkeyLoginButton();
    $options = requestLoginOptions($component);

    expect($options['allowCredentials'] ?? [])->toBeEmpty();

    $component
        ->call('authenticate', $authenticator->authenticate($options, $user->getPasskeyUserHandle()))
        ->assertRedirect('/admin');

    assertAuthenticatedAs($user);
});

it('rejects an invalid assertion', function (): void {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    $component = passkeyLoginButton();
    $options = requestLoginOptions($component);

    $component
        ->call('authenticate', (new VirtualAuthenticator)->authenticate($options, $user->getPasskeyUserHandle()))
        ->assertNoRedirect()
        ->assertSee(__('filament-passkeys::login_button.errors.invalid'));

    assertGuest();
});

it('rejects an assertion without pending options', function (): void {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    $component = passkeyLoginButton();
    $options = requestLoginOptions($component);
    session()->forget(AuthenticatePasskey::OPTIONS_SESSION_KEY);

    $component
        ->call('authenticate', $authenticator->authenticate($options, $user->getPasskeyUserHandle()))
        ->assertNoRedirect();

    assertGuest();
});

it('does not sign in a user who cannot access the panel', function (): void {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);
    User::$canAccessPanel = false;

    $component = passkeyLoginButton();
    $options = requestLoginOptions($component);

    $component
        ->call('authenticate', $authenticator->authenticate($options, $user->getPasskeyUserHandle()))
        ->assertNoRedirect();

    assertGuest();
});

it('honours the laravel/passkeys login authorization callback', function (): void {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    Passkeys::authorizeLoginUsing(fn (): bool => throw ValidationException::withMessages([
        'credential' => ['This account has been banned.'],
    ]));

    $component = passkeyLoginButton();
    $options = requestLoginOptions($component);

    $component
        ->call('authenticate', $authenticator->authenticate($options, $user->getPasskeyUserHandle()))
        ->assertNoRedirect()
        ->assertSee('This account has been banned.');

    assertGuest();
});

it('locks the panel and redirect url', function (string $property): void {
    passkeyLoginButton()->set($property, 'other');
})->with(['panel', 'redirectUrl'])->throws(CannotUpdateLockedPropertyException::class);

it('does not send a notification after signing in', function (): void {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    $component = passkeyLoginButton();
    $options = requestLoginOptions($component);

    $component
        ->call('authenticate', $authenticator->authenticate($options, $user->getPasskeyUserHandle()))
        ->assertRedirect('/admin')
        ->assertNotNotified();
});
