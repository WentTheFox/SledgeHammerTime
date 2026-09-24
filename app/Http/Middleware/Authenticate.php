<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Authenticate extends Middleware {
  /**
   * Get the path the user should be redirected to when they are not authenticated.
   */
  protected function redirectTo(Request $request):?string {
    if ($request->expectsJson()){
      return null;
    }

    // The login route isn't registered at all when login is disabled - see config('auth.login_enabled')
    return route(config('auth.login_enabled') ? 'login' : 'home', ['locale' => App::getLocale()]);
  }
}
