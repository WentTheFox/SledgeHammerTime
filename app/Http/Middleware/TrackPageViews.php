<?php

namespace App\Http\Middleware;

use App\Jobs\RecordPageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews
{
  const TRACKED_ROUTE_IS_LOCALIZED_MAP = [
    'root' => true,
    'home' => true,
    'login' => true,
    'settings' => true,
    'profile.edit' => true,
    'design' => true,
    'legal' => true,
    'botInfo' => true,
    'addBot' => true,
    'addBotNoLocale' => true,
    'app.usage' => false,
    'app.ntp' => false,
    'app.localUserInfo' => false,
  ];

  /**
   * Handle an incoming request.
   *
   * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
   */
  public function handle(Request $request, Closure $next): Response
  {
    $response = $next($request);
    if ($request->method() === 'GET') {
      $routeName = $request->route()?->getName();
      if (array_key_exists($routeName, self::TRACKED_ROUTE_IS_LOCALIZED_MAP)) {
        $isLocalized = self::TRACKED_ROUTE_IS_LOCALIZED_MAP[$routeName];
        RecordPageView::dispatch($routeName, $isLocalized ? App::getLocale() : null);
      }
    }
    return $response;
  }
}
