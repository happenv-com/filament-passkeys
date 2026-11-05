<?php

use Happenv\FilamentPasskeys\Http\Controllers\RelatedOriginsController;
use Illuminate\Support\Facades\Route;

// Outside the `web` group on purpose: no session, cookies or CSRF.
Route::get('.well-known/webauthn', RelatedOriginsController::class)
    ->middleware(config('filament-passkeys.related_origins.middleware', []))
    ->name('filament-passkeys.related-origins');
