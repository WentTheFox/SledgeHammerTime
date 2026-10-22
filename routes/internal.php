<?php

use App\Http\Controllers\InternalApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Internal routes
|--------------------------------------------------------------------------
|
| Used by the API server only. They are not part of the "api" group on purpose: that one throttles per
| IP address, and the API server makes several calls for every request it gets. The shared secret is
| checked by the internal-service middleware.
|
*/

Route::post('/keys/validate', [InternalApiController::class, 'validateKey']);
Route::get('/settings/{discordUserId}', [InternalApiController::class, 'settings'])->whereNumber('discordUserId');
Route::patch('/settings/{discordUserId}', [InternalApiController::class, 'updateSettings'])->whereNumber('discordUserId');
Route::post('/command-telemetry', [InternalApiController::class, 'commandTelemetry']);
