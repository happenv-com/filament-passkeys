<?php

namespace Happenv\FilamentMultiFactorPasskeys\Livewire;

use Filament\Facades\Filament;
use Filament\Notifications\Notification;
use Happenv\FilamentMultiFactorPasskeys\Contracts\HasPasskeysAuthentication;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Laravel\Passkeys\Actions\GenerateRegistrationOptions;
use Laravel\Passkeys\Actions\StorePasskey;
use Laravel\Passkeys\Support\WebAuthn;
use Livewire\Attributes\Validate;
use Livewire\Component;
use RuntimeException;
use Throwable;
use Webauthn\PublicKeyCredential;
use Webauthn\PublicKeyCredentialCreationOptions;

class RegisterPasskey extends Component
{
    public const OPTIONS_SESSION_KEY = 'filament-multifactor-passkeys.registration_options';

    public ?string $redirectUrl = null;

    #[Validate('required|string|max:255')]
    public string $name = '';

    public function render(): View
    {
        /** @var view-string $view */
        $view = 'filament-multifactor-passkeys::livewire.register-passkey';

        return view($view);
    }

    public function generateOptions(): void
    {
        $this->validate();

        $options = app(GenerateRegistrationOptions::class)($this->currentUser());

        session()->put(self::OPTIONS_SESSION_KEY, WebAuthn::toJson($options));

        $this->dispatch('passkey-registration-options-ready', options: WebAuthn::toBrowserArray($options));
    }

    public function storePasskey(string $passkey): void
    {
        $this->validate();

        $user = $this->currentUser();
        $serializedOptions = session()->pull(self::OPTIONS_SESSION_KEY);

        try {
            if (blank($serializedOptions)) {
                throw new RuntimeException('Passkey registration options are missing or expired.');
            }

            app(StorePasskey::class)(
                $user,
                $this->name,
                WebAuthn::fromJson($passkey, PublicKeyCredential::class),
                WebAuthn::fromJson($serializedOptions, PublicKeyCredentialCreationOptions::class),
            );
        } catch (Throwable) {
            throw ValidationException::withMessages([
                'name' => __('filament-multifactor-passkeys::actions/set-up.modal.form.errors.failed'),
            ]);
        }

        Notification::make()
            ->title(__('filament-multifactor-passkeys::actions/set-up.notifications.enabled.title'))
            ->success()
            ->send();

        $this->redirect($this->redirectUrl ?: url('/'), navigate: true);
    }

    protected function currentUser(): HasPasskeysAuthentication
    {
        $user = Filament::auth()->user();

        abort_unless($user instanceof HasPasskeysAuthentication, 403);

        return $user;
    }
}
