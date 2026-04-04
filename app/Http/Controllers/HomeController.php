<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller {
  function index():InertiaResponse {
    $currentTime = new Carbon(timezone: new DateTimeZone('GMT'))->setSeconds(0)->getTimestamp();

    return Inertia::render('Picker/IndexComponent', [
      'initialUtcDate' => gmdate('Y-m-d', $currentTime),
      'initialUtcTime' => gmdate('H:i:s', $currentTime),
      'initialTimestamp' => $currentTime,
    ]);
  }

  function discord(): RedirectResponse {
    $inviteUrl = config('services.discord.invite_url');
    if (empty($inviteUrl)){
      throw new NotFoundHttpException();
    }

    return redirect($inviteUrl);
  }

  public function localeRedirect(): RedirectResponse {
    $appLocale = app()->getLocale();
    // ui_locale_map is keyed by UI locale and valued by app locale; invert to find the UI key.
    $uiLocale = array_search($appLocale, config('languages.ui_locale_map'), strict: true) ?: 'en';

    return to_route('home', ['locale' => $uiLocale]);
  }
}
