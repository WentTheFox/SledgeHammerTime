<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsoleUserMiddleware {
  /**
   * Handle an incoming request.
   *
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next):Response {
    $expectedUserId = config('app.console_user_uuid');
    if (empty($expectedUserId)){
      return response()->json(['message' => "Console user UUID is missing in .env file, run `php artisan bot-token:generate`"], 500);
    }

    $user = $request->user();
    if (empty($user) || $user->id !== $expectedUserId){
      // Not who is expected: that is nothing to tell whoever got here with a token of their own
      return response()->json(['message' => 'This token is not allowed to do that.'], 401);
    }

    return $next($request);
  }
}
