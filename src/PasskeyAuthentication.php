<?php

namespace Happenv\FilamentMultiFactorPasskeys;

use Closure;
use Filament\Actions\Action;
use Filament\Auth\MultiFactor\Contracts\MultiFactorAuthenticationProvider;
use Filament\Facades\Filament;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Text;
use Filament\Support\Icons\Heroicon;
use Happenv\FilamentMultiFactorPasskeys\Actions\DisablePasskeyAuthenticationAction;
use Happenv\FilamentMultiFactorPasskeys\Actions\SetUpPasskeyAuthenticationAction;
use Happenv\FilamentMultiFactorPasskeys\Contracts\HasPasskeysAuthentication;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Passkeys\Actions\GenerateVerificationOptions;
use Laravel\Passkeys\Actions\VerifyPasskey;
use Laravel\Passkeys\Support\WebAuthn;
use Livewire\Component;
use LogicException;
use SensitiveParameter;
use Throwable;
use Webauthn\PublicKeyCredential;
use Webauthn\PublicKeyCredentialRequestOptions;

class PasskeyAuthentication implements MultiFactorAuthenticationProvider
{
    public const CHALLENGE_OPTIONS_SESSION_KEY = 'filament-multifactor-passkeys.challenge_options';

    protected ?Closure $resolveRedirectUrlUsing = null;

    public function getId(): string
    {
        return 'passkey';
    }

    public static function make(): static
    {
        return app(static::class);
    }

    public function redirectUrlUsing(?Closure $callback): static
    {
        $this->resolveRedirectUrlUsing = $callback;

        return $this;
    }

    public function getRedirectUrl(): string
    {
        if ($this->resolveRedirectUrlUsing) {
            return ($this->resolveRedirectUrlUsing)();
        }

        return config('filament-multifactor-passkeys.redirect')
            ?? Filament::getCurrentPanel()?->getUrl()
            ?? url('/');
    }

    public function getLoginFormLabel(): string
    {
        return __('filament-multifactor-passkeys::provider.login_form.label');
    }

    public function isEnabled(Authenticatable $user): bool
    {
        return $this->ensurePasskeyUser($user)->hasPasskeysEnabled();
    }

    public function getManagementSchemaComponents(): array
    {
        $user = Filament::auth()->user();

        return [
            Actions::make($this->getActions())
                ->label(__('filament-multifactor-passkeys::provider.management_schema.actions.label'))
                ->belowContent(__('filament-multifactor-passkeys::provider.management_schema.actions.below_content'))
                ->afterLabel(fn (): Text => $this->isEnabled($user)
                    ? Text::make(__('filament-multifactor-passkeys::provider.management_schema.actions.messages.enabled'))
                        ->badge()
                        ->color('success')
                    : Text::make(__('filament-multifactor-passkeys::provider.management_schema.actions.messages.disabled'))
                        ->badge()),
        ];
    }

    public function getActions(): array
    {
        $user = Filament::auth()->user();

        return [
            SetUpPasskeyAuthenticationAction::make($this)
                ->hidden(fn (): bool => $this->isEnabled($user)),
            DisablePasskeyAuthenticationAction::make($this)
                ->visible(fn (): bool => $this->isEnabled($user)),
        ];
    }

    public function getChallengeFormComponents(Authenticatable $user): array
    {
        $user = $this->ensurePasskeyUser($user);

        return [
            ViewField::make('credential')
                ->view('filament-multifactor-passkeys::components.challenge')
                ->hiddenLabel()
                ->validationAttribute(__('filament-multifactor-passkeys::provider.login_form.credential.label'))
                ->registerActions([
                    Action::make('verifyWithPasskey')
                        ->label(__('filament-multifactor-passkeys::provider.login_form.actions.verify.label'))
                        ->icon(Heroicon::OutlinedFingerPrint)
                        ->color('gray')
                        ->action(fn (Component $livewire) => $this->startChallenge($user, $livewire)),
                ])
                ->required()
                ->rule(function () use ($user): Closure {
                    return function (string $attribute, #[SensitiveParameter] $value, Closure $fail) use ($user): void {
                        if (is_string($value) && $this->verifyChallenge($value, $user)) {
                            return;
                        }

                        $fail(__('filament-multifactor-passkeys::provider.login_form.credential.messages.invalid'));
                    };
                }),
        ];
    }

    /**
     * Generate assertion options scoped to the user undertaking the challenge and
     * hand them to the browser. The serialized options stay in the session so the
     * validation rule can check the assertion against the same challenge.
     */
    public function startChallenge(HasPasskeysAuthentication $user, Component $livewire): void
    {
        $options = app(GenerateVerificationOptions::class)($user);

        session()->put(static::CHALLENGE_OPTIONS_SESSION_KEY, WebAuthn::toJson($options));

        $livewire->dispatch('filament-multifactor-passkeys-challenge-options-ready', options: WebAuthn::toBrowserArray($options));
    }

    /**
     * Verify an assertion produced for the pending challenge. Passing the user to
     * VerifyPasskey rejects a passkey that belongs to anyone else.
     */
    public function verifyChallenge(#[SensitiveParameter] string $assertion, HasPasskeysAuthentication $user): bool
    {
        $serializedOptions = session()->pull(static::CHALLENGE_OPTIONS_SESSION_KEY);

        if (blank($serializedOptions)) {
            return false;
        }

        try {
            app(VerifyPasskey::class)(
                WebAuthn::fromJson($assertion, PublicKeyCredential::class),
                WebAuthn::fromJson($serializedOptions, PublicKeyCredentialRequestOptions::class),
                $user,
            );
        } catch (Throwable) {
            return false;
        }

        return true;
    }

    protected function ensurePasskeyUser(?Authenticatable $user): HasPasskeysAuthentication
    {
        if (! ($user instanceof HasPasskeysAuthentication)) {
            throw new LogicException('The user model must implement the ['.HasPasskeysAuthentication::class.'] interface to use passkey authentication.');
        }

        return $user;
    }
}
