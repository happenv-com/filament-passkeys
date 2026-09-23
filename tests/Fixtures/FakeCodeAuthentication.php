<?php

namespace Happenv\FilamentPasskeys\Tests\Fixtures;

use Filament\Auth\MultiFactor\Contracts\MultiFactorAuthenticationProvider;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\Auth\Authenticatable;

/**
 * A second multi-factor method, off unless a test turns it on.
 */
class FakeCodeAuthentication implements MultiFactorAuthenticationProvider
{
    public static bool $enabled = false;

    public static function make(): static
    {
        return app(static::class);
    }

    public function isEnabled(Authenticatable $user): bool
    {
        return static::$enabled;
    }

    public function getId(): string
    {
        return 'fake-code';
    }

    public function getLoginFormLabel(): string
    {
        return 'Use a code';
    }

    public function getManagementSchemaComponents(): array
    {
        return [];
    }

    public function getChallengeFormComponents(Authenticatable $user): array
    {
        return [
            TextInput::make('code')->required(),
        ];
    }
}
