<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomeController extends Controller {
  function index() {
    return Inertia::render('Picker/PickerView');
  }

  function discord() {
    $inviteUrl = config('services.discord.invite_url');
    if (empty($inviteUrl)){
      throw new NotFoundHttpException();
    }

    return redirect($inviteUrl);
  }
}
