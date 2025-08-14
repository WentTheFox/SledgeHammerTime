<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class StaticController extends Controller {
  public function addBot() {
    return Inertia::render('AddApp/Index');
  }

  public function design() {
    return Inertia::render('Design/Index');
  }

  public function legal() {
    return Inertia::render('Legal/Index', [
      'fallbackLocale' => config('app.fallback_locale'),
    ]);
  }
}
