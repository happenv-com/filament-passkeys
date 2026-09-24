<?php

use Filament\Actions\Exceptions\ActionNotResolvableException;
use Filament\Actions\Testing\TestAction;
use Filament\Auth\Pages\EditProfile;
use Filament\Facades\Filament;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Laravel\Passkeys\Events\PasskeyDeleted;
use Laravel\Passkeys\Passkey;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    Filament::setCurrentPanel('admin');
});

function removePasskeyAction(Passkey $passkey): TestAction
{
    return TestAction::make('removePasskey')->schemaComponent("passkey.passkeys.{$passkey->getKey()}.actions", schema: 'content');
}

it('lists the passkeys of the user on the profile', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator, 'MacBook');
    registerPasskey($user, new VirtualAuthenticator, 'Android phone');

    registerPasskey(createUser('other@example.com'), new VirtualAuthenticator, 'Someone else');

    actingAs($user);

    Livewire::test(EditProfile::class)
        ->assertSchemaComponentVisible('passkey.passkeys', 'content')
        ->assertSee('MacBook')
        ->assertSee('Android phone')
        ->assertDontSee('Someone else');
});

it('shows which authenticator holds a passkey', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator(aaguid: '08987058-cadc-4b81-b6e1-30de50dcbe96'), 'Work laptop');

    actingAs($user);

    Livewire::test(EditProfile::class)
        ->assertSee('Work laptop')
        ->assertSee('Windows Hello');
});

it('hides the list when the user has no passkeys', function () {
    actingAs(createUser());

    Livewire::test(EditProfile::class)
        ->assertSchemaComponentHidden('passkey.passkeys', 'content');
});

it('removes a single passkey and keeps the others', function () {
    Event::fake([PasskeyDeleted::class]);

    $user = createUser();
    $macbook = registerPasskey($user, new VirtualAuthenticator, 'MacBook');
    registerPasskey($user, new VirtualAuthenticator, 'Android phone');

    actingAs($user);

    Livewire::test(EditProfile::class)
        ->callAction(removePasskeyAction($macbook))
        ->assertNotified(__('filament-passkeys::actions/remove.notifications.removed.title'))
        ->assertDontSee('MacBook')
        ->assertSee('Android phone');

    expect($user->passkeys()->pluck('name')->all())->toBe(['Android phone'])
        ->and($user->hasPasskeysEnabled())->toBeTrue();

    Event::assertDispatchedTimes(PasskeyDeleted::class, 1);
});

it('warns that removing the last passkey turns passkey verification off', function () {
    $user = createUser();
    $passkey = registerPasskey($user, new VirtualAuthenticator, 'MacBook');

    actingAs($user);

    Livewire::test(EditProfile::class)
        ->mountAction(removePasskeyAction($passkey))
        ->assertMountedActionModalSee(__('filament-passkeys::actions/remove.modal.description_last'))
        ->callMountedAction()
        ->assertSchemaComponentHidden('passkey.passkeys', 'content');

    expect($user->hasPasskeysEnabled())->toBeFalse();
});

it('does not warn about turning passkey verification off while other passkeys remain', function () {
    $user = createUser();
    $passkey = registerPasskey($user, new VirtualAuthenticator, 'MacBook');
    registerPasskey($user, new VirtualAuthenticator, 'Android phone');

    actingAs($user);

    Livewire::test(EditProfile::class)
        ->mountAction(removePasskeyAction($passkey))
        ->assertMountedActionModalSee(__('filament-passkeys::actions/remove.modal.description'))
        ->assertMountedActionModalDontSee(__('filament-passkeys::actions/remove.modal.description_last'));
});

it('cannot reach a passkey of another user', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator, 'MacBook');

    $foreign = registerPasskey(createUser('other@example.com'), new VirtualAuthenticator, 'Someone else');

    actingAs($user);

    expect(fn () => Livewire::test(EditProfile::class)->callAction(removePasskeyAction($foreign)))
        ->toThrow(ActionNotResolvableException::class);

    expect(Passkey::whereKey($foreign->getKey())->exists())->toBeTrue();
});
