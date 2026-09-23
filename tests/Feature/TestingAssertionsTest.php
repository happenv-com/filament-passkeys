<?php

use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Happenv\FilamentPasskeys\Tests\Fixtures\FakeCodeAuthentication;
use Happenv\FilamentPasskeys\Tests\Fixtures\User;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use PHPUnit\Framework\ExpectationFailedException;

beforeEach(function () {
    Filament::setCurrentPanel('admin');
});

function signInWithPassword(User $user): Testable
{
    return Livewire::test(Login::class)
        ->fillForm(['email' => $user->email, 'password' => 'password'])
        ->call('authenticate');
}

it('asserts a passkey challenge for a user with a passkey', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    signInWithPassword($user)
        ->assertMultiFactorChallengeRequired()
        ->assertPasskeyChallengeOffered();
});

it('asserts a passkey challenge next to another method', function () {
    FakeCodeAuthentication::$enabled = true;

    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    signInWithPassword($user)
        ->assertPasskeyChallengeOffered();
});

it('asserts no challenge for a user without multi-factor authentication', function () {
    signInWithPassword(createUser())
        ->assertMultiFactorChallengeNotRequired()
        ->assertPasskeyChallengeNotOffered();
});

it('asserts no passkey challenge for a user with only another method', function () {
    FakeCodeAuthentication::$enabled = true;

    signInWithPassword(createUser())
        ->assertMultiFactorChallengeRequired()
        ->assertPasskeyChallengeNotOffered();
});

it('fails when a passkey challenge is expected but missing', function () {
    signInWithPassword(createUser())
        ->assertPasskeyChallengeOffered();
})->throws(ExpectationFailedException::class);

it('fails when no challenge is expected but one is shown', function () {
    $user = createUser();
    registerPasskey($user, new VirtualAuthenticator);

    signInWithPassword($user)
        ->assertMultiFactorChallengeNotRequired();
})->throws(ExpectationFailedException::class);
