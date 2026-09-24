<?php

namespace Happenv\FilamentPasskeys\Tests\Support;

use CBOR\ByteStringObject;
use CBOR\MapObject;
use CBOR\NegativeIntegerObject;
use CBOR\TextStringObject;
use CBOR\UnsignedIntegerObject;
use OpenSSLAsymmetricKey;
use ParagonIE\ConstantTime\Base64UrlSafe;
use stdClass;

/**
 * A software authenticator that produces the same JSON a browser hands back from
 * navigator.credentials.create() / get(), signed with a real P-256 key.
 */
class VirtualAuthenticator
{
    public readonly string $credentialId;

    protected OpenSSLAsymmetricKey $key;

    protected int $counter = 0;

    public function __construct(
        protected string $origin = 'http://localhost',
        protected string $rpId = 'localhost',
        protected string $aaguid = '00000000-0000-0000-0000-000000000000',
    ) {
        $this->key = openssl_pkey_new([
            'private_key_type' => OPENSSL_KEYTYPE_EC,
            'curve_name' => 'prime256v1',
        ]);

        $this->credentialId = random_bytes(32);
    }

    /**
     * @param  array<string, mixed>  $options  Creation options in their browser (JSON) form.
     */
    public function register(array $options): string
    {
        $clientData = $this->clientData('webauthn.create', $options['challenge']);

        $attestedCredentialData = hex2bin(str_replace('-', '', $this->aaguid))
            .pack('n', strlen($this->credentialId))
            .$this->credentialId
            .$this->coseKey();

        $attestationObject = MapObject::create()
            ->add(TextStringObject::create('fmt'), TextStringObject::create('none'))
            ->add(TextStringObject::create('attStmt'), MapObject::create())
            ->add(TextStringObject::create('authData'), ByteStringObject::create(
                $this->authenticatorData(flags: 0x01 | 0x04 | 0x40).$attestedCredentialData
            ));

        return $this->credential([
            'clientDataJSON' => Base64UrlSafe::encodeUnpadded($clientData),
            'attestationObject' => Base64UrlSafe::encodeUnpadded((string) $attestationObject),
            'transports' => ['internal'],
        ]);
    }

    /**
     * @param  array<string, mixed>  $options  Request options in their browser (JSON) form.
     */
    public function authenticate(array $options, string $userHandle): string
    {
        $clientData = $this->clientData('webauthn.get', $options['challenge']);
        $authenticatorData = $this->authenticatorData(flags: 0x01 | 0x04, counter: ++$this->counter);

        openssl_sign($authenticatorData.hash('sha256', $clientData, true), $signature, $this->key, OPENSSL_ALGO_SHA256);

        return $this->credential([
            'clientDataJSON' => Base64UrlSafe::encodeUnpadded($clientData),
            'authenticatorData' => Base64UrlSafe::encodeUnpadded($authenticatorData),
            'signature' => Base64UrlSafe::encodeUnpadded($signature),
            'userHandle' => Base64UrlSafe::encodeUnpadded($userHandle),
        ]);
    }

    protected function clientData(string $type, string $challenge): string
    {
        return json_encode([
            'type' => $type,
            'challenge' => $challenge,
            'origin' => $this->origin,
            'crossOrigin' => false,
        ], JSON_UNESCAPED_SLASHES);
    }

    protected function authenticatorData(int $flags, int $counter = 0): string
    {
        return hash('sha256', $this->rpId, true).chr($flags).pack('N', $counter);
    }

    protected function coseKey(): string
    {
        $details = openssl_pkey_get_details($this->key)['ec'];

        return (string) MapObject::create()
            ->add(UnsignedIntegerObject::create(1), UnsignedIntegerObject::create(2))
            ->add(UnsignedIntegerObject::create(3), NegativeIntegerObject::create(-7))
            ->add(NegativeIntegerObject::create(-1), UnsignedIntegerObject::create(1))
            ->add(NegativeIntegerObject::create(-2), ByteStringObject::create(str_pad($details['x'], 32, "\0", STR_PAD_LEFT)))
            ->add(NegativeIntegerObject::create(-3), ByteStringObject::create(str_pad($details['y'], 32, "\0", STR_PAD_LEFT)));
    }

    /**
     * @param  array<string, mixed>  $response
     */
    protected function credential(array $response): string
    {
        $id = Base64UrlSafe::encodeUnpadded($this->credentialId);

        return json_encode([
            'id' => $id,
            'rawId' => $id,
            'type' => 'public-key',
            'response' => $response,
            'clientExtensionResults' => new stdClass,
        ], JSON_UNESCAPED_SLASHES);
    }
}
