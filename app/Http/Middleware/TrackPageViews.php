<?php

namespace App\Http\Middleware;

use App\Jobs\RecordPageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class TrackPageViews {
  protected const TRACKED_ROUTES = [
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
    'analytics' => true,
    'status' => false,
  ];

  /**
   * Handle an incoming request.
   *
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next):Response {
    $response = $next($request);
    if (config('analytics.enabled') === true && $request->method() === 'GET'){
      $routeName = $request->route()?->getName();
      if (array_key_exists($routeName, self::TRACKED_ROUTES)){
        $isLocalized = self::TRACKED_ROUTES[$routeName];
        RecordPageView::dispatch($routeName, $isLocalized ? App::getLocale() : null);
      }
    }

    return $response;
  }
}
