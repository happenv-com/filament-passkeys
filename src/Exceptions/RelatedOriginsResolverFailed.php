<?php

declare(strict_types=1);

namespace Happenv\FilamentPasskeys\Exceptions;

use RuntimeException;
use Throwable;

/**
 * The app's related origins resolver threw. Wrapped so a ceremony can tell it
 * apart from a rejected passkey and let it surface instead of failing quietly.
 */
class RelatedOriginsResolverFailed extends RuntimeException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct("The related origins resolver failed: {$previous->getMessage()}", 0, $previous);
    }
}
