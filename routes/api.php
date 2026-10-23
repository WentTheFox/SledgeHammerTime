<?php

use App\Enums\ApiKeyScope;
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

  // The bot's endpoints: its own user, and a token that is allowed to be the bot (not the service key of the API server)
  Route::middleware(['console-user', 'ability:'.ApiKeyScope::BOT_ENDPOINTS])->group(function () {
    Route::post('/login-link/{discordUserId}/{locale}', [BotApiController::class, 'loginLink']);
    Route::get('/settings/{discordUserId}', [BotApiController::class, 'settings']);
    Route::post('/webhook-deliveries', [BotApiController::class, 'storeWebhookDelivery']);
    Route::put('/bot-commands', [BotApiController::class, 'updateBotCommands']);
    Route::put('/bot-timezones', [BotApiController::class, 'updateBotTimezones']);
    Route::post('/command-telemetry', [BotApiController::class, 'commandTelemetry']);
    Route::post('/import-crowdin-translators', [BotApiController::class, 'importCrowdinTranslators']);
    Route::post('/credit-overrides/{proposal}/review', [BotApiController::class, 'reviewCreditOverride']);
    Route::put('/faq-entries', [BotApiController::class, 'updateFaqEntries']);
  });
});
