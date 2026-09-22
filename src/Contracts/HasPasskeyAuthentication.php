<?php

namespace Happenv\FilamentMultiFactorPasskeys\Contracts;

use Spatie\LaravelPasskeys\Models\Concerns\HasPasskeys;

interface HasPasskeyAuthentication extends HasPasskeys
{
    public function hasPasskeyAuthentication(): bool;
}
