<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Inertia\Inertia;
use Inertia\Response as InertiaResponse;

class StaticController extends Controller {
  public function addBot():InertiaResponse {
    return Inertia::render('AddApp/IndexComponent');
  }

  public function design():InertiaResponse {
    return Inertia::render('Design/IndexComponent');
  }

  public function legal():InertiaResponse {
    return Inertia::render('Legal/IndexComponent');
  }

  public function status():InertiaResponse {
    App::setLocale(config('app.fallback_locale'));

    return Inertia::render('Status/IndexComponent');
  }
}
