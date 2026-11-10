<?php

namespace App\Http\Controllers;

use App\Support\ReadOnlyMode;
use Illuminate\Http\JsonResponse;

class TimeSyncController extends Controller {
  /**
   * Served outside the page cache on purpose: the flag changes at deploy time, while cached pages live for 24 hours.
   */
  public function readOnly(): JsonResponse {
    return response()->json(['readOnly' => ReadOnlyMode::isActive()])
      ->header('Cache-Control', 'no-store');
  }

  public function ntp(): JsonResponse {
    $startTime = defined('LARAVEL_START') ? constant('LARAVEL_START') : microtime(true);

    return response()->json([
      'requestTs' => round($startTime * 1e3),
      'responseTs' => now()->getTimeStampMs(),
    ]);
  }
}
