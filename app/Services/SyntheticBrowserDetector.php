<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Flags requests whose user agent claims to be Chrome or Firefox but whose headers give them away.
 * Real Chrome (since 76) and Firefox (since 90) always send Sec-Fetch-Mode, and every browser sends
 * Accept-Language, while HTTP libraries and scrapers posing as browsers set only the user agent.
 * Safari and the iOS browsers are not matched, as older versions do not send Sec-Fetch-*.
 */
class SyntheticBrowserDetector {
  /**
   * Server variables this detector reads, to be forwarded alongside the user agent
   */
  public const HEADERS = ['HTTP_USER_AGENT', 'HTTP_SEC_FETCH_MODE', 'HTTP_ACCEPT_LANGUAGE'];

  /**
   * @param array<string, string> $headers Server variables (HTTP_USER_AGENT, etc.)
   */
  public function isSynthetic(array $headers):bool {
    $userAgent = $headers['HTTP_USER_AGENT'] ?? null;
    if ($userAgent === null || !preg_match('~\b(Chrome|Firefox)/\d+\.~', $userAgent)) {
      return false;
    }

    return ($headers['HTTP_SEC_FETCH_MODE'] ?? '') === '' || ($headers['HTTP_ACCEPT_LANGUAGE'] ?? '') === '';
  }
}
