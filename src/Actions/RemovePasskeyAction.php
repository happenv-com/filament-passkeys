<?php

namespace Happenv\FilamentPasskeys\Actions;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Happenv\FilamentPasskeys\Contracts\HasPasskeysAuthentication;
use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Laravel\Passkeys\Actions\DeletePasskey;
use Laravel\Passkeys\Passkey;

class RemovePasskeyAction
{
    public static function make(PasskeyAuthentication $passkeyAuthentication): Action
    {
        return Action::make('removePasskey')
            ->label(__('filament-passkeys::actions/remove.label'))
            ->color('danger')
            ->icon(Heroicon::Trash)
            ->link()
            ->requiresConfirmation()
            ->modalWidth(Width::Medium)
            ->modalIcon(Heroicon::OutlinedTrash)
            ->modalHeading(fn (Passkey $record): string => __('filament-passkeys::actions/remove.modal.heading', ['name' => $record->name]))
            // Removing the last passkey turns passkey verification off, so say so.
            ->modalDescription(fn (): string => static::currentUser()->passkeys()->count() > 1
                ? __('filament-passkeys::actions/remove.modal.description')
                : __('filament-passkeys::actions/remove.modal.description_last'))
            ->modalSubmitActionLabel(__('filament-passkeys::actions/remove.modal.actions.submit.label'))
            ->action(function (Passkey $record): void {
                $user = static::currentUser();

                // The record comes from the user's own passkeys, but look it up through
                // the relationship again so a passkey of someone else can never match.
                $passkey = $user->passkeys()->whereKey($record->getKey())->firstOrFail();

                app(DeletePasskey::class)($user, $passkey);

                Notification::make()
                    ->title(__('filament-passkeys::actions/remove.notifications.removed.title'))
                    ->success()
                    ->icon(Heroicon::OutlinedTrash)
                    ->send();
            })
            ->rateLimit(5);
    }

    protected static function currentUser(): HasPasskeysAuthentication
    {
        /** @var HasPasskeysAuthentication $user */
        $user = Filament::auth()->user();

        return $user;
    }
}
