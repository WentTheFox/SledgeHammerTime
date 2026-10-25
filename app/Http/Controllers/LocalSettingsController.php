<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersistLocalSettings;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class LocalSettingsController extends Controller {
  public function get(Request $request):JsonResponse {
    $cookieValue = json_decode(
      $request->cookie(config('app.settings_cookie_name')),
      depth: 2,
      flags: JSON_THROW_ON_ERROR
    ) ?? [];

    return response()->json($cookieValue);
  }

  public function persist(PersistLocalSettings $request):JsonResponse|Response {
    $data = $request->validated();
    $allKeys = array_keys($request->post());
    $extraKeys = [];
    foreach ($allKeys as $key){
      if (!array_key_exists($key, $data)){
        $extraKeys[] = $key;
      }
    }
    if (count($extraKeys) > 0){
      Log::warning(sprintf(
        "%s: Unsupported settings provided and were ignored (%s)",
        __METHOD__,
        implode(', ', $extraKeys)
      ));
    }

    $cookieValue = json_encode($data, JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING, 2);

    return response($cookieValue)->withCookie(cookie(
      name: config('app.settings_cookie_name'),
      value: $cookieValue,
      sameSite: 'Lax',
      path: '/',
      minutes: 60 * 24 * 365,
    ))->withHeaders(['content-type' => 'text/plain']);
  }
}
