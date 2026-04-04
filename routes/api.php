<?php

use App\Http\Controllers\BotApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
  Route::get('/user', [BotApiController::class, 'user']);
  Route::get('/crowdin-translator-credits', [BotApiController::class, 'getCrowdinTranslatorCredits']);

  Route::middleware('console-user')->group(function () {
    Route::post('/login-link/{discordUserId}/{locale}', [BotApiController::class, 'loginLink']);
    Route::get('/settings/{discordUserId}', [BotApiController::class, 'settings']);
    Route::post('/shard-statistics', [BotApiController::class, 'updateShardStats']);
    Route::put('/bot-commands', [BotApiController::class, 'updateBotCommands']);
    Route::put('/bot-timezones', [BotApiController::class, 'updateBotTimezones']);
    Route::post('/command-telemetry', [BotApiController::class, 'commandTelemetry']);
    Route::post('/import-crowdin-translators', [BotApiController::class, 'importCrowdinTranslators']);
    Route::post('/credit-overrides/{proposal}/review', [BotApiController::class, 'reviewCreditOverride']);
  });
});
