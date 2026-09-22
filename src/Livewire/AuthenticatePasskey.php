<?php

namespace Happenv\FilamentMultiFactorPasskeys\Livewire;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Laravel\Passkeys\Actions\GenerateVerificationOptions;
use Laravel\Passkeys\Actions\VerifyPasskey;
use Laravel\Passkeys\Passkeys;
use Laravel\Passkeys\Support\WebAuthn;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Throwable;
use Webauthn\PublicKeyCredential;
use Webauthn\PublicKeyCredentialRequestOptions;

class AuthenticatePasskey extends Component
{
    use WithRateLimiting;

    public const OPTIONS_SESSION_KEY = 'filament-multifactor-passkeys.login_options';

    #[Locked]
    public ?string $panel = null;

    #[Locked]
    public ?string $redirectUrl = null;

    public function mount(?string $panel = null, ?string $redirectUrl = null): void
    {
        $this->panel = $panel;
        $this->redirectUrl = $redirectUrl;
    }

    public function render(): View
    {
        /** @var view-string $view */
        $view = 'filament-multifactor-passkeys::livewire.authenticate-passkey';

        return view($view);
    }

    public function getOptions(): void
    {
        $options = app(GenerateVerificationOptions::class)();

        session()->put(self::OPTIONS_SESSION_KEY, WebAuthn::toJson($options));

        $this->dispatch('passkey-authentication-options-ready', options: WebAuthn::toBrowserArray($options));
    }

    public function authenticate(string $assertion): void
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException) {
            $this->fail();

            return;
        }

        $serializedOptions = session()->pull(self::OPTIONS_SESSION_KEY);

        if (blank($serializedOptions)) {
            $this->fail();

            return;
        }

        try {
            $passkey = app(VerifyPasskey::class)(
                WebAuthn::fromJson($assertion, PublicKeyCredential::class),
                WebAuthn::fromJson($serializedOptions, PublicKeyCredentialRequestOptions::class),
            );
        } catch (Throwable) {
            $this->fail();

            return;
        }

        try {
            if (! Passkeys::allowsLogin(request(), $passkey)) {
                $this->fail();

                return;
            }
        } catch (ValidationException $exception) {
            // The app's own authorizeLoginUsing() callback may explain the refusal.
            $this->fail(collect($exception->errors())->flatten()->first());

            return;
        }

        $user = $passkey->user;
        $panel = Filament::getPanel($this->panel);

        if (($user instanceof FilamentUser) && (! $user->canAccessPanel($panel))) {
            $this->fail();

            return;
        }

        Auth::guard($panel->getAuthGuard())->login($user);
        session()->regenerate();

        Notification::make()
            ->title(__('filament-multifactor-passkeys::login_button.notifications.success.title'))
            ->body(__('filament-multifactor-passkeys::login_button.notifications.success.body'))
            ->success()
            ->send();

        $this->redirect($this->redirectUrl ?: url('/'), navigate: false);
    }

    protected function fail(?string $message = null): void
    {
        session()->flash('authenticatePasskey::message', $message ?? __('filament-multifactor-passkeys::login_button.errors.invalid'));
    }
}
