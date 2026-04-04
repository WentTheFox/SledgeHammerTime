<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TranslatorMiddleware {
  /**
   * Handle an incoming request.
   *
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next):Response {
    if (!$request->user()->translators()->exists()){
      return response()->json(['message' => 'You do not appear to be a translator for the project'], 401);
    }

    return $next($request);
  }
}
