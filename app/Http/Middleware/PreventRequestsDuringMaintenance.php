<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\PreventRequestsDuringMaintenance as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class PreventRequestsDuringMaintenance extends Middleware {
  /**
   * The URIs that should be reachable while maintenance mode is enabled.
   *
   * @var array<int, string>
   */
  protected $except = [
    //
  ];

  public function handle($request, Closure $next): mixed {
    $this->applyLocaleFromRequest($request);

    return parent::handle($request, $next);
  }

  private function applyLocaleFromRequest(Request $request): void {
    $first_segment = $request->segment(1);
    if ($first_segment === null) {
      return;
    }

    // Resolve aliases
    $locale_route_alias = Config::get('languages.locale_route_alias', []);
    if (array_key_exists($first_segment, $locale_route_alias)) {
      $first_segment = $locale_route_alias[$first_segment];
    }

    $ui_locale_map = Config::get('languages.ui_locale_map', []);
    if (array_key_exists($first_segment, $ui_locale_map)) {
      App::setLocale($ui_locale_map[$first_segment]);
    }
  }
}
