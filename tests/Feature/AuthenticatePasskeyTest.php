<?php

use Happenv\FilamentPasskeys\Livewire\AuthenticatePasskey;
use Happenv\FilamentPasskeys\Tests\Fixtures\User;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
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

it('hands the RP ID to the login button so the browser can detect a related origin', function (): void {
    config()->set('passkeys.relying_party_id', 'acme.example.test');

    passkeyLoginButton()
        ->assertSeeHtml("isCeremonyBlocked('acme.example.test')")
        ->assertSee(__('filament-passkeys::related_origin.unsupported'));
});

it('remembers the user when the remember box was ticked', function (): void {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    $component = passkeyLoginButton();
    $options = requestLoginOptions($component);

    $component
        ->call('authenticate', $authenticator->authenticate($options, $user->getPasskeyUserHandle()), true)
        ->assertRedirect('/admin');

    assertAuthenticatedAs($user);
    expect($user->fresh()->getRememberToken())->not->toBeEmpty()
        ->and(Cookie::hasQueued(Auth::guard()->getRecallerName()))->toBeTrue();
});

it('does not remember the user by default or when the box was not ticked', function (array $arguments): void {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    $component = passkeyLoginButton();
    $options = requestLoginOptions($component);

    $component
        ->call('authenticate', $authenticator->authenticate($options, $user->getPasskeyUserHandle()), ...$arguments)
        ->assertRedirect('/admin');

    assertAuthenticatedAs($user);
    expect($user->fresh()->getRememberToken())->toBeEmpty()
        ->and(Cookie::hasQueued(Auth::guard()->getRecallerName()))->toBeFalse();
})->with([[[]], [[false]]]);

it('limits how often a guest can ask for login options', function (): void {
    $component = passkeyLoginButton();

    foreach (range(1, 20) as $attempt) {
        $component->call('getOptions')->assertDispatched('passkey-authentication-options-ready');
    }

    session()->forget(AuthenticatePasskey::OPTIONS_SESSION_KEY);

    passkeyLoginButton()
        ->call('getOptions')
        ->assertNotDispatched('passkey-authentication-options-ready');

    expect(session()->has(AuthenticatePasskey::OPTIONS_SESSION_KEY))->toBeFalse();
});
