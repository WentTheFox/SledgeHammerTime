<?php

namespace App\Http\Middleware;

use App\Services\Crowdin\CrowdinCreditsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware {
  /**
   * The root template that is loaded on the first page visit.
   *
   * @var string
   */
  protected $rootView = 'app';

  /**
   * Routes which are heavily cached due to high traffic and must not be given sensitive or frequently-changing data
   *
   * @var string[]
   */
  protected static array $staticCachedRoutes = ['home', 'botInfo'];

  /**
   * Determine the current asset version.
   */
  public function version(Request $request):string|null {
    return parent::version($request);
  }

  /**
   * Define the props that are shared by default.
   *
   * @return array<string, mixed>
   */
  public function share(Request $request):array {
    $shared = [
      ...parent::share($request),
      ...self::getGlobalSharedArray($request),
      'auth' => [
        'user' => self::isStaticCachedRoute($request) ? null : $request->user()?->mapToUiInfo(),
      ],
    ];
    $shared['ziggy'] = fn() => [
      ...new Ziggy(url: config('app.url'))->toArray(),
      'location' => $request->url(),
    ];

    return $shared;
  }

  /**
   * Static cached routes omit user data — it is fetched asynchronously by the
   * frontend so the full-page HTML response can be cached per locale.
   *
   * @param Request $request
   *
   * @return bool
   */
  private static function isStaticCachedRoute(Request $request): bool {
    return in_array($request->route()?->getName(), self::$staticCachedRoutes, strict: true);
  }

  /**
   * @return array{
   *   app: array{
   *     name: string,
   *     locale: string,
   *     fallbackLocale: string,
   *     languages: array<string, string>,
   *     supportedLanguages: list<string>,
   *     crowdinProjectId: string,
   *   },
   *   ziggy: callable(): array<mixed>,
   *   crowdinData: callable(): array<mixed>,
   * }
   */
  public static function getGlobalSharedArray(Request $request):array {
    return [
      'app' => [
        'name' => config('app.name'),
        'locale' => App::getLocale(),
        'fallbackLocale' => config('app.fallback_locale'),
        'languages' => array_flip(Config::get('languages.ui_locale_map')),
        'supportedLanguages' => Config::get('languages.supported_locales'),
        'crowdinProjectId' => Config::get('services.crowdin.project_identifier'),
      ],
      'ziggy' => fn() => new Ziggy(url: config('app.url'))->toArray(),
      'crowdinData' => fn() => self::isStaticCachedRoute($request) ? null : app(CrowdinCreditsService::class)->getLocaleData(App::getLocale()),
    ];
  }
}
