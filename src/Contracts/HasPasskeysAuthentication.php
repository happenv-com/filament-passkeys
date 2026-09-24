<?php

declare(strict_types=1);

namespace Happenv\FilamentPasskeys\Contracts;

use Laravel\Passkeys\Contracts\PasskeyUser;

interface HasPasskeysAuthentication extends PasskeyUser {}
