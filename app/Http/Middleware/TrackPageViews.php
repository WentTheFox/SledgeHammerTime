<?php

namespace App\Http\Middleware;

use App\Jobs\RecordPageView;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Jaybizzle\CrawlerDetect\Fixtures\Headers;
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
   * Technical routes polled by monitoring tools, which are already filtered out as such on the analytics page,
   * so they should not also be hidden as crawler traffic
   */
  protected const CRAWLER_EXEMPT_ROUTES = [
    'status' => true,
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
        // Only forward the headers crawler detection looks at, so cookies etc. stay out of the queue
        $uaHeaders = isset(self::CRAWLER_EXEMPT_ROUTES[$routeName])
          ? []
          : array_intersect_key($request->server->all(), array_flip((new Headers())->getAll()));
        RecordPageView::dispatch($routeName, $isLocalized ? App::getLocale() : null, $uaHeaders);
      }
    }

    return $response;
  }
}
