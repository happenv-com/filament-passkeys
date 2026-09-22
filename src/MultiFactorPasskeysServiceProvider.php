<?php

namespace Happenv\FilamentMultiFactorPasskeys;

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

        FilamentAsset::register([
            Js::make('filament-multifactor-passkeys', __DIR__.'/../resources/dist/passkey.js'),
            Css::make('filament-multifactor-passkeys', __DIR__.'/../resources/dist/passkey.css'),
        ], package: 'happenv-com/filament-multifactor-passkeys');
    }
}
