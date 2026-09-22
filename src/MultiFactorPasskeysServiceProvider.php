<?php

namespace Happenv\FilamentMultiFactorPasskeys;

use Filament\Actions\Action;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Happenv\FilamentMultiFactorPasskeys\Livewire\AuthenticatePasskey;
use Laravel\Passkeys\Passkeys;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MultiFactorPasskeysServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-multifactor-passkeys')
            ->hasTranslations()
            ->hasViews()
            ->hasConfigFile()
            ->hasMigration('upgrade_passkeys_table_from_spatie');
    }

    public function packageRegistered(): void
    {
        // Must run before laravel/passkeys boots, which is when it loads its routes.
        if (! config('filament-multifactor-passkeys.register_passkeys_routes', false)) {
            Passkeys::ignoreRoutes();
        }
    }

    public function packageBooted(): void
    {
        Livewire::component('filament-multifactor-passkeys-authenticate', AuthenticatePasskey::class);

        // Filament's login page gives its challenge a "Confirm sign in" button that
        // passkeys never need: the ceremony submits the form itself. Both of the
        // page's submit actions are called `authenticate`.
        Action::configureUsing(function (Action $action): void {
            if ($action->getName() !== 'authenticate') {
                return;
            }

            $action->hidden(fn ($livewire): bool => PasskeyAuthentication::shouldHideConfirmButtonOn($livewire));
        });

        FilamentAsset::register([
            Js::make('filament-multifactor-passkeys', __DIR__.'/../resources/dist/passkey.js'),
            Css::make('filament-multifactor-passkeys', __DIR__.'/../resources/dist/passkey.css'),
        ], package: 'happenv-com/filament-multifactor-passkeys');
    }
}
