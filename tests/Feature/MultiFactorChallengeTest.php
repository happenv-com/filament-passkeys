<?php

use Filament\Actions\Testing\TestAction;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Happenv\FilamentPasskeys\Tests\Fixtures\FakeCodeAuthentication;
use Happenv\FilamentPasskeys\Tests\Fixtures\User;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Webauthn\PublicKeyCredentialRequestOptions;

use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;

beforeEach(function (): void {
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
        ->assertMultiFactorChallengeRequired();
}

function requestChallengeOptions(Testable $login): array
{
    $login
        ->callAction(TestAction::make('verifyWithPasskey')->schemaComponent('passkey.credential', schema: 'multiFactorChallengeForm'))
        ->assertDispatched('filament-passkeys-challenge-options-ready');

    return browserOptionsFromSession(PasskeyAuthentication::CHALLENGE_OPTIONS_SESSION_KEY, PublicKeyCredentialRequestOptions::class);
}

it('challenges a user with a passkey after the password step', function (): void {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user);

    assertGuest();
});

it('signs the user in after a valid passkey assertion', function (): void {
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

it('renders the passkey button on the challenge', function (): void {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertSee(__('filament-passkeys::provider.login_form.actions.verify.label'));
});

it('rejects a passkey that belongs to another user', function (): void {
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

it('rejects an assertion replayed against a used challenge', function (): void {
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

it('rejects an assertion signed by an unknown key', function (): void {
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

it('requires an assertion to complete the challenge', function (): void {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->call('authenticate')
        ->assertHasErrors(['data.multiFactor.passkey.credential' => 'required']);

    assertGuest();
});

it('offers the passwordless passkey button on the login form', function (): void {
    Livewire::test(Login::class)
        ->assertSee(__('filament-passkeys::login_button.label'));
});

it('hides the passwordless passkey button during the challenge', function (): void {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertSee(__('filament-passkeys::provider.login_form.actions.verify.label'))
        ->assertDontSee(__('filament-passkeys::login_button.label'));
});

function confirmSignInLabel(): string
{
    return __('filament-panels::auth/pages/login.multi_factor.form.actions.authenticate.label');
}

it('hides the confirm button when a passkey is the only method', function (): void {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertDontSee(confirmSignInLabel());
});

it('keeps the confirm button when the option is off', function (): void {
    config()->set('filament-passkeys.hide_challenge_confirm_button', false);

    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertSee(confirmSignInLabel());
});

it('keeps the confirm button when the user has another method', function (): void {
    FakeCodeAuthentication::$enabled = true;

    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertSee(confirmSignInLabel());
});

it('keeps the confirm button for a user without passkeys', function (): void {
    FakeCodeAuthentication::$enabled = true;

    startLoginChallenge(createUser())
        ->assertSee(confirmSignInLabel());
});

it('starts the passkey prompt on its own by default', function (): void {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertSee('__filamentPasskeysChallengeAutoStarted', escape: false);
});

it('does not start the passkey prompt on its own when the option is off', function (): void {
    config()->set('filament-passkeys.auto_start_challenge', false);

    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertDontSee('__filamentPasskeysChallengeAutoStarted');
});

it('does not start the passkey prompt on its own when the user has another method', function (): void {
    FakeCodeAuthentication::$enabled = true;

    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertDontSee('__filamentPasskeysChallengeAutoStarted');
});

function verifyWithPasskeyAction(): TestAction
{
    return TestAction::make('verifyWithPasskey')->schemaComponent('passkey.credential', schema: 'multiFactorChallengeForm');
}

it('makes the passkey button primary when it is the only action', function (): void {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertActionHasColor(verifyWithPasskeyAction(), 'primary');
});

it('keeps the passkey button gray next to the confirm button', function (): void {
    config()->set('filament-passkeys.hide_challenge_confirm_button', false);

    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertActionHasColor(verifyWithPasskeyAction(), 'gray');
});

it('keeps the passkey button gray when the user has another method', function (): void {
    FakeCodeAuthentication::$enabled = true;

    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    startLoginChallenge($user)
        ->assertActionHasColor(verifyWithPasskeyAction(), 'gray');
});
