<?php

use Filament\Actions\Testing\TestAction;
use Filament\Auth\Pages\EditProfile;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Happenv\FilamentPasskeys\Exceptions\RelatedOriginsResolverFailed;
use Happenv\FilamentPasskeys\Exceptions\TooManyRelatedOrigins;
use Happenv\FilamentPasskeys\FilamentPasskeys;
use Happenv\FilamentPasskeys\FilamentPasskeysServiceProvider;
use Happenv\FilamentPasskeys\Livewire\AuthenticatePasskey;
use Happenv\FilamentPasskeys\PasskeyAuthentication;
use Happenv\FilamentPasskeys\Tests\Fixtures\User;
use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Exceptions;
use Laravel\Passkeys\Passkeys;
use Livewire\Features\SupportDisablingBackButtonCache\SupportDisablingBackButtonCache;
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
 * Boot the service provider again with `filament-passkeys.related_origins.enabled`
 * set, as an app that enables it does.
 */
function enableRelatedOriginsRoute(): void
{
    config()->set('filament-passkeys.related_origins.enabled', true);

    app()->register(FilamentPasskeysServiceProvider::class, force: true);
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
    beforeEach(function (): void {
        // Livewire::test() renders outside HTTP, so a Filament page rendered by an
        // earlier test leaves this flag on and Livewire's global middleware would
        // add no-cache headers. A real request resets it after every response.
        SupportDisablingBackButtonCache::$disableBackButtonCache = false;
    });

    it('is not registered by default', function (): void {
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        expect(config('filament-passkeys.related_origins.enabled'))->toBeFalse()
            ->and(Route::has('filament-passkeys.related-origins'))->toBeFalse();

        get('/.well-known/webauthn')->assertNotFound();
    });

    it('lists the normalised related origins, then the RP ID origin', function (): void {
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
            'https://user:secret@shop.customer.test',
            'https://shöp.customer.test',
            'https://1.2.3.4',
            'https://shop.customer.test.',
            'https://customer',
            'https://shop.customer.test:0',
            'http://app.localhost:8000',
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
                'https://shop.customer.test',
                'https://other.customer.test:8443',
                'http://app.localhost:8000',
                'https://acme.example.test',
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
            ->toBe(['https://shop.acme.test', 'https://acme.example.test']);

        get('https://example.test/.well-known/webauthn')->assertNotFound();
    });

    it('falls back to the configured origins without a resolver', function (): void {
        config()->set('passkeys.relying_party_id', 'acme.example.test');
        config()->set('filament-passkeys.related_origins.origins', ['https://shop.customer.test/']);
        enableRelatedOriginsRoute();

        expect(get('/.well-known/webauthn')->assertOk()->json('origins'))
            ->toBe(['https://shop.customer.test', 'https://acme.example.test']);
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
        expect(config('passkeys.allowed_origins'))->toBe(['http://localhost']);
    });

    it('restores the outer allowed origins after a nested ceremony', function (): void {
        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        [$outer, $inner, $afterInner] = FilamentPasskeys::withRelatedOrigins(fn (): array => [
            Passkeys::allowedOrigins(),
            FilamentPasskeys::withRelatedOrigins(fn (): array => Passkeys::allowedOrigins()),
            Passkeys::allowedOrigins(),
        ]);

        expect($outer)->toBe(['http://localhost', 'https://shop.customer.test', 'https://localhost'])
            ->and($inner)->toBe($outer)
            ->and($afterInner)->toBe($outer)
            ->and(Passkeys::allowedOrigins())->toBe(['http://localhost']);
    });

    it('calls the resolver only to verify a ceremony, not to render or start it', function (): void {
        $calls = 0;
        FilamentPasskeys::relatedOriginsUsing(function () use (&$calls): array {
            $calls++;

            return ['https://shop.customer.test'];
        });

        $user = createUser();
        registerPasskey($user, $authenticator = new VirtualAuthenticator);

        $component = Livewire::test(AuthenticatePasskey::class, ['panel' => 'admin', 'redirectUrl' => '/admin'])
            ->call('getOptions');

        expect($calls)->toBe(0);

        $options = browserOptionsFromSession(AuthenticatePasskey::OPTIONS_SESSION_KEY, PublicKeyCredentialRequestOptions::class);
        $component->call('authenticate', $authenticator->onOrigin('https://shop.customer.test')->authenticate($options, $user->getPasskeyUserHandle()));

        expect($calls)->toBe(1);
        assertAuthenticatedAs($user);
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
            'max_origins' => 5,
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

/**
 * The given number of origins, each on its own host.
 *
 * @return list<string>
 */
function originsOnDistinctHosts(int $count): array
{
    return array_map(fn (int $index): string => "https://shop.customer{$index}.test", range(1, $count));
}

describe('the related origins limit', function (): void {
    it('defaults to 5 and follows the config', function (): void {
        expect(FilamentPasskeys::maxRelatedOrigins())->toBe(5);

        config()->set('filament-passkeys.related_origins.max_origins', 2);

        expect(FilamentPasskeys::maxRelatedOrigins())->toBe(2);
    });

    it('serves exactly as many hosts as the limit allows', function (): void {
        config()->set('passkeys.relying_party_id', 'acme.example.test');
        enableRelatedOriginsRoute();
        FilamentPasskeys::relatedOriginsUsing(fn (): array => originsOnDistinctHosts(5));

        // Every slot holds a related origin; the RP origin trails them.
        expect(get('https://acme.example.test/.well-known/webauthn')->assertOk()->json('origins'))
            ->toBe([...originsOnDistinctHosts(5), 'https://acme.example.test']);
    });

    it('refuses to serve one host more than the limit', function (): void {
        enableRelatedOriginsRoute();
        FilamentPasskeys::relatedOriginsUsing(fn (): array => originsOnDistinctHosts(6));

        $this->withoutExceptionHandling();

        get('/.well-known/webauthn');
    })->throws(TooManyRelatedOrigins::class, 'The related origins span 6 distinct hosts, more than the limit of 5 set by [filament-passkeys.related_origins.max_origins].');

    it('refuses a ceremony over the limit instead of failing it quietly', function (): void {
        FilamentPasskeys::relatedOriginsUsing(fn (): array => originsOnDistinctHosts(6));

        signInWithPasskeyFrom('https://shop.customer1.test');
    })->throws(TooManyRelatedOrigins::class);

    it('counts each host once, and not the RP ID host', function (): void {
        config()->set('passkeys.relying_party_id', 'acme.example.test');
        config()->set('filament-passkeys.related_origins.max_origins', 2);

        FilamentPasskeys::assertWithinRelatedOriginsLimit([
            'https://shop.customer1.test',
            'HTTPS://SHOP.customer1.test:443/',
            'https://shop.customer1.test:8443',
            'https://shop.customer2.test',
            'https://acme.example.test',
            'https://acme.example.test:8443',
            'http://insecure.customer3.test',
            'not an origin',
        ]);

        expect(fn () => FilamentPasskeys::assertWithinRelatedOriginsLimit(originsOnDistinctHosts(3)))
            ->toThrow(function (TooManyRelatedOrigins $exception): void {
                expect([$exception->count, $exception->limit])->toBe([3, 2]);
            });
    });

    it('applies a lower configured limit to the file', function (): void {
        config()->set('filament-passkeys.related_origins.max_origins', 1);
        enableRelatedOriginsRoute();
        FilamentPasskeys::relatedOriginsUsing(fn (): array => originsOnDistinctHosts(2));

        $this->withoutExceptionHandling();

        get('/.well-known/webauthn');
    })->throws(TooManyRelatedOrigins::class, 'limit of 1');
});

describe('a failing resolver', function (): void {
    beforeEach(function (): void {
        FilamentPasskeys::relatedOriginsUsing(fn (): array => throw new RuntimeException('Tenant database is down.'));
    });

    it('answers 500 on the route and is reported', function (): void {
        Exceptions::fake();
        enableRelatedOriginsRoute();

        get('/.well-known/webauthn')->assertInternalServerError();

        Exceptions::assertReported(fn (RelatedOriginsResolverFailed $exception): bool => $exception->getPrevious()?->getMessage() === 'Tenant database is down.');
    });

    it('surfaces from the login button without counting toward its rate limit', function (): void {
        $user = createUser();
        registerPasskey($user, $authenticator = new VirtualAuthenticator);

        $component = Livewire::test(AuthenticatePasskey::class, ['panel' => 'admin', 'redirectUrl' => '/admin'])
            ->call('getOptions');
        $options = browserOptionsFromSession(AuthenticatePasskey::OPTIONS_SESSION_KEY, PublicKeyCredentialRequestOptions::class);

        // More attempts than the limit of 5: none of them is the user's fault.
        foreach (range(1, 6) as $attempt) {
            expect(fn () => $component->call('authenticate', 'not even an assertion'))
                ->toThrow(RelatedOriginsResolverFailed::class, 'Tenant database is down.');
        }

        FilamentPasskeys::relatedOriginsUsing(fn (): array => ['https://shop.customer.test']);

        $component->call('authenticate', $authenticator->onOrigin('https://shop.customer.test')->authenticate($options, $user->getPasskeyUserHandle()));

        assertAuthenticatedAs($user);
    });

    it('surfaces from the multi-factor challenge', function (): void {
        Filament::setCurrentPanel('admin');
        $user = createUser();
        registerPasskey($user, $authenticator = new VirtualAuthenticator);

        $login = Livewire::test(Login::class)
            ->fillForm(['email' => $user->email, 'password' => 'password'])
            ->call('authenticate')
            ->callAction(TestAction::make('verifyWithPasskey')->schemaComponent('passkey.credential', schema: 'multiFactorChallengeForm'));

        $options = browserOptionsFromSession(PasskeyAuthentication::CHALLENGE_OPTIONS_SESSION_KEY, PublicKeyCredentialRequestOptions::class);

        expect(fn () => $login
            ->set('data.multiFactor.passkey.credential', $authenticator->authenticate($options, $user->getPasskeyUserHandle()))
            ->call('authenticate'))
            ->toThrow(RelatedOriginsResolverFailed::class);

        assertGuest();
    });

    it('surfaces from passkey set-up', function (): void {
        Filament::setCurrentPanel('admin');
        actingAs($user = createUser());

        $setUp = TestAction::make('setUpPasskeyAuthentication')->schemaComponent('passkey', schema: 'content');

        $page = Livewire::test(EditProfile::class)
            ->mountAction($setUp)
            ->setActionData(['name' => 'Phone'])
            ->callMountedAction();

        $options = browserOptionsFromSession(PasskeyAuthentication::REGISTRATION_OPTIONS_SESSION_KEY, PublicKeyCredentialCreationOptions::class);

        expect(fn () => $page
            ->setActionData(['credential' => (new VirtualAuthenticator)->register($options)])
            ->callMountedAction())
            ->toThrow(RelatedOriginsResolverFailed::class);

        expect($user->passkeys()->exists())->toBeFalse();
    });
});
