<?php

declare(strict_types=1);

namespace Happenv\FilamentPasskeys\Http\Controllers;

use Happenv\FilamentPasskeys\FilamentPasskeys;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Serves the WebAuthn Related Origin Requests file (`/.well-known/webauthn`),
 * which browsers fetch from the RP ID's host to learn which other origins may
 * use the RP ID.
 *
 * @see https://www.w3.org/TR/webauthn-3/#sctn-validating-relation-origin
 */
class RelatedOriginsController
{
    public function __invoke(Request $request): JsonResponse | Response
    {
        $origins = FilamentPasskeys::webauthnOrigins($request);

        if ($origins === []) {
            return new Response('', 404);
        }

        $maxAge = max(0, (int) config('filament-passkeys.related_origins.cache_max_age', 300));

        return new JsonResponse(
            ['origins' => $origins],
            200,
            ['Cache-Control' => "public, max-age={$maxAge}"],
            JSON_UNESCAPED_SLASHES,
        );
    }
}
