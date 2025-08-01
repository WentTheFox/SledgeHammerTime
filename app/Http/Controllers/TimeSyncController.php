<?php

namespace App\Http\Controllers;

class TimeSyncController extends Controller {
  public function ntp() {
    return response()->json([
      'requestTs' => round(LARAVEL_START * 1e3),
      'responseTs' => now()->getTimeStampMs(),
    ]);
  }
}
