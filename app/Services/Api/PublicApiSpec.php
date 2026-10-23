<?php

declare(strict_types=1);

namespace App\Services\Api;

use Illuminate\Container\Attributes\Singleton;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * The OpenAPI document of the public API, for the reference on the API page. The API server generates it from the bot's
 * commands, so it is read from there instead of being copied into this repository where it would go stale.
 */
#[Singleton]
class PublicApiSpec {
  private const string CACHE_KEY = 'public-api-openapi';
  private const string FAILED_KEY = 'public-api-openapi-failed';

  /**
   * Long enough to spare the API server a request per page view, short enough that a deploy shows up soon
   */
  private const int TTL_SECONDS = 600;

  /**
   * After a failure the page goes without the reference for this long, instead of waiting on a down server every time
   */
  private const int FAILURE_TTL_SECONDS = 60;

  private const int TIMEOUT_SECONDS = 3;

  /**
   * @return array<string, mixed>|null Null when the API server can not be reached or does not answer with a document
   */
  public function get():?array {
    $cached = Cache::get(self::CACHE_KEY);
    if (is_array($cached)){
      return $cached;
    }
    if (Cache::has(self::FAILED_KEY)){
      return null;
    }

    $spec = $this->fetch();
    if ($spec === null){
      Cache::put(self::FAILED_KEY, true, self::FAILURE_TTL_SECONDS);

      return null;
    }
    Cache::put(self::CACHE_KEY, $spec, self::TTL_SECONDS);

    return $spec;
  }

  /**
   * @return array<string, mixed>|null
   */
  private function fetch():?array {
    $url = rtrim((string)config('services.public_api.url'), '/') . '/generated/api-docs.json';
    try {
      $response = Http::timeout(self::TIMEOUT_SECONDS)->acceptJson()->get($url);
      $spec = $response->successful() ? $response->json() : null;
    }
    catch (Throwable $e) {
      Log::warning('Could not fetch the OpenAPI document of the public API', ['url' => $url, 'exception' => $e::class]);

      return null;
    }
    if (!is_array($spec) || !isset($spec['paths']) || !is_array($spec['paths'])){
      Log::warning('The OpenAPI document of the public API is not usable', ['url' => $url, 'status' => $response->status()]);

      return null;
    }

    return $spec;
  }
}
