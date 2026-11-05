<?php

declare(strict_types=1);

namespace Happenv\FilamentPasskeys\Exceptions;

use RuntimeException;

/**
 * The related origins span more hosts than browsers honour. Browsers silently
 * ignore origins beyond their limit, so the list is refused instead of truncated.
 */
class TooManyRelatedOrigins extends RuntimeException
{
    public function __construct(
        public readonly int $count,
        public readonly int $limit,
    ) {
        parent::__construct("The related origins span {$count} distinct hosts, more than the limit of {$limit} set by [filament-passkeys.related_origins.max_origins]. Browsers ignore origins beyond their limit, so passkeys would fail on some of them.");
    }
}
