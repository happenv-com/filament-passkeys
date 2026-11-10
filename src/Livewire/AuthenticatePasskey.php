<?php

namespace Happenv\FilamentPasskeys\Livewire;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Happenv\FilamentPasskeys\FilamentPasskeys;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Laravel\Passkeys\Actions\GenerateVerificationOptions;
use Laravel\Passkeys\Actions\VerifyPasskey;
use Laravel\Passkeys\Passkey;
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

    public const OPTIONS_SESSION_KEY = 'filament-passkeys.login_options';

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
        $view = 'filament-passkeys::livewire.authenticate-passkey';

        return view($view, ['rpId' => Passkeys::relyingPartyId()]);
    }

    public function getOptions(): void
    {
        try {
            $this->rateLimit(20);
        } catch (TooManyRequestsException) {
            $this->fail();

            return;
        }

        $options = app(GenerateVerificationOptions::class)();

        session()->put(self::OPTIONS_SESSION_KEY, WebAuthn::toJson($options));

        $this->dispatch('passkey-authentication-options-ready', options: WebAuthn::toBrowserArray($options));
    }

    /**
     * @param  bool  $remember  Whether the login form's "Remember me" box was ticked.
     */
    public function authenticate(string $assertion, bool $remember = false): void
    {
        // Cheap checks first, so a throttled guest or one without pending options
        // never triggers the (possibly database-backed) origins resolver.
        // isRateLimited() only exists in newer livewire-rate-limiting releases; this matches its key.
        if (RateLimiter::tooManyAttempts($this->getRateLimitKey('authenticate'), 5)) {
            $this->fail();

            return;
        }

        if (blank(session()->get(self::OPTIONS_SESSION_KEY))) {
            $this->hitRateLimiter();
            $this->fail();

            return;
        }

        // Resolved before the attempt is recorded and outside the try: a failing
        // resolver is the app's error, not a wrong passkey, and must neither
        // count nor be hidden.
        $webauthnOrigins = FilamentPasskeys::webauthnOrigins(request());

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
            $passkey = FilamentPasskeys::withWebauthnOrigins($webauthnOrigins, fn (): Passkey => app(VerifyPasskey::class)(
                WebAuthn::fromJson($assertion, PublicKeyCredential::class),
                WebAuthn::fromJson($serializedOptions, PublicKeyCredentialRequestOptions::class),
            ));
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

        Auth::guard($panel->getAuthGuard())->login($user, $remember);
        session()->regenerate();

        // Back to the page that sent the visitor to the login screen, like Filament's own
        // LoginResponse does: the panel's Authenticate middleware stored it as `url.intended`.
        // The panel URL is only the fallback for a visitor who opened the login page directly.
        // Read from the session rather than through `redirect()->intended()`: inside a Livewire
        // request on Livewire 3 `redirect()` is Livewire's own Redirector, which has no target URL.
        $this->redirect((string) session()->pull('url.intended', $this->redirectUrl ?: url('/')), navigate: false);
    }

    protected function fail(?string $message = null): void
    {
        session()->flash('authenticatePasskey::message', $message ?? __('filament-passkeys::login_button.errors.invalid'));
    }
}
