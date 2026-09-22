<?php

use Happenv\FilamentMultiFactorPasskeys\Livewire\RegisterPasskey;
use Happenv\FilamentMultiFactorPasskeys\Tests\Support\VirtualAuthenticator;
use Laravel\Passkeys\Events\PasskeyRegistered;
use Livewire\Livewire;
use Webauthn\PublicKeyCredentialCreationOptions;

use function Pest\Laravel\actingAs;

it('registers a passkey through a real WebAuthn ceremony', function () {
    Event::fake([PasskeyRegistered::class]);

    $user = createUser();
    actingAs($user);

    $component = Livewire::test(RegisterPasskey::class, ['redirectUrl' => '/admin'])
        ->set('name', 'MacBook Touch ID')
        ->call('generateOptions')
        ->assertDispatched('passkey-registration-options-ready', function (string $event, array $params): bool {
            return is_string($params['options']['challenge'] ?? null)
                && ($params['options']['authenticatorSelection']['residentKey'] ?? null) === 'required';
        });

    $options = browserOptionsFromSession(RegisterPasskey::OPTIONS_SESSION_KEY, PublicKeyCredentialCreationOptions::class);

    $component
        ->call('storePasskey', (new VirtualAuthenticator)->register($options))
        ->assertHasNoErrors()
        ->assertRedirect('/admin');

    expect($user->passkeys()->sole())
        ->name->toBe('MacBook Touch ID')
        ->and($user->hasPasskeysEnabled())->toBeTrue()
        ->and(session()->has(RegisterPasskey::OPTIONS_SESSION_KEY))->toBeFalse();

    Event::assertDispatched(PasskeyRegistered::class);
});

it('rejects a registration response for a different challenge', function () {
    $user = createUser();
    actingAs($user);

    $component = Livewire::test(RegisterPasskey::class)
        ->set('name', 'Key')
        ->call('generateOptions');

    $options = browserOptionsFromSession(RegisterPasskey::OPTIONS_SESSION_KEY, PublicKeyCredentialCreationOptions::class);
    $options['challenge'] = 'c29tZS1vdGhlci1jaGFsbGVuZ2U';

    $component
        ->call('storePasskey', (new VirtualAuthenticator)->register($options))
        ->assertHasErrors('name');

    expect($user->passkeys()->exists())->toBeFalse();
});

it('rejects a registration without pending options', function () {
    actingAs(createUser());

    Livewire::test(RegisterPasskey::class)
        ->set('name', 'Key')
        ->call('storePasskey', '{}')
        ->assertHasErrors('name');
});

it('requires a name before generating options', function () {
    actingAs(createUser());

    Livewire::test(RegisterPasskey::class)
        ->call('generateOptions')
        ->assertHasErrors(['name' => 'required'])
        ->assertNotDispatched('passkey-registration-options-ready');
});

it('refuses to register a passkey for a guest', function () {
    Livewire::test(RegisterPasskey::class)
        ->set('name', 'Key')
        ->call('generateOptions')
        ->assertForbidden();
});
