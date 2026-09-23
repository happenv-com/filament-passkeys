<?php

namespace Happenv\FilamentPasskeys\Testing;

use Closure;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Livewire\Component;
use Livewire\Features\SupportTesting\Testable;
use PHPUnit\Framework\Assert;

/**
 * Assertions for Filament's login page, to check whether signing in stops at
 * the multi-factor challenge and whether that challenge offers a passkey.
 *
 * @method Component instance()
 *
 * @mixin Testable
 */
class TestsPasskeyAuthentication
{
    public function assertMultiFactorChallengeRequired(): Closure
    {
        return function (): static {
            $login = $this->instance();

            Assert::assertInstanceOf(Login::class, $login, 'Failed asserting that the component is a Filament login page.');

            Assert::assertTrue(
                filled($login->userUndertakingMultiFactorAuthentication),
                'Failed asserting that the login page is showing the multi-factor challenge.',
            );

            return $this;
        };
    }

    public function assertMultiFactorChallengeNotRequired(): Closure
    {
        return function (): static {
            $login = $this->instance();

            Assert::assertInstanceOf(Login::class, $login, 'Failed asserting that the component is a Filament login page.');

            Assert::assertTrue(
                blank($login->userUndertakingMultiFactorAuthentication),
                'Failed asserting that the login page is not showing the multi-factor challenge.',
            );

            return $this;
        };
    }

    public function assertPasskeyChallengeOffered(): Closure
    {
        return function (): static {
            $this->assertMultiFactorChallengeRequired();

            $provider = collect(Filament::getMultiFactorAuthenticationProviders())
                ->first(fn ($provider): bool => $provider instanceof PasskeyAuthentication);

            Assert::assertNotNull($provider, 'Failed asserting that the panel registers the ['.PasskeyAuthentication::class.'] multi-factor provider.');

            // Filament nests each provider's challenge fields under the provider's ID.
            $this->assertSchemaComponentExists("{$provider->getId()}.credential", 'multiFactorChallengeForm');

            return $this;
        };
    }

    public function assertPasskeyChallengeNotOffered(): Closure
    {
        return function (): static {
            $login = $this->instance();

            Assert::assertInstanceOf(Login::class, $login, 'Failed asserting that the component is a Filament login page.');

            if (blank($login->userUndertakingMultiFactorAuthentication)) {
                return $this;
            }

            $provider = collect(Filament::getMultiFactorAuthenticationProviders())
                ->first(fn ($provider): bool => $provider instanceof PasskeyAuthentication);

            if (! $provider) {
                return $this;
            }

            $this->assertSchemaComponentDoesNotExist("{$provider->getId()}.credential", 'multiFactorChallengeForm');

            return $this;
        };
    }
}
