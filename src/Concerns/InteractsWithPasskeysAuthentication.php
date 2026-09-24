<?php

declare(strict_types=1);

namespace Happenv\FilamentPasskeys\Concerns;

use Happenv\FilamentPasskeys\Contracts\HasPasskeysAuthentication;
use Laravel\Passkeys\PasskeyAuthenticatable;

/**
 * @phpstan-require-implements HasPasskeysAuthentication
 */
trait InteractsWithPasskeysAuthentication
{
    use PasskeyAuthenticatable;
}
