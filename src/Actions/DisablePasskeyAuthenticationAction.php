<?php

namespace Happenv\FilamentPasskeys\Actions;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Happenv\FilamentPasskeys\Contracts\HasPasskeysAuthentication;
use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Illuminate\Support\Facades\DB;
use Laravel\Passkeys\Actions\DeletePasskey;

class DisablePasskeyAuthenticationAction
{
    public static function make(PasskeyAuthentication $passkeyAuthentication): Action
    {
        return Action::make('disablePasskeyAuthentication')
            ->label(__('filament-passkeys::actions/disable.label'))
            ->color('danger')
            ->icon(Heroicon::LockOpen)
            ->link()
            ->requiresConfirmation()
            ->modalWidth(Width::Medium)
            ->modalIcon(Heroicon::OutlinedLockOpen)
            ->modalHeading(__('filament-passkeys::actions/disable.modal.heading'))
            ->modalDescription(__('filament-passkeys::actions/disable.modal.description'))
            ->modalSubmitAction(fn (Action $action) => $action
                ->label(__('filament-passkeys::actions/disable.modal.actions.submit.label')))
            ->action(function (): void {
                /** @var HasPasskeysAuthentication $user */
                $user = Filament::auth()->user();

                $deletePasskey = app(DeletePasskey::class);

                DB::transaction(function () use ($user, $deletePasskey): void {
                    // Delete one by one so every removal dispatches PasskeyDeleted.
                    foreach ($user->passkeys()->get() as $passkey) {
                        $deletePasskey($user, $passkey);
                    }
                });

                Notification::make()
                    ->title(__('filament-passkeys::actions/disable.notifications.disabled.title'))
                    ->success()
                    ->icon(Heroicon::OutlinedLockOpen)
                    ->send();
            })
            ->rateLimit(5);
    }
}
