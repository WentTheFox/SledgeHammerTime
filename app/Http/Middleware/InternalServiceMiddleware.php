<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Lets only the API server through to the /internal endpoints, which trust it to have authenticated its own clients.
 */
class InternalServiceMiddleware {
  /**
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next):Response {
    $secret = config('services.internal_api.secret');
    if (empty($secret)){
      return response()->json(['message' => 'INTERNAL_API_SECRET is missing in the .env file'], 500);
    }

    // 403 and not 401: the API service reads a 401 from the key endpoint as "this key is not valid", so a wrong secret
    // has to be something else, or every key would look wrong with nothing to say why
    $presented = $request->bearerToken();
    if (empty($presented) || !hash_equals($secret, $presented)){
      return response()->json(['message' => 'Forbidden.'], 403);
    }

    return $next($request);
  }
}
