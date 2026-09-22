<?php

namespace Happenv\FilamentMultiFactorPasskeys;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Happenv\FilamentMultiFactorPasskeys\Livewire\AuthenticatePasskey;
use Happenv\FilamentMultiFactorPasskeys\Livewire\RegisterPasskey;
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
            ->hasConfigFile();
    }

    public function packageBooted(): void
    {
        Livewire::component('filament-multifactor-passkeys-register', RegisterPasskey::class);
        Livewire::component('filament-multifactor-passkeys-authenticate', AuthenticatePasskey::class);

        FilamentAsset::register([
            Js::make('filament-multifactor-passkeys', __DIR__.'/../resources/dist/passkey.js'),
            Css::make('filament-multifactor-passkeys', __DIR__.'/../resources/dist/passkey.css'),
        ], package: 'jeffersongoncalves/filament-multifactor-passkeys');
    }
}
