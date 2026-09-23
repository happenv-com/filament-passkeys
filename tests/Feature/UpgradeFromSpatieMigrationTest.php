<?php

use Happenv\FilamentPasskeys\Tests\Support\VirtualAuthenticator;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Laravel\Passkeys\Actions\GenerateVerificationOptions;
use Laravel\Passkeys\Actions\VerifyPasskey;
use Laravel\Passkeys\Support\WebAuthn;
use Webauthn\PublicKeyCredential;

function runUpgradeMigration(): void
{
    (require __DIR__.'/../../database/migrations/upgrade_passkeys_table_from_spatie.php.stub')->up();
}

/**
 * Recreate the table spatie/laravel-passkeys ships, holding the given rows.
 *
 * @param  list<array<string, mixed>>  $rows
 */
function createSpatiePasskeysTable(array $rows): void
{
    Schema::drop('passkeys');

    Schema::create('passkeys', function (Blueprint $table) {
        $table->id();
        $table->foreignId('authenticatable_id')
            ->constrained(table: 'users', indexName: 'passkeys_authenticatable_fk')
            ->cascadeOnDelete();
        $table->text('name');
        $table->text('credential_id');
        $table->json('data');
        $table->timestamp('last_used_at')->nullable();
        $table->timestamps();
    });

    DB::table('passkeys')->insert($rows);
}

it('converts spatie passkeys into the laravel/passkeys schema', function () {
    $user = createUser();
    $passkey = registerPasskey($user, $authenticator = new VirtualAuthenticator, 'MacBook');
    $credential = $passkey->credential;

    createSpatiePasskeysTable([[
        'authenticatable_id' => $user->id,
        'name' => 'MacBook',
        // What mb_convert_encoding() leaves of raw bytes: not recoverable.
        'credential_id' => mb_convert_encoding($authenticator->credentialId, 'UTF-8'),
        'data' => json_encode($credential),
        'last_used_at' => '2026-01-02 03:04:05',
        'created_at' => '2026-01-01 00:00:00',
        'updated_at' => '2026-01-01 00:00:00',
    ]]);

    runUpgradeMigration();

    expect(Schema::getColumnListing('passkeys'))
        ->toEqualCanonicalizing(['id', 'user_id', 'name', 'credential_id', 'credential', 'last_used_at', 'created_at', 'updated_at']);

    $migrated = $user->passkeys()->sole();

    expect($migrated)
        ->name->toBe('MacBook')
        ->credential_id->toBe($credential['publicKeyCredentialId'])
        ->credential->toBe($credential)
        ->and($migrated->last_used_at->toDateTimeString())->toBe('2026-01-02 03:04:05');

    // The migrated passkey still completes a ceremony.
    $options = app(GenerateVerificationOptions::class)($user);

    $verified = app(VerifyPasskey::class)(
        WebAuthn::fromJson($authenticator->authenticate(WebAuthn::toBrowserArray($options), $user->getPasskeyUserHandle()), PublicKeyCredential::class),
        $options,
        $user,
    );

    expect($verified->is($migrated))->toBeTrue();
});

it('leaves a laravel/passkeys table untouched', function () {
    $user = createUser();
    $passkey = registerPasskey($user, new VirtualAuthenticator);

    runUpgradeMigration();

    expect($user->passkeys()->sole()->is($passkey))->toBeTrue();
});

it('refuses rows without a credential id instead of dropping them', function () {
    $user = createUser();

    createSpatiePasskeysTable([[
        'authenticatable_id' => $user->id,
        'name' => 'Broken',
        'credential_id' => 'x',
        'data' => json_encode(['counter' => 0]),
    ]]);

    expect(fn () => runUpgradeMigration())->toThrow(RuntimeException::class);
    expect(DB::table('passkeys')->count())->toBe(1);
});
