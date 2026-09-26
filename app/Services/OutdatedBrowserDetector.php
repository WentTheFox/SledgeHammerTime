<?php

declare(strict_types=1);

namespace App\Services;

use Carbon\CarbonInterface;

/**
 * Flags user agents claiming a Chrome or Firefox version far older than anything a real, auto-updating
 * browser would still report. Scrapers that pose as browsers (which CrawlerDetect cannot catch) tend to
 * hard-code such versions, e.g. Chrome 120 / Firefox 121 (late 2023) or Chrome 35 (2014).
 */
class OutdatedBrowserDetector {
  /**
   * A known release per browser; both ship a new major version every 4 weeks, which is used
   * to estimate the current version without having to keep a hard-coded list up to date
   */
  protected const ANCHORS = [
    'Chrome' => [140, '2025-09-02'],
    'Firefox' => [143, '2025-09-16'],
  ];

  protected const RELEASE_CYCLE_DAYS = 28;

  /**
   * How many releases behind the estimated current version a browser may be (~2.3 years),
   * generous enough to leave Firefox ESR and slow-updating Chromium forks alone
   */
  public const MAX_RELEASES_BEHIND = 30;

  public function isOutdated(?string $userAgent, ?CarbonInterface $now = null): bool {
    if ($userAgent === null || !preg_match('~\b(Chrome|Firefox)/(\d+)\.~', $userAgent, $match)) {
      return false;
    }

    return (int)$match[2] < $this->estimateCurrentVersion($match[1], $now ?? now('UTC')) - self::MAX_RELEASES_BEHIND;
  }

  public function estimateCurrentVersion(string $browser, CarbonInterface $now): int {
    [$version, $date] = self::ANCHORS[$browser];

    $daysSince = intdiv($now->getTimestamp() - strtotime($date . ' 00:00:00 UTC'), 86400);

    return $version + intdiv(max(0, $daysSince), self::RELEASE_CYCLE_DAYS);
  }
}
