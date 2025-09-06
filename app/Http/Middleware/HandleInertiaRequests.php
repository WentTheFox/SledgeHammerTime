<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware {
  /**
   * The root template that is loaded on the first page visit.
   *
   * @var string
   */
  protected $rootView = 'app';

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
    return [
      ...parent::share($request),
      'app' => [
        'name' => config('app.name'),
        'locale' => App::getLocale(),
        'fallbackLocale' => config('app.fallback_locale'),
        'languages' => array_flip(Config::get('languages.ui_locale_map')),
        'supportedLanguages' => Config::get('languages.supported_locales'),
        'crowdinProjectId' => Config::get('crowdin.project_id'),
      ],
      'auth' => [
        'user' => $request->user(),
      ],
      'ziggy' => fn() => [
        ...(new Ziggy)->toArray(),
        'location' => $request->url(),
      ],
    ];
  }
}
