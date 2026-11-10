<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class TimeSyncController extends Controller {
  public function ntp(): JsonResponse {
    $startTime = defined('LARAVEL_START') ? constant('LARAVEL_START') : microtime(true);

    return response()->json([
      'requestTs' => round($startTime * 1e3),
      'responseTs' => now()->getTimeStampMs(),
    ]);
  }
}
