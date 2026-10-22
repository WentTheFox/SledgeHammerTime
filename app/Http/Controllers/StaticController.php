<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
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

  public function status(Request $request):InertiaResponse|JsonResponse {
    // Machine-readable variant for deploy health checks: `Accept: application/json`
    if ($request->expectsJson()){
      return $this->healthChecks();
    }

    App::setLocale(config('app.fallback_locale'));

    return Inertia::render('Status/IndexComponent');
  }

  /**
   * Read-only dependency checks, safe to run while the app is in read-only mode
   */
  private function healthChecks():JsonResponse {
    $checks = [];
    foreach (['database' => fn() => DB::select('select 1'), 'cache' => fn() => Cache::get('health-check')] as $name => $check){
      try {
        $check();
        $checks[$name] = true;
      }
      catch (\Throwable) {
        $checks[$name] = false;
      }
    }
    $healthy = !in_array(false, $checks, true);

    return response()->json(['status' => $healthy ? 'ok' : 'error', 'checks' => $checks], $healthy ? 200 : 503);
  }
}
