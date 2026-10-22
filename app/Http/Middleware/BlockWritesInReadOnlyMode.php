<?php

namespace App\Http\Middleware;

use App\Support\ReadOnlyMode;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockWritesInReadOnlyMode {
  /**
   * GET routes that create users/sessions or otherwise write to the database
   */
  protected const WRITING_GET_PATTERNS = [
    'bot-login/*',
    '*/oauth/callback/*',
    '*/oauth/callback-auth/*',
    'oauth/callback/*',
    'oauth/callback-auth/*',
  ];

  /**
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next):Response {
    if (!ReadOnlyMode::isActive() || !$this->isWrite($request)){
      return $next($request);
    }

    $headers = ['Retry-After' => (string) ReadOnlyMode::RETRY_AFTER_SECONDS];
    if ($request->expectsJson()){
      return response()->json(['message' => 'The service is temporarily read-only while an update is being applied.'], 503, $headers);
    }

    return response()->view('errors.maintenance', [
      'discordUrl' => config('services.discord.invite_url'),
      'developerContactUrl' => config('services.developer.contact_url'),
      'statusPageUrl' => config('app.status_page_url'),
    ], 503, $headers);
  }

  private function isWrite(Request $request):bool {
    if (!$request->isMethodSafe()){
      return true;
    }

    return $request->is(...self::WRITING_GET_PATTERNS);
  }
}
