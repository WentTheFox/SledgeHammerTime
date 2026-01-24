<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class StaticController extends Controller {
  public function addBot() {
    return Inertia::render('AddApp/IndexComponent');
  }

  public function design() {
    return Inertia::render('Design/IndexComponent');
  }

  public function legal() {
    return Inertia::render('Legal/IndexComponent');
  }

  public function status() {
    return response()->json(['status' => 'OK'])->setCache(['private' => true, 'no_cache' => true]);
  }
}
