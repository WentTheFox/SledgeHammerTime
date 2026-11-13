<?php

declare(strict_types=1);

namespace App\Services;

/**
 * Builds the Content-Security-Policy sent in report-only mode (violations go to the report endpoint, nothing is blocked).
 *
 * Scripts may only come from this site and from the inline scripts the page itself contains, which are allowed by their
 * SHA-256 hash. A hash rather than a per-request nonce, because the rendered pages are cached for a day (see
 * CachePageResponse) and a nonce stored in cached HTML would be the same for every visitor, which defeats its purpose.
 * The hashes are computed from the final response body, so they are right for cached pages, uncached pages and the
 * pages whose inline Ziggy script differs per request (it carries the current location, e.g. the `t` and `tz` query).
 */
final class ContentSecurityPolicy {
  /** Script types a browser executes (no type attribute, or one of these); everything else, e.g. application/json, is data. */
  private const EXECUTABLE_SCRIPT_TYPES = ['', 'module', 'text/javascript', 'application/javascript', 'text/ecmascript', 'application/ecmascript'];

  /**
   * Hosts that avatars come from (AvatarProvider: Gravatar, Libravatar's secure fallback, Discord's CDN, and Crowdin's
   * for translators' pictures in the credits).
   */
  private const IMAGE_HOSTS = [
    'https://gravatar.com',
    'https://www.gravatar.com',
    'https://seccdn.libravatar.org',
    'https://cdn.discordapp.com',
    'https://crowdin-static.cf-downloads.crowdin.com',
  ];

  /**
   * SHA-256 source expressions ('sha256-...') of every executable inline script in the HTML, without duplicates.
   *
   * @return list<string>
   */
  public static function inlineScriptHashes(string $html): array {
    if (!preg_match_all('/<script\b([^>]*)>(.*?)<\/script>/is', $html, $scripts, PREG_SET_ORDER)) {
      return [];
    }

    $hashes = [];
    foreach ($scripts as [, $attributes, $content]) {
      if (preg_match('/\bsrc\s*=/i', $attributes)) {
        continue; // external, covered by 'self'
      }
      $type = preg_match('/\btype\s*=\s*["\']?([^"\'\s>]*)/i', $attributes, $match) ? strtolower(trim($match[1])) : '';
      if (!in_array($type, self::EXECUTABLE_SCRIPT_TYPES, true) || trim($content) === '') {
        continue;
      }
      $hashes["'sha256-" . base64_encode(hash('sha256', $content, true)) . "'"] = true;
    }

    return array_keys($hashes);
  }

  /**
   * @param list<string> $scriptHashes Source expressions from inlineScriptHashes()
   */
  public static function build(array $scriptHashes, string $reportUri): string {
    return implode('; ', [
      "default-src 'self'",
      implode(' ', ["script-src 'self'", ...$scriptHashes]),
      "script-src-attr 'none'",
      // Components and the markdown preview set style attributes; styles are not where scripts get injected from
      "style-src 'self' 'unsafe-inline'",
      implode(' ', ["img-src 'self' data:", ...self::IMAGE_HOSTS]),
      "font-src 'self' data:",
      "connect-src 'self'",
      "object-src 'none'",
      "base-uri 'self'",
      "form-action 'self'",
      "frame-ancestors 'self'",
      "report-uri $reportUri",
      'report-to csp-endpoint',
    ]);
  }

  /** Value of the Reporting-Endpoints header that the policy's `report-to csp-endpoint` refers to. */
  public static function reportingEndpoints(string $reportUri): string {
    return 'csp-endpoint="' . $reportUri . '"';
  }
}
