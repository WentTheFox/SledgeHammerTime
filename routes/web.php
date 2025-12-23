<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BotInfoController;
use App\Http\Controllers\BotSettingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalUserInfoController;
use App\Http\Controllers\NotFoundController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\StaticController;
use App\Http\Controllers\TimeSyncController;
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

Route::middleware('guest')->group(function () {
  Route::get('login', [AuthController::class, 'login']);

  Route::get('/oauth/callback/{provider}', [AuthController::class, 'callbackGuest']);
});

Route::middleware('auth')->group(function () {
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
  Route::put('/settings/{discordUserId}', [BotSettingsController::class, 'set'])->name('settings.set');
  Route::post('logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/oauth/callback-auth/{provider}', [AuthController::class, 'callbackAuthenticated']);
});

// Vue frontend API
Route::prefix('/frontend')->group(function () {
  Route::get('/app-usage', [BotInfoController::class, 'usage'])->name('app.usage');
  Route::get('/ntp', [TimeSyncController::class, 'ntp'])->name('app.ntp');
  Route::get('/local-user-info/{provider}/{id}', [LocalUserInfoController::class, 'forProvider'])->name('app.localUserInfo');
});

Route::get('/discord', [RedirectController::class, 'discord']);
Route::get('/bot-login', [NotFoundController::class, 'notFound']);
Route::get('/bot-login/{discordUserId}', [NotFoundController::class, 'notFound']);
Route::get('/bot-login/{discordUserId}/{locale}', [AuthController::class, 'botLogin'])->name('botLogin');
Route::get('/', [HomeController::class, 'index'])->name('root');
Route::get('/{locale}', [HomeController::class, 'index'])->whereIn('locale', $uiLocaleValues)->name('home');
Route::get('/{locale}/discord', [RedirectController::class, 'discord'])->whereIn('locale', $uiLocaleValues)->name('discord');
Route::get('/{locale}/oauth/redirect/{provider}', [AuthController::class, 'redirect'])->whereIn('locale', $uiLocaleValues)->name('oauthRedirect');

$defineRoutes = function (bool $inLocaleNgroup) {
  $settingsRoute = Route::middleware('auth')->get('/settings', [BotSettingsController::class, 'edit']);
  $profileEditRoute = Route::middleware('auth')->get('/profile', [ProfileController::class, 'edit']);
  $addBotRedirectRoute = Route::get('/add-bot/{installType}', [RedirectController::class, 'addBotLink']);
  $designRoute = Route::get('/design', [StaticController::class, 'design']);
  $legalRoute = Route::get('/legal', [StaticController::class, 'legal']);
  $loginRoute = Route::get('/login', [AuthController::class, 'login']);
  $botInfoRoute = Route::get('/app', [BotInfoController::class, 'index']);
  Route::get('/add-bot', [StaticController::class, 'addBot'])->name($inLocaleNgroup ? 'addBot' : 'addBotNoLocale');

  Route::middleware('guest')->get('/oauth/callback/{provider}', [AuthController::class, 'callbackGuest']);
  Route::middleware('auth')->get('/oauth/callback-auth/{provider}', [AuthController::class, 'callbackAuthenticated']);

  if ($inLocaleNgroup){
    $loginRoute->name('login');
    $settingsRoute->name('settings');
    $profileEditRoute->name('profile.edit');
    $addBotRedirectRoute->name('addBotRedirect');
    $designRoute->name('design');
    $legalRoute->name('legal');
    $botInfoRoute->name('botInfo');
  }
};
Route::prefix('/{locale}')->group(function () use ($defineRoutes) {
  $defineRoutes(true);
})->whereIn('locale', $uiLocaleValues);
$defineRoutes(false);

Route::fallback([NotFoundController::class, 'notFound']);
