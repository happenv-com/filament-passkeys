<?php

use Filament\Actions\Testing\TestAction;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Happenv\FilamentMultiFactorPasskeys\PasskeyAuthentication;
use Happenv\FilamentMultiFactorPasskeys\Tests\Fixtures\User;
use Happenv\FilamentMultiFactorPasskeys\Tests\Support\VirtualAuthenticator;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Webauthn\PublicKeyCredentialRequestOptions;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;

beforeEach(function () {
    Filament::setCurrentPanel('admin');
});

/**
 * Sign in with the password so the login page presents the passkey challenge.
 */
function startLoginChallenge(User $user): Testable
{
    return Livewire::test(Login::class)
        ->fillForm(['email' => $user->email, 'password' => 'password'])
        ->call('authenticate')
        ->assertHasNoFormErrors()
        ->assertSet('userUndertakingMultiFactorAuthentication', fn ($value): bool => filled($value));
}

function requestChallengeOptions(Testable $login): array
{
    $login
        ->callAction(TestAction::make('verifyWithPasskey')->schemaComponent('passkey.credential', schema: 'multiFactorChallengeForm'))
        ->assertDispatched('filament-multifactor-passkeys-challenge-options-ready');

    return browserOptionsFromSession(PasskeyAuthentication::CHALLENGE_OPTIONS_SESSION_KEY, PublicKeyCredentialRequestOptions::class);
}

it('challenges a user with a passkey after the password step', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user);

    assertGuest();
});

it('signs the user in after a valid passkey assertion', function () {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    $login = startLoginChallenge($user);
    $options = requestChallengeOptions($login);

    expect($options['allowCredentials'])->toHaveCount(1);

    $login
        ->set('data.multiFactor.passkey.credential', $authenticator->authenticate($options, $user->getPasskeyUserHandle()))
        ->call('authenticate')
        ->assertHasNoFormErrors();

    assertAuthenticatedAs($user);
    expect($user->passkeys()->sole()->last_used_at)->not->toBeNull();
});

it('renders the passkey button on the challenge', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertSee(__('filament-multifactor-passkeys::provider.login_form.actions.verify.label'));
});

it('rejects a passkey that belongs to another user', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    $intruder = createUser('intruder@example.com');
    registerPasskey($intruder, $intruderAuthenticator = new VirtualAuthenticator);

    $login = startLoginChallenge($user);
    $options = requestChallengeOptions($login);

    // A discoverable credential ignores allowCredentials, so the browser could still
    // offer it: the server has to refuse it on its own.
    $login
        ->set('data.multiFactor.passkey.credential', $intruderAuthenticator->authenticate($options, $intruder->getPasskeyUserHandle()))
        ->call('authenticate')
        ->assertHasErrors('data.multiFactor.passkey.credential');

    assertGuest();
});

it('rejects an assertion replayed against a used challenge', function () {
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    $login = startLoginChallenge($user);
    $options = requestChallengeOptions($login);

    $login
        ->set('data.multiFactor.passkey.credential', 'not-json')
        ->call('authenticate')
        ->assertHasErrors('data.multiFactor.passkey.credential');

    // The failed attempt consumed the challenge, so a valid answer to it is stale.
    $login
        ->set('data.multiFactor.passkey.credential', $authenticator->authenticate($options, $user->getPasskeyUserHandle()))
        ->call('authenticate')
        ->assertHasErrors('data.multiFactor.passkey.credential');

    assertGuest();
});

it('rejects an assertion signed by an unknown key', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    $login = startLoginChallenge($user);
    $options = requestChallengeOptions($login);

    $login
        ->set('data.multiFactor.passkey.credential', (new VirtualAuthenticator)->authenticate($options, $user->getPasskeyUserHandle()))
        ->call('authenticate')
        ->assertHasErrors('data.multiFactor.passkey.credential');

    assertGuest();
});

it('requires an assertion to complete the challenge', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->call('authenticate')
        ->assertHasErrors(['data.multiFactor.passkey.credential' => 'required']);

    assertGuest();
});

it('offers the passwordless passkey button on the login form', function () {
    Livewire::test(Login::class)
        ->assertSee(__('filament-multifactor-passkeys::login_button.label'));
});

it('hides the passwordless passkey button during the challenge', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertSee(__('filament-multifactor-passkeys::provider.login_form.actions.verify.label'))
        ->assertDontSee(__('filament-multifactor-passkeys::login_button.label'));
});
