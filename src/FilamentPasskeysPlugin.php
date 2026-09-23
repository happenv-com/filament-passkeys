<?php

namespace Happenv\FilamentMultiFactorPasskeys;

use Filament\Auth\Pages\Login;
use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\HtmlString;
use Livewire\Livewire;

class MultiFactorPasskeysPlugin implements Plugin
{
    public function getId(): string
    {
        return 'filament-multifactor-passkeys';
    }

    public function register(Panel $panel): void
    {
        FilamentView::registerRenderHook(
            PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
            function () use ($panel): HtmlString {
                $login = Livewire::current();

                // The hook sits after the whole login form, so it also shows under the
                // multi-factor challenge, which already offers its own passkey button.
                if (($login instanceof Login) && filled($login->userUndertakingMultiFactorAuthentication)) {
                    return new HtmlString('');
                }

                return new HtmlString(
                    Livewire::mount('filament-multifactor-passkeys-authenticate', [
                        'panel' => $panel->getId(),
                        'redirectUrl' => $panel->getUrl() ?? url('/'),
                    ])
                );
            },
        );
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public static function make(): static
    {
        return app(static::class);
    }
}
