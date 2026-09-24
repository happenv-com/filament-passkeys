<?php

use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Happenv\FilamentPasskeys\Tests\Fixtures\User;

it('can create passkey authentication instance', function (): void {
    $auth = PasskeyAuthentication::make();

    expect($auth)->toBeInstanceOf(PasskeyAuthentication::class);
});

it('returns passkey as id', function (): void {
    $auth = PasskeyAuthentication::make();

    expect($auth->getId())->toBe('passkey');
});

it('returns login form label as translation', function (): void {
    $auth = PasskeyAuthentication::make();
    $label = $auth->getLoginFormLabel();

    expect($label)->toBeString();
});

it('returns challenge form components as array', function (): void {
    $user = new User([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $auth = PasskeyAuthentication::make();
    $components = $auth->getChallengeFormComponents($user);

    expect($components)
        ->toBeArray()
        ->not->toBeEmpty();
});

it('does not redirect after set-up by default', function (): void {
    expect(PasskeyAuthentication::make()->getRedirectUrl())->toBeNull();
});

it('uses the configured redirect url', function (): void {
    config()->set('filament-passkeys.redirect', '/dashboard');

    expect(PasskeyAuthentication::make()->getRedirectUrl())->toBe('/dashboard');
});

it('uses custom redirect closure when provided', function (): void {
    $auth = PasskeyAuthentication::make()
        ->redirectUrlUsing(fn (): string => '/custom-url');

    expect($auth->getRedirectUrl())->toBe('/custom-url');
});

it('returns management schema components as array', function (): void {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $this->actingAs($user);

    $auth = PasskeyAuthentication::make();
    $components = $auth->getManagementSchemaComponents();

    expect($components)
        ->toBeArray()
        ->not->toBeEmpty();
});

it('returns actions as array', function (): void {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $this->actingAs($user);

    $auth = PasskeyAuthentication::make();
    $actions = $auth->getActions();

    expect($actions)
        ->toBeArray()
        ->not->toBeEmpty();
});

it('reports user as disabled when user has no passkeys', function (): void {
    $user = User::create([
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
    ]);

    $auth = PasskeyAuthentication::make();

    expect($auth->isEnabled($user))->toBeFalse();
});
