<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTimeZone;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller {
  function index() {
    $currentTime = new Carbon(timezone: new DateTimeZone('GMT'))->setSeconds(0)->getTimestamp();

    return Inertia::render('Picker/IndexComponent', [
      'initialUtcDate' => gmdate('Y-m-d', $currentTime),
      'initialUtcTime' => gmdate('H:i:s', $currentTime),
      'initialTimestamp' => $currentTime,
    ]);
  }

  function discord() {
    $inviteUrl = config('services.discord.invite_url');
    if (empty($inviteUrl)){
      throw new NotFoundHttpException();
    }

    return redirect($inviteUrl);
  }
}
