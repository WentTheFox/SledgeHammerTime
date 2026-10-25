<?php

namespace App\Http\Middleware;

use App\Services\Crowdin\CrowdinCreditsService;
use App\Services\LocalSettingsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
  protected static array $staticCachedRoutes = ['home', 'botInfo', 'legal', 'analytics'];

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
      // ziggy-js's `location` override (used in place of `window.location`, which doesn't
      // exist during SSR) is typed as {host?, pathname?, search?} - NOT a URL string. A bare
      // string here means every property access (`location.pathname` etc.) silently reads
      // undefined, so Ziggy falls through to its window.location fallback, which is also
      // absent under Node SSR. Net effect: route().current() returns undefined for every
      // route on every SSR'd page, and any URL built from "the current route" (e.g. the
      // language switcher's links) silently falls back to the home route instead.
      'location' => [
        'host' => $request->getHttpHost(),
        'pathname' => $request->getPathInfo(),
        'search' => $request->getQueryString() ? '?'.$request->getQueryString() : '',
      ],
    ];

    return $shared;
  }

  /**
   * Static cached routes omit user data - it is fetched asynchronously by the
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
   *     statusPageUrl: string|null,
   *   },
   *   ziggy: callable(): array<mixed>,
   *   crowdinData: callable(): array<mixed>,
   *   developerUrl: string,
   *   developerContactUrl: string,
   *   developerAvatarUrl: string,
   * }
   */
  public static function getGlobalSharedArray(Request $request):array {
    return [
      'app' => [
        'name' => config('app.name'),
        'locale' => App::getLocale(),
        'fallbackLocale' => config('app.fallback_locale'),
        'languages' => array_flip(config('languages.ui_locale_map')),
        'supportedLanguages' => config('languages.supported_locales'),
        'crowdinProjectId' => config('services.crowdin.project_identifier'),
        'statusPageUrl' => config('app.status_page_url') ?: null,
        'theme' => LocalSettingsService::resolveTheme($request),
      ],
      'ziggy' => fn() => new Ziggy(url: config('app.url'))->toArray(),
      'crowdinData' => fn() => self::isStaticCachedRoute($request) ? null : app(CrowdinCreditsService::class)->getLocaleData(App::getLocale()),
      // Single source of truth is config('services.developer.*') - developerContactUrl is
      // also used directly (not via this shared-props path, which needs a built Inertia
      // page) by the plain-Blade maintenance view in Handler::render().
      'developerUrl' => config('services.developer.url'),
      'developerContactUrl' => config('services.developer.contact_url'),
      'developerAvatarUrl' => config('services.developer.avatar_url'),
    ];
  }
}
