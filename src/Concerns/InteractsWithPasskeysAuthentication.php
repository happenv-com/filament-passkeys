<?php

namespace Happenv\FilamentMultiFactorPasskeys\Concerns;

use Happenv\FilamentMultiFactorPasskeys\Contracts\HasPasskeysAuthentication;
use Laravel\Passkeys\PasskeyAuthenticatable;

/**
 * @phpstan-require-implements HasPasskeysAuthentication
 */
trait InteractsWithPasskeysAuthentication
{
    use PasskeyAuthenticatable;
}
