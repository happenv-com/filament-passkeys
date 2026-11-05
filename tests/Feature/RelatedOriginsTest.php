<?php

use Filament\Actions\Testing\TestAction;
use Filament\Auth\Pages\EditProfile;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Happenv\FilamentPasskeys\FilamentPasskeys;
use Happenv\FilamentPasskeys\Livewire\AuthenticatePasskey;
use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Happenv\FilamentPasskeys\Tests\Fixtures\User;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Illuminate\Http\Request;
use Laravel\Passkeys\Passkeys;
use Livewire\Livewire;
use Webauthn\PublicKeyCredentialCreationOptions;
use Webauthn\PublicKeyCredentialRequestOptions;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;

afterEach(function (): void {
    FilamentPasskeys::relatedOriginsUsing(null);
});

/**
 * Register the route the way the service provider does when the app boots with
 * `filament-passkeys.related_origins.enabled` set.
 */
function enableRelatedOriginsRoute(): void
{
    config()->set('filament-passkeys.related_origins.enabled', true);

    require dirname(__DIR__, 2) . '/routes/related-origins.php';
}

/**
 * Sign in with the passkey login button using an assertion made on the given origin.
 */
function signInWithPasskeyFrom(string $origin): User
{
    $user = createUser();
    registerPasskey($user, $authenticator = new VirtualAuthenticator);

    $component = Livewire::test(AuthenticatePasskey::class, ['panel' => 'admin', 'redirectUrl' => '/admin'])
        ->call('getOptions');

    $options = browserOptionsFromSession(AuthenticatePasskey::OPTIONS_SESSION_KEY, PublicKeyCredentialRequestOptions::class);

    $component->call('authenticate', $authenticator->onOrigin($origin)->authenticate($options, $user->getPasskeyUserHandle()));

    return $user;
}

describe('the /.well-known/webauthn route', function (): void {
    it('is not registered by default', function (): void {
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        expect(config('filament-passkeys.related_origins.enabled'))->toBeFalse()
            ->and(Route::has('filament-passkeys.related-origins'))->toBeFalse();

        get('/.well-known/webauthn')->assertNotFound();
    });

    it('lists the RP ID origin first, then the normalised related origins', function (): void {
        config()->set('passkeys.relying_party_id', 'acme.example.test');
        enableRelatedOriginsRoute();

        FilamentPasskeys::relatedOriginsUsing(fn (): array => [
            'https://shop.customer.test',
            'HTTPS://Shop.Customer.TEST:443/',
            'https://acme.example.test',
            'https://other.customer.test:8443',
            'http://insecure.customer.test',
            'https://shop.customer.test/login',
            'shop.customer.test',
            'not an origin',
            '',
            42,
        ]);

        $response = get('https://acme.example.test/.well-known/webauthn')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/json')
            ->assertHeaderMissing('Set-Cookie');

        expect($response->json())->toBe([
            'origins' => [
                'https://acme.example.test',
                'https://shop.customer.test',
                'https://other.customer.test:8443',
            ],
        ])
            ->and($response->headers->getCookies())->toBeEmpty()
            ->and($response->headers->getCacheControlDirective('public'))->toBeTrue()
            ->and($response->headers->getCacheControlDirective('max-age'))->toBe('300');
    });

    it('uses the configured cache lifetime', function (): void {
        config()->set('filament-passkeys.related_origins.cache_max_age', 60);
        enableRelatedOriginsRoute();
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        expect(get('/.well-known/webauthn')->headers->getCacheControlDirective('max-age'))->toBe('60');
    });

    it('answers 404 without related origins', function (array $origins): void {
        config()->set('passkeys.relying_party_id', 'acme.example.test');
        enableRelatedOriginsRoute();
        FilamentPasskeys::relatedOriginsUsing(fn (): array => $origins);

        get('https://acme.example.test/.well-known/webauthn')
            ->assertNotFound()
            ->assertHeaderMissing('Set-Cookie');
    })->with([
        'none' => [[]],
        'only the RP ID origin' => [['https://acme.example.test']],
        'only invalid entries' => [['http://shop.customer.test', 'ftp://shop.customer.test']],
    ]);

    it('hands the request to the resolver', function (): void {
        config()->set('passkeys.relying_party_id', 'acme.example.test');
        enableRelatedOriginsRoute();

        // A multi-tenant app: the tenant's host lists that tenant's domains, any other host none.
        FilamentPasskeys::relatedOriginsUsing(fn (Request $request): array => match ($request->getHost()) {
            'acme.example.test' => ['https://shop.acme.test'],
            default => [],
        });

        expect(get('https://acme.example.test/.well-known/webauthn')->assertOk()->json('origins'))
            ->toBe(['https://acme.example.test', 'https://shop.acme.test']);

        get('https://example.test/.well-known/webauthn')->assertNotFound();
    });

    it('falls back to the configured origins without a resolver', function (): void {
        config()->set('passkeys.relying_party_id', 'acme.example.test');
        config()->set('filament-passkeys.related_origins.origins', ['https://shop.customer.test/']);
        enableRelatedOriginsRoute();

        expect(get('/.well-known/webauthn')->assertOk()->json('origins'))
            ->toBe(['https://acme.example.test', 'https://shop.customer.test']);
    });
});

describe('server-side verification', function (): void {
    it('accepts an assertion from a related origin', function (): void {
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        $user = signInWithPasskeyFrom('https://shop.customer.test');

        assertAuthenticatedAs($user);

        // Only for the ceremony: the configured allowed origins are left as they were.
        expect(config('passkeys.allowed_origins'))->toBe(['http://localhost']);
    });

    it('rejects an assertion from an origin that is not listed', function (): void {
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        signInWithPasskeyFrom('https://evil.example.test');

        assertGuest();
    });

    it('rejects a related origin when none are configured, as before', function (): void {
        signInWithPasskeyFrom('https://shop.customer.test');

        assertGuest();
    });

    it('accepts the configured origins without a resolver', function (): void {
        config()->set('filament-passkeys.related_origins.origins', ['https://shop.customer.test']);

        assertAuthenticatedAs(signInWithPasskeyFrom('https://shop.customer.test'));
    });

    it('accepts a multi-factor challenge from a related origin', function (): void {
        Filament::setCurrentPanel('admin');
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        $user = createUser();
        registerPasskey($user, $authenticator = new VirtualAuthenticator);

        $login = Livewire::test(Login::class)
            ->fillForm(['email' => $user->email, 'password' => 'password'])
            ->call('authenticate')
            ->callAction(TestAction::make('verifyWithPasskey')->schemaComponent('passkey.credential', schema: 'multiFactorChallengeForm'));

        $options = browserOptionsFromSession(PasskeyAuthentication::CHALLENGE_OPTIONS_SESSION_KEY, PublicKeyCredentialRequestOptions::class);

        $login
            ->set('data.multiFactor.passkey.credential', $authenticator->onOrigin('https://shop.customer.test')->authenticate($options, $user->getPasskeyUserHandle()))
            ->call('authenticate')
            ->assertHasNoFormErrors();

        assertAuthenticatedAs($user);
    });

    it('registers a passkey from a related origin', function (): void {
        Filament::setCurrentPanel('admin');
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);
        actingAs($user = createUser());

        $setUp = TestAction::make('setUpPasskeyAuthentication')->schemaComponent('passkey', schema: 'content');

        $page = Livewire::test(EditProfile::class)
            ->mountAction($setUp)
            ->setActionData(['name' => 'Phone'])
            ->callMountedAction();

        $options = browserOptionsFromSession(PasskeyAuthentication::REGISTRATION_OPTIONS_SESSION_KEY, PublicKeyCredentialCreationOptions::class);

        $page
            ->setActionData(['credential' => (new VirtualAuthenticator('https://shop.customer.test'))->register($options)])
            ->callMountedAction()
            ->assertHasNoActionErrors();

        expect($user->passkeys()->sole()->name)->toBe('Phone');
    });
});

describe('without related origins (the default)', function (): void {
    it('registers no route', function (): void {
        expect(config('filament-passkeys.related_origins'))->toBe([
            'enabled' => false,
            'origins' => [],
            'middleware' => [],
            'cache_max_age' => 300,
        ])
            ->and(Route::has('filament-passkeys.related-origins'))->toBeFalse()
            ->and(collect(Route::getRoutes()->getRoutes())->contains(fn ($route): bool => $route->uri() === '.well-known/webauthn'))->toBeFalse();
    });

    it('leaves the laravel/passkeys allowed origins untouched during a ceremony', function (?Closure $resolver): void {
        FilamentPasskeys::relatedOriginsUsing($resolver);
        $defaults = Passkeys::allowedOrigins();

        // What the ceremony validator reads: WebAuthn::ceremonyStepManagerFactory() calls Passkeys::allowedOrigins().
        $duringCeremony = FilamentPasskeys::withRelatedOrigins(fn (): array => Passkeys::allowedOrigins());

        expect($defaults)->toBe([config('app.url')])
            ->and($duringCeremony)->toBe($defaults)
            ->and(Passkeys::allowedOrigins())->toBe($defaults);
    })->with([
        'no resolver, no configured origins' => [null],
        'a resolver returning nothing' => [fn (): Closure => fn (): array => []],
    ]);

    it('still accepts an assertion from the app url origin', function (): void {
        assertAuthenticatedAs(signInWithPasskeyFrom(config('app.url')));
    });

    it('still accepts the app url origin when related origins are added', function (): void {
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        assertAuthenticatedAs(signInWithPasskeyFrom(config('app.url')));
    });
});
