<?php

namespace App\Services\Crowdin;

use Illuminate\Container\Attributes\Singleton;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;

#[Singleton]
class CrowdinApiService {
  protected ?int $projectId = null;
  protected readonly string $projectIdentifier;

  public function __construct() {
    $this->projectId = config('services.crowdin.project_id');
    $this->projectIdentifier = config('services.crowdin.project_identifier');
  }

  protected function createPendingRequest():PendingRequest {
    return Http::asJson()
      ->baseUrl(config('services.crowdin.base_url'))
      ->withHeaders([
        'Authorization' => sprintf('Bearer %s', config('services.crowdin.api_key')),
        'Accept' => 'application/json',
      ]);
  }

  protected function getProjectId():int {
    if ($this->projectId === null){
      $projects = $this->getFileBasedProjects();
      foreach ($projects->data as $project){
        if ($project->identifier === $this->projectIdentifier){
          $this->projectId = $project->id;
        }
      }
    }

    if ($this->projectId === null){
      throw new RuntimeException(sprintf('Could not determine Crowdin project ID from identifier %s', $this->projectIdentifier));
    }

    return $this->projectId;
  }

  public function getFileBasedProjects():GetFileBasedProjectsResponse {
    $response = $this->createPendingRequest()->get('/projects?type=0');

    return GetFileBasedProjectsResponse::fromResponse($response);
  }

  public function getProjectMember(int $id):GetProjectMemberResponse {
    $url = sprintf('/projects/%s/members/%s', $this->getProjectId(), $id);
    $response = $this->createPendingRequest()->get($url);
    $responseJson = $response->json();
    if (!array_key_exists('data', $responseJson)){
      throw new RuntimeException(sprintf("Failed to fetch project member data from %s\nResponse body:%s", $url, $response->body()));
    }

    return GetProjectMemberResponse::fromResponse($response);
  }

  /**
   * Create a top members report in translations mode.
   *
   * @param int|null $projectId Optional project ID. If null, uses configured default project.
   * @return ReportStatusResponse
   */
  public function createTopMembersReport(?int $projectId = null):ReportStatusResponse {
    $projectIdToUse = $projectId ?? $this->getProjectId();
    $url = sprintf('/projects/%s/reports', $projectIdToUse);
    $response = $this->createPendingRequest()->post($url, [
      'name' => 'top-members',
      'schema' => [
        'unit' => 'strings',
        'format' => 'json',
        'dateFrom' => '1970-01-01T00:00:00+00:00',
        'dateTo' => now()->toISOString(),
      ],
    ]);

    if (!$response->created()){
      throw new RuntimeException(sprintf(
        "Failed to create top members report: HTTP %d\n%s",
        $response->status(),
        $response->body()
      ));
    }

    return ReportStatusResponse::fromResponse($response);
  }

  /**
   * Check the status of a report generation.
   *
   * @param string $reportId
   * @param int|null $projectId Optional project ID. If null, uses configured default project.
   * @return ReportStatusResponse
   */
  public function getReportStatus(string $reportId, ?int $projectId = null):ReportStatusResponse {
    $projectIdToUse = $projectId ?? $this->getProjectId();
    $url = sprintf('/projects/%s/reports/%s', $projectIdToUse, $reportId);
    $response = $this->createPendingRequest()->get($url);

    if (!$response->ok()){
      throw new RuntimeException(sprintf(
        "Failed to fetch report status: HTTP %d\n%s",
        $response->status(),
        $response->body()
      ));
    }

    return ReportStatusResponse::fromResponse($response);
  }

  /**
   * Get the download link for a completed report.
   *
   * @param string $reportId
   * @param int|null $projectId Optional project ID. If null, uses configured default project.
   * @return ReportDownloadResponse
   */
  public function getReportDownloadLink(string $reportId, ?int $projectId = null):ReportDownloadResponse {
    $projectIdToUse = $projectId ?? $this->getProjectId();
    $url = sprintf('/projects/%s/reports/%s/download', $projectIdToUse, $reportId);
    $response = $this->createPendingRequest()->get($url);

    if (!$response->ok()){
      throw new RuntimeException(sprintf(
        "Failed to fetch report download link: HTTP %d\n%s",
        $response->status(),
        $response->body()
      ));
    }

    return ReportDownloadResponse::fromResponse($response);
  }

  /**
   * Fetch translation and approval progress for all languages in a project.
   *
   * @param int|null $projectId Optional project ID. If null, uses configured default project.
   * @return TranslationProgressEntry[]
   */
  public function getTranslationProgress(?int $projectId = null): array {
    $projectIdToUse = $projectId ?? $this->getProjectId();
    $limit = 500;
    $offset = 0;
    $entries = [];

    do {
      $url = sprintf('/projects/%s/languages/progress?limit=%d&offset=%d', $projectIdToUse, $limit, $offset);
      $response = $this->createPendingRequest()->get($url);

      if (!$response->ok()) {
        throw new RuntimeException(sprintf(
          "Failed to fetch language progress: HTTP %d\n%s",
          $response->status(),
          $response->body()
        ));
      }

      $body = $response->json();
      $page = $body['data'] ?? [];

      foreach ($page as $item) {
        $data = $item['data'] ?? [];
        if (empty($data['languageId'])) {
          continue;
        }
        $entries[] = new TranslationProgressEntry(
          languageId: $data['languageId'],
          translationProgress: (int)($data['translationProgress'] ?? 0),
          approvalProgress: (int)($data['approvalProgress'] ?? 0),
        );
      }

      $total = $body['pagination']['total'] ?? count($entries);
      $offset += $limit;
    } while ($offset < $total && count($page) === $limit);

    return $entries;
  }

  /**
   * Download and parse the report data from a download URL.
   *
   * @param string $downloadUrl
   * @param int|null $projectId Optional project ID. If null, uses configured default project.
   *
   * @return GetTopMembersReportResponse
   */
  public function downloadTopMembersReport(string $downloadUrl, ?int $projectId = null):GetTopMembersReportResponse {
    $projectIdToUse = $projectId ?? $this->getProjectId();
    $cacheEnabled = config('services.crowdin.report_cache', false);
    $cacheFile = storage_path("crowdin_report_raw_{$projectIdToUse}.json5");

    // Download report
    $response = Http::asJson()->get($downloadUrl);

    if (!$response->ok()){
      throw new RuntimeException(sprintf(
        "Failed to download report data: HTTP %d\n%s",
        $response->status(),
        $response->body()
      ));
    }

    if ($cacheEnabled){
      $rawBody = $response->body();
      $cacheContent = [
        "// Generated at ".now()->toIso8601String(),
        "// Downloaded from {$downloadUrl}",
        $rawBody,
      ];
      file_put_contents($cacheFile, implode("\n", $cacheContent));
    }

    return GetTopMembersReportResponse::fromResponse($response);
  }
}
