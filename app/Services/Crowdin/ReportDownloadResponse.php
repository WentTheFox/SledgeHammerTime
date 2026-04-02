<?php

namespace App\Services\Crowdin;

use Illuminate\Http\Client\Response;

/**
 * Response from getting download link for a report.
 *
 * @see https://support.crowdin.com/developer/api/v2/#tag/Translator-Reports/operation/api.projects.reports.download
 */
final readonly class ReportDownloadResponse {
  public function __construct(
    public string $url,
    public string $expireIn,
  ) {
  }

  public static function fromResponse(Response $response):self {
    $data = $response->json('data');

    return new self(
      url: $data['url'] ?? '',
      expireIn: $data['expireIn'] ?? '',
    );
  }
}
