<?php

namespace App\Support;

use ExcimerProfiler;
use Throwable;

/**
 * Continuous profiling of the PHP requests with Grafana Pyroscope, through the excimer sampling extension (PHP has no
 * official Pyroscope client). Off unless PYROSCOPE_SERVER_ADDRESS is set and the extension is loaded.
 *
 * A share of the requests (PYROSCOPE_PHP_SAMPLE_RATE, 10% by default) is sampled in wall time at 100 Hz, and after the
 * response was sent the stacks of that request are pushed in the folded format. A profile is function names and
 * nothing else: no arguments, no request data. The only tags are the environment and the version. Requests of visitors
 * who opted out of performance monitoring are never profiled, like they are not traced.
 */
final class PyroscopeProfiler {
  public const OPT_OUT_COOKIE = 'ht_trace_optout';
  private const PERIOD_SECONDS = 0.01;
  private const SAMPLE_RATE_HZ = 100;
  private const PUSH_TIMEOUT_SECONDS = 1.0;

  private static ?ExcimerProfiler $profiler = null;
  private static int $startedAt = 0;

  public static function startForRequest(): void {
    if (!self::shouldProfile(
      getenv('PYROSCOPE_SERVER_ADDRESS') ?: null,
      extension_loaded('excimer'),
      $_COOKIE[self::OPT_OUT_COOKIE] ?? null,
      self::sampleRate(),
      mt_rand() / mt_getrandmax(),
    )){
      return;
    }
    self::$startedAt = time();
    self::$profiler = new ExcimerProfiler();
    self::$profiler->setEventType(EXCIMER_REAL);
    self::$profiler->setPeriod(self::PERIOD_SECONDS);
    self::$profiler->start();
    register_shutdown_function([self::class, 'pushProfile']);
  }

  /**
   * @param float $random A number from 0 up to 1 that decides whether this request is one of the sampled ones
   */
  public static function shouldProfile(?string $serverAddress, bool $extensionLoaded, ?string $optOutCookie, float $sampleRate, float $random): bool {
    return $serverAddress !== null
      && $extensionLoaded
      && $optOutCookie !== '1'
      && $random < $sampleRate;
  }

  /**
   * The application name with its tags, the way the Pyroscope push API wants it: `name{key=value,key=value}`. Characters
   * that would break that format are replaced.
   *
   * @param array<string, string> $tags
   */
  public static function buildName(string $applicationName, array $tags): string {
    $clean = fn(string $value): string => preg_replace('/[^A-Za-z0-9_.-]/', '_', $value);
    $pairs = [];
    foreach ($tags as $key => $value){
      if ($value !== ''){
        $pairs[] = $clean($key).'='.$clean($value);
      }
    }

    return $clean($applicationName).($pairs === [] ? '' : '{'.implode(',', $pairs).'}');
  }

  /**
   * @return array<string, string>
   */
  private static function tags(): array {
    $environment = getenv('PYROSCOPE_ENVIRONMENT') ?: null;
    if ($environment === null && preg_match('/(?:^|,)deployment\.environment=([^,]+)/', (string) getenv('OTEL_RESOURCE_ATTRIBUTES'), $matches)){
      $environment = $matches[1];
    }
    $version = getenv('GIT_COMMIT_HASH') ?: '';

    return [
      'env' => $environment ?? (getenv('APP_ENV') ?: 'production'),
      'version' => $version === 'unknown' ? '' : $version,
    ];
  }

  private static function sampleRate(): float {
    $configured = getenv('PYROSCOPE_PHP_SAMPLE_RATE');

    return $configured === false || !is_numeric($configured) ? 0.1 : max(0.0, min(1.0, (float) $configured));
  }

  /**
   * Registered as a shutdown function: the response is finished first, so profiling adds nothing to the time a
   * visitor waits.
   */
  public static function pushProfile(): void {
    if (self::$profiler === null){
      return;
    }
    if (function_exists('fastcgi_finish_request')){
      fastcgi_finish_request();
    }
    try {
      self::$profiler->stop();
      $folded = self::$profiler->getLog()->formatCollapsed();
      self::$profiler = null;
      if ($folded === '') {
        return;
      }
      $query = http_build_query([
        'name' => self::buildName(getenv('PYROSCOPE_APPLICATION_NAME') ?: 'sledgehammertime-fpm', self::tags()),
        'from' => self::$startedAt,
        'until' => time(),
        'format' => 'folded',
        'sampleRate' => self::SAMPLE_RATE_HZ,
        'spyName' => 'excimer',
      ]);
      @file_get_contents(rtrim((string) getenv('PYROSCOPE_SERVER_ADDRESS'), '/').'/ingest?'.$query, false, stream_context_create(['http' => [
        'method' => 'POST',
        'header' => "Content-Type: text/plain\r\n",
        'content' => $folded,
        'timeout' => self::PUSH_TIMEOUT_SECONDS,
        'ignore_errors' => true,
      ]]));
    } catch (Throwable) {
      // profiling must never break a request
    }
  }
}
