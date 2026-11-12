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
   * Non-GET routes that do not write to the database, so they keep working in read-only mode
   */
  protected const READING_POST_PATTERNS = [
    'internal/keys/validate',
    // only sets the visitor's preferences cookie
    'frontend/local-settings',
  ];

  /**
   * @param Closure(Request): (Response) $next
   */
  public function handle(Request $request, Closure $next):Response {
    if (!ReadOnlyMode::isActive() || !$this->isWrite($request)){
      return $next($request);
    }

    $headers = ReadOnlyMode::isConfigured() ? [] : ['Retry-After' => (string) ReadOnlyMode::RETRY_AFTER_SECONDS];
    if ($request->expectsJson()){
      $message = ReadOnlyMode::isConfigured()
        ? 'This instance is read-only, changes are not accepted.'
        : 'The service is temporarily read-only while an update is being applied.';
      return response()->json(['message' => $message], 503, $headers);
    }

    return response()->view('errors.maintenance', [
      'discordUrl' => config('services.discord.invite_url'),
      'developerContactUrl' => config('services.developer.contact_url'),
      'statusPageUrl' => config('app.status_page_url'),
    ], 503, $headers);
  }

  private function isWrite(Request $request):bool {
    if ($request->is(...self::READING_POST_PATTERNS)){
      return false;
    }
    if (!$request->isMethodSafe()){
      return true;
    }

    return $request->is(...self::WRITING_GET_PATTERNS);
  }
}
