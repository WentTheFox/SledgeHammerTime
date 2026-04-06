<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SentryTunnelController extends Controller {
  public function tunnel(Request $request):Response|JsonResponse {
    if (!config('analytics.sentry_dsn')){
      abort(404);
    }

    try {
      $sentryHost = config('services.sentry.host');
      $allowedProjectIds = config('services.sentry.project_ids', []);

      if (!$sentryHost || empty($allowedProjectIds)){
        throw new Exception('Sentry tunnel not configured');
      }

      $envelopeBytes = $request->getContent(false);
      if (empty($envelopeBytes)){
        throw new Exception('Empty envelope');
      }

      $envelope = (string)$envelopeBytes;
      
      // Split on various newline formats
      $lines = preg_split("/\r?\n/", $envelope);
      $headerLine = trim($lines[0] ?? '');

      if (empty($headerLine)){
        Log::debug('Sentry envelope: empty header line', [
          'total_lines' => count($lines),
          'first_100_chars' => substr($envelope, 0, 100),
        ]);
        throw new Exception('Invalid envelope: missing header');
      }

      $header = json_decode($headerLine, true);
      if (!is_array($header)){
        Log::debug('Sentry envelope: header JSON decode failed', [
          'header_line' => substr($headerLine, 0, 300),
          'json_error' => json_last_error_msg(),
        ]);
        throw new Exception('Invalid envelope: malformed header JSON');
      }

      $dsn = $header['dsn'] ?? null;
      
      if (!$dsn){
        Log::debug('Sentry envelope: DSN not in header', [
          'header_keys' => array_keys($header),
        ]);
        throw new Exception('Invalid envelope: missing DSN');
      }

      $dsn = $header['dsn'];
      $dsnUrl = parse_url($dsn);
      $dsnHost = $dsnUrl['host'] ?? '';
      $projectId = trim($dsnUrl['path'] ?? '', '/');

      if ($dsnHost !== $sentryHost){
        throw new Exception("Invalid sentry hostname: {$dsnHost}");
      }

      if (!$projectId || !in_array($projectId, $allowedProjectIds, true)){
        throw new Exception("Invalid sentry project id: {$projectId}");
      }

      $upstreamUrl = "https://{$sentryHost}/api/{$projectId}/envelope/";

      $response = Http::withHeaders([
        'Content-Type' => 'application/x-sentry-envelope',
      ])->withBody($envelopeBytes, 'application/x-sentry-envelope')->post($upstreamUrl);

      if (!$response->successful()){
        Log::warning('Sentry tunnel upstream error', [
          'status' => $response->status(),
          'body' => $response->body(),
        ]);
        return response()->json(['error' => 'error tunneling to sentry'], $response->status());
      }

      return response('', 200);
    }
    catch (Exception $e){
      Log::error('Error tunneling to sentry', [
        'error' => $e->getMessage(),
      ]);

      return response()->json(['error' => 'error tunneling to sentry'], 500);
    }
  }
}
