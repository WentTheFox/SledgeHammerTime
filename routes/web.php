<?php

use App\Enums\RouteName;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ApiInfoController;
use App\Http\Controllers\ApiKeyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotInfoController;
use App\Http\Controllers\BotSettingsController;
use App\Http\Controllers\CreditOverrideController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalSettingsController;
use App\Http\Controllers\LocalUserInfoController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\TimeSyncController;
use App\Http\Controllers\TranslationProgressController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$languages = config('languages');
$uiLocaleValues = array_keys($languages['ui_locale_map']);
// When disabled, every route that starts or completes a login is left unregistered (so it 404s),
// and the frontend's safeRoute() sees them as missing and hides the links pointing at them
$loginEnabled = config('auth.login_enabled');

if ($loginEnabled){
  Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'login']);

    Route::get('/oauth/callback/{provider}', [AuthController::class, 'callbackGuest']);
  });
}

Route::middleware('auth')->group(function () use ($loginEnabled) {
  Route::patch('/profile', [ProfileController::class, 'update'])->name(RouteName::PROFILE_UPDATE->value);
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name(RouteName::PROFILE_DESTROY->value);
  Route::put('/settings/{discordUserId}', [BotSettingsController::class, 'set'])->name(RouteName::SETTINGS_SET->value);
  Route::post('/api-keys', [ApiKeyController::class, 'store'])->name(RouteName::API_KEYS_STORE->value);
  Route::post('/api-keys/{tokenId}/rotate', [ApiKeyController::class, 'rotate'])->name(RouteName::API_KEYS_ROTATE->value)->whereNumber('tokenId');
  Route::delete('/api-keys/{tokenId}', [ApiKeyController::class, 'destroy'])->name(RouteName::API_KEYS_DESTROY->value)->whereNumber('tokenId');
  Route::post('logout', [AuthController::class, 'logout'])->name(RouteName::LOGOUT->value);
  if ($loginEnabled){
    Route::get('/oauth/callback-auth/{provider}', [AuthController::class, 'callbackAuthenticated']);
  }

  Route::middleware('translator')->group(function () {
    Route::put('/credit-overrides/{crowdinUser}/{languageCode}', [CreditOverrideController::class, 'upsert'])->name(RouteName::CREDIT_OVERRIDES_UPSERT->value)->where('languageCode', '[a-zA-Z0-9-]+');
    Route::put('/credit-overrides/{crowdinUser}/{languageCode}/copy', [CreditOverrideController::class, 'copy'])->name(RouteName::CREDIT_OVERRIDES_COPY->value)->where('languageCode', '[a-zA-Z0-9-]+');
    Route::delete('/credit-overrides/{crowdinUser}/{languageCode}', [CreditOverrideController::class, 'deleteOverride'])->name(RouteName::CREDIT_OVERRIDES_DELETE->value)->where('languageCode', '[a-zA-Z0-9-]+');
    Route::delete('/credit-overrides/{crowdinUser}/{languageCode}/proposal', [CreditOverrideController::class, 'cancelProposal'])->name(RouteName::CREDIT_OVERRIDES_CANCEL_PROPOSAL->value)->where('languageCode', '[a-zA-Z0-9-]+');
  });
});

// Vue frontend API
Route::prefix('/frontend')->group(function () {
  Route::get('/app-usage', [BotInfoController::class, 'usage'])->name(RouteName::APP_USAGE->value);
  Route::get('/local-settings', [LocalSettingsController::class, 'get'])->name(RouteName::APP_GET_LOCAL_SETTINGS->value);
  Route::post('/local-settings', [LocalSettingsController::class, 'persist'])->name(RouteName::APP_PERSIST_LOCAL_SETTINGS->value);
  Route::get('/ntp', [TimeSyncController::class, 'ntp'])->name(RouteName::APP_NTP->value);
  Route::get('/local-user-info/{provider}/{id}', [LocalUserInfoController::class, 'forProvider'])->name(RouteName::APP_LOCAL_USER_INFO->value);
  Route::get('/user-info', [AuthController::class, 'userInfo'])->name(RouteName::APP_USER_INFO->value);
  Route::get('/webhook-delivery-stats', [BotInfoController::class, 'webhookDeliveryStats'])->name(RouteName::APP_WEBHOOK_DELIVERY_STATS->value);
  if (config('analytics.enabled')){
    Route::get('/analytics', [AnalyticsController::class, 'data'])->name(RouteName::APP_ANALYTICS->value);
  }
  Route::get('/translation-progress/{locale}', [TranslationProgressController::class, 'progress'])->name(RouteName::APP_TRANSLATION_PROGRESS->value);
});

Route::get('/sitemap.xml', [SitemapController::class, 'sitemap'])->name(RouteName::SITEMAP->value);
Route::get('/status', [StaticController::class, 'status'])->name(RouteName::STATUS->value);
Route::get('/discord', [RedirectController::class, 'discord']);
Route::get('/bot-login', [NotFoundController::class, 'notFound']);
Route::get('/bot-login/{discordUserId}', [NotFoundController::class, 'notFound']);
if ($loginEnabled){
  Route::get('/bot-login/{discordUserId}/{locale}', [AuthController::class, 'botLogin'])->name(RouteName::BOT_LOGIN->value);
}
Route::get('/', [HomeController::class, 'localeRedirect'])->name(RouteName::ROOT->value);
Route::get('/{locale}', [HomeController::class, 'index'])->whereIn('locale', $uiLocaleValues)->name(RouteName::HOME->value);
Route::get('/{locale}/discord', [RedirectController::class, 'discord'])->whereIn('locale', $uiLocaleValues)->name(RouteName::DISCORD->value);
if ($loginEnabled){
  Route::get('/{locale}/oauth/redirect/{provider}', [AuthController::class, 'redirect'])->whereIn('locale', $uiLocaleValues)->name(RouteName::OAUTH_REDIRECT->value);
}

$defineRoutes = function (bool $inLocaleGroup) use ($loginEnabled) {
  $settingsRoute = Route::middleware('auth')->get('/settings', [BotSettingsController::class, 'edit']);
  $profileEditRoute = Route::middleware('auth')->get('/profile', [ProfileController::class, 'edit']);
  $addBotRedirectRoute = Route::get('/add-bot/{installType}', [RedirectController::class, 'addBotLink']);
  $designRoute = Route::get('/design', [StaticController::class, 'design']);
  $legalRoute = Route::get('/legal', [StaticController::class, 'legal']);
  if ($loginEnabled){
    $loginRoute = Route::get('/login', [AuthController::class, 'login']);
  }
  $botInfoRoute = Route::get('/app', [BotInfoController::class, 'index']);
  $apiInfoRoute = Route::get('/api', [ApiInfoController::class, 'index']);
  $analyticsEnabled = config('analytics.enabled');
  if ($analyticsEnabled){
    // Same lifetime as the page data cache in AnalyticsController (analytics.cache_ttl_minutes), so a hit here never serves older data than that cache would.
    $analyticsRoute = Route::get('/analytics', [AnalyticsController::class, 'index']);
  }
  Route::get('/add-bot', [StaticController::class, 'addBot'])->name($inLocaleGroup ? 'addBot' : 'addBotNoLocale');

  if ($loginEnabled){
    Route::middleware('guest')->get('/oauth/callback/{provider}', [AuthController::class, 'callbackGuest']);
    Route::middleware('auth')->get('/oauth/callback-auth/{provider}', [AuthController::class, 'callbackAuthenticated']);
  }

  if ($inLocaleGroup){
    if (isset($analyticsRoute)){
      $analyticsRoute->name(RouteName::ANALYTICS->value);
    }
    if (isset($loginRoute)){
      $loginRoute->name(RouteName::LOGIN->value);
    }
    $settingsRoute->name(RouteName::SETTINGS->value);
    $profileEditRoute->name(RouteName::PROFILE_EDIT->value);
    $addBotRedirectRoute->name(RouteName::ADD_BOT_REDIRECT->value);
    $designRoute->name(RouteName::DESIGN->value);
    $legalRoute->name(RouteName::LEGAL->value);
    $botInfoRoute->name(RouteName::BOT_INFO->value);
    $apiInfoRoute->name(RouteName::API->value);
  }
};
Route::prefix('/{locale}')->group(function () use ($defineRoutes) {
  $defineRoutes(true);
})->whereIn('locale', $uiLocaleValues);
$defineRoutes(false);

Route::fallback([NotFoundController::class, 'notFound']);
