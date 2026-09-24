<?php

use Filament\Actions\Testing\TestAction;
use Filament\Auth\Pages\EditProfile;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Laravel\Passkeys\Events\PasskeyRegistered;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use ParagonIE\ConstantTime\Base64UrlSafe;
use Webauthn\PublicKeyCredentialCreationOptions;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    Filament::setCurrentPanel('admin');
});

function setUpAction(): TestAction
{
    return TestAction::make('setUpPasskeyAuthentication')->schemaComponent('passkey', schema: 'content');
}

/**
 * Submit the set-up modal once, which should only start the ceremony.
 *
 * @return array{0: Testable, 1: array<string, mixed>}
 */
function startPasskeySetUp(string $name = 'MacBook Touch ID'): array
{
    $page = Livewire::test(EditProfile::class)
        ->mountAction(setUpAction())
        ->setActionData(['name' => $name])
        ->callMountedAction()
        ->assertHasNoActionErrors()
        ->assertActionMounted(setUpAction())
        ->assertDispatched('filament-passkeys-registration-options-ready', function (string $event, array $params): bool {
            return is_string($params['options']['challenge'] ?? null)
                && ($params['options']['authenticatorSelection']['residentKey'] ?? null) === 'required';
        });

    return [$page, browserOptionsFromSession(PasskeyAuthentication::REGISTRATION_OPTIONS_SESSION_KEY, PublicKeyCredentialCreationOptions::class)];
}

it('registers a passkey through a real WebAuthn ceremony', function () {
    Event::fake([PasskeyRegistered::class]);

    $user = createUser();
    actingAs($user);

    [$page, $options] = startPasskeySetUp();

    expect($user->passkeys()->exists())->toBeFalse();

    $page
        ->setActionData(['credential' => (new VirtualAuthenticator)->register($options)])
        ->callMountedAction()
        ->assertHasNoActionErrors()
        ->assertActionNotMounted(setUpAction())
        ->assertNoRedirect()
        ->assertNotified(__('filament-passkeys::actions/set-up.notifications.enabled.title'));

    expect($user->passkeys()->sole())
        ->name->toBe('MacBook Touch ID')
        ->and($user->hasPasskeysEnabled())->toBeTrue()
        ->and(session()->has(PasskeyAuthentication::REGISTRATION_OPTIONS_SESSION_KEY))->toBeFalse();

    Event::assertDispatched(PasskeyRegistered::class);
});

it('redirects after set-up when a redirect url is configured', function () {
    config()->set('filament-passkeys.redirect', '/dashboard');
    actingAs(createUser());

    [$page, $options] = startPasskeySetUp();

    $page
        ->setActionData(['credential' => (new VirtualAuthenticator)->register($options)])
        ->callMountedAction()
        ->assertRedirect('/dashboard');
});

it('rejects a registration response for a different challenge and allows a retry', function () {
    $user = createUser();
    actingAs($user);

    [$page, $options] = startPasskeySetUp();
    $options['challenge'] = 'c29tZS1vdGhlci1jaGFsbGVuZ2U';

    $page
        ->setActionData(['credential' => (new VirtualAuthenticator)->register($options)])
        ->callMountedAction()
        ->assertHasActionErrors(['name'])
        ->assertActionMounted(setUpAction());

    expect($user->passkeys()->exists())->toBeFalse();

    // The spent credential was cleared, so submitting again starts a new ceremony.
    $page
        ->callMountedAction()
        ->assertHasNoActionErrors()
        ->assertDispatched('filament-passkeys-registration-options-ready');
});

it('rejects a credential without pending options', function () {
    $user = createUser();
    actingAs($user);

    Livewire::test(EditProfile::class)
        ->mountAction(setUpAction())
        ->setActionData(['name' => 'Key', 'credential' => (new VirtualAuthenticator)->register(['challenge' => 'AAAA'])])
        ->callMountedAction()
        ->assertHasActionErrors(['name']);

    expect($user->passkeys()->exists())->toBeFalse();
});

it('names the passkey after its authenticator when no name is given', function () {
    $user = createUser();
    actingAs($user);

    [$page, $options] = startPasskeySetUp(name: '');

    $page
        ->setActionData(['credential' => (new VirtualAuthenticator(aaguid: '08987058-cadc-4b81-b6e1-30de50dcbe96'))->register($options)])
        ->callMountedAction()
        ->assertHasNoActionErrors();

    expect($user->passkeys()->sole()->name)->toBe('Windows Hello');
});

it('falls back to a generic name when the authenticator is unknown', function () {
    $user = createUser();
    actingAs($user);

    [$page, $options] = startPasskeySetUp(name: '');

    $page
        ->setActionData(['credential' => (new VirtualAuthenticator)->register($options)])
        ->callMountedAction()
        ->assertHasNoActionErrors();

    expect($user->passkeys()->sole()->name)->toBe(__('filament-passkeys::actions/set-up.modal.form.name.default'));
});

it('offers to add another passkey once one is registered', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator, 'MacBook');
    actingAs($user);

    Livewire::test(EditProfile::class)
        ->assertActionVisible(setUpAction())
        ->assertActionHasLabel(setUpAction(), __('filament-passkeys::actions/set-up.add_label'));
});

it('registers another passkey next to an existing one', function () {
    $user = createUser();
    $first = new VirtualAuthenticator;
    registerPasskey($user, $first, 'MacBook');
    actingAs($user);

    [$page, $options] = startPasskeySetUp('Android phone');

    // The authenticator that is already registered is excluded from the ceremony.
    expect(collect($options['excludeCredentials'] ?? [])->pluck('id'))
        ->toContain(Base64UrlSafe::encodeUnpadded($first->credentialId));

    $page
        ->setActionData(['credential' => (new VirtualAuthenticator)->register($options)])
        ->callMountedAction()
        ->assertHasNoActionErrors();

    expect($user->passkeys()->pluck('name')->all())->toEqualCanonicalizing(['MacBook', 'Android phone']);
});

it('builds the set-up form from Filament fields', function () {
    actingAs(createUser());

    Livewire::test(EditProfile::class)
        ->mountAction(setUpAction())
        ->assertFormFieldExists('name', 'mountedActionSchema0', fn (TextInput $field): bool => ! $field->isRequired())
        ->assertFormFieldExists('credential', 'mountedActionSchema0');
});
