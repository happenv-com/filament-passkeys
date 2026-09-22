<?php

use Filament\Actions\Testing\TestAction;
use Filament\Auth\Pages\EditProfile;
use Filament\Facades\Filament;
use Happenv\FilamentMultiFactorPasskeys\Tests\Support\VirtualAuthenticator;
use Laravel\Passkeys\Events\PasskeyDeleted;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;

it('removes every passkey of the user and reports each deletion', function () {
    Event::fake([PasskeyDeleted::class]);
    Filament::setCurrentPanel('admin');

    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator, 'First');
    registerPasskey($user, new VirtualAuthenticator, 'Second');

    $other = createUser('other@example.com');
    registerPasskey($other, new VirtualAuthenticator);

    actingAs($user);

    Livewire::test(EditProfile::class)
        ->callAction(TestAction::make('disablePasskeyAuthentication')->schemaComponent('passkey', schema: 'content'));

    expect($user->passkeys()->exists())->toBeFalse()
        ->and($other->passkeys()->exists())->toBeTrue();

    Event::assertDispatchedTimes(PasskeyDeleted::class, 2);
});
