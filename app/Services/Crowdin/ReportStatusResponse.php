<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

use Illuminate\Http\Client\Response;

/**
 * Response from creating or checking status of a Crowdin report.
 * @see https://support.crowdin.com/developer/api/v2/#tag/Translator-Reports/operation/api.projects.reports.post
 */
final readonly class ReportStatusResponse {
  public function __construct(
    public string $identifier,
    public string $name,
    public string $status,
    public int $progress,
  ) {
  }

  public static function fromResponse(Response $response): self {
    $data = $response->json('data');

    return new self(
      identifier: $data['identifier'] ?? '',
      name: $data['name'] ?? '',
      status: $data['status'] ?? '',
      progress: (int)($data['progress'] ?? 0),
    );
  }
}
