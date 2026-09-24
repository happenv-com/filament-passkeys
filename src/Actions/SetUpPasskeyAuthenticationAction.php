<?php

namespace Happenv\FilamentPasskeys\Actions;

use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ViewField;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Happenv\FilamentPasskeys\Contracts\HasPasskeysAuthentication;
use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Throwable;

class SetUpPasskeyAuthenticationAction
{
    public static function make(PasskeyAuthentication $passkeyAuthentication): Action
    {
        /** @var view-string $credentialView */
        $credentialView = 'filament-passkeys::components.register';

        return Action::make('setUpPasskeyAuthentication')
            ->label(fn (): string => $passkeyAuthentication->isEnabled(Filament::auth()->user())
                ? __('filament-passkeys::actions/set-up.add_label')
                : __('filament-passkeys::actions/set-up.label'))
            ->color('primary')
            ->icon(Heroicon::FingerPrint)
            ->link()
            ->modalWidth(Width::Large)
            ->modalIcon(Heroicon::OutlinedFingerPrint)
            ->modalIconColor('primary')
            ->modalHeading(fn (): string => $passkeyAuthentication->isEnabled(Filament::auth()->user())
                ? __('filament-passkeys::actions/set-up.modal.add_heading')
                : __('filament-passkeys::actions/set-up.modal.heading'))
            ->modalDescription(__('filament-passkeys::actions/set-up.modal.description'))
            ->schema([
                TextInput::make('name')
                    ->label(__('filament-passkeys::actions/set-up.modal.form.name.label'))
                    ->placeholder(__('filament-passkeys::actions/set-up.modal.form.name.placeholder'))
                    ->helperText(__('filament-passkeys::actions/set-up.modal.form.name.helper_text'))
                    ->maxLength(255)
                    ->autocomplete(false)
                    ->autofocus(),
                // Holds the browser's answer and the script that fetches it. Kept out of
                // the grid like a Hidden field, so it adds no gap under the name input.
                ViewField::make('credential')
                    ->view($credentialView)
                    ->hiddenLabel()
                    ->columnSpan(['default' => 'hidden']),
            ])
            ->modalSubmitActionLabel(__('filament-passkeys::actions/set-up.modal.form.submit.label'))
            ->action(function (Action $action, array $data, Schema $schema, Component $livewire) use ($passkeyAuthentication): void {
                /** @var HasPasskeysAuthentication $user */
                $user = Filament::auth()->user();

                // The first submit only starts the ceremony. The browser answers by
                // filling in the credential and submitting the form a second time.
                if (blank($data['credential'] ?? null)) {
                    $passkeyAuthentication->startRegistration($user, $livewire);

                    $action->halt();
                }

                try {
                    $passkeyAuthentication->storeRegistration($user, $data['name'] ?? null, $data['credential']);
                } catch (Throwable) {
                    $fields = $schema->getFlatFields();

                    // Clear the spent credential so the next submit starts a fresh ceremony.
                    $fields['credential']->state(null);

                    throw ValidationException::withMessages([
                        $fields['name']->getStatePath() => __('filament-passkeys::actions/set-up.modal.form.errors.failed'),
                    ]);
                }

                Notification::make()
                    ->title(__('filament-passkeys::actions/set-up.notifications.enabled.title'))
                    ->success()
                    ->icon(Heroicon::OutlinedFingerPrint)
                    ->send();

                if (filled($redirectUrl = $passkeyAuthentication->getRedirectUrl())) {
                    $action->redirect($redirectUrl);
                }
            })
            // Each ceremony takes two calls: one for the options, one for the credential.
            ->rateLimit(10);
    }
}
