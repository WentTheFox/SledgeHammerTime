<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

use App\Models\TranslationProgress;
use App\Models\Translator;
use App\Models\TranslationCreditOverride;
use Carbon\Carbon;
use Exception;
use JsonException;
use Log;
use RuntimeException;
use const JSON_THROW_ON_ERROR;

final class ImportCrowdinTranslatorsService {

  public function __construct(
    protected CrowdinApiService $crowdinApiService,
  ) {
  }

  /**
   * Resolve project identifiers to their numeric IDs.
   *
   * @param array<string> $identifiers Project identifiers (e.g., ['my-project', 'another-project'])
   * @return array<int> Numeric project IDs
   */
  public function resolveProjectIdentifiersToIds(array $identifiers): array {
    if (empty($identifiers)) {
      return [];
    }

    try {
      $projects = $this->crowdinApiService->getFileBasedProjects();
      $projectIds = [];

      foreach ($identifiers as $identifier) {
        foreach ($projects->data as $project) {
          if ($project->identifier === $identifier) {
            $projectIds[] = $project->id;
            break;
          }
        }
      }

      if (empty($projectIds)) {
        Log::warning('No Crowdin projects found for identifiers', ['identifiers' => $identifiers]);
      }

      return $projectIds;
    } catch (Exception $e) {
      Log::error('Failed to resolve project identifiers', [
        'identifiers' => $identifiers,
        'error' => $e->getMessage(),
      ]);
      return [];
    }
  }

  /**
   * Import translators from Crowdin report(s).
   *
   * @param bool $bypassCache Skip cache and regenerate report
   * @param int|null $developerIdFilter User ID to exclude from persistence (if valid)
   * @param array<int> $projectIds Optional project IDs to import. If empty, uses default project from config.
   * @return ImportResult
   */
  public function import(bool $bypassCache = false, ?int $developerIdFilter = null, array $projectIds = []): ImportResult {
    // Validate developer ID filter
    $developerIdInt = null;
    if ($developerIdFilter !== null && $developerIdFilter > 0) {
      $developerIdInt = $developerIdFilter;
    }

    // Fetch all credit overrides upfront (keyed by translator_id)
    $overrides = TranslationCreditOverride::all()->keyBy('translator_id');

    // The main project is always the one from config; additional project IDs are for
    // historical contributor data only and are not used for progress tracking.
    $mainProjectId = (int)config('services.crowdin.project_id');
    $projectsToProcess = !empty($projectIds) ? $projectIds : [$mainProjectId];

    $combinedResult = new ImportResult(created: 0, updated: 0, skipped: 0);

    foreach ($projectsToProcess as $projectId) {
      Log::info('Importing translators for project', ['project_id' => $projectId]);
      $projectResult = $this->importProjectTranslators($projectId, $bypassCache, $developerIdInt, $overrides);

      $combinedResult = new ImportResult(
        created: $combinedResult->created + $projectResult->created,
        updated: $combinedResult->updated + $projectResult->updated,
        skipped: $combinedResult->skipped + $projectResult->skipped,
      );
    }

    // Fetch progress only for the main project
    $progressEntries = $this->crowdinApiService->getTranslationProgress($mainProjectId);
    $this->persistTranslationProgress($mainProjectId, $progressEntries);

    return $combinedResult;
  }

  /**
   * Import translators for a single project.
   */
  private function importProjectTranslators(int $projectId, bool $bypassCache, ?int $developerIdFilter, $overrides): ImportResult {
    $cacheFile = storage_path("crowdin_report_raw_{$projectId}.json5");
    $cacheEnabled = config('services.crowdin.report_cache', false);
    $cacheExpirationSeconds = config('services.crowdin.report_cache_expiration', 3600);

    // Try to load from cache if not bypassed
    $report = null;
    if (!$bypassCache) {
      $report = $this->tryLoadFromCache($cacheFile, $cacheEnabled, $cacheExpirationSeconds);
    }

    // Generate new report if cache miss or bypassed
    if ($report === null) {
      Log::info('Generating new Crowdin report', ['project_id' => $projectId, 'bypass_cache' => $bypassCache]);
      $report = $this->generateReport($projectId);
    }

    // Persist translator records
    return $this->persistTranslators($report, $projectId, $developerIdFilter, $overrides);
  }

  /**
   * Load report from cache if valid.
   */
  private function tryLoadFromCache(string $cacheFile, bool $cacheEnabled, int $cacheExpirationSeconds): ?GetTopMembersReportResponse {
    if (!$cacheEnabled || !file_exists($cacheFile)) {
      return null;
    }

    $rawContent = file_get_contents($cacheFile);

    // Extract generated timestamp from first comment line
    if (!preg_match('/^\/\/\s*Generated at\s+(.+)$/m', $rawContent, $matches)) {
      return null;
    }

    $generatedAt = Carbon::parse($matches[1]);
    $cacheAgeSeconds = $generatedAt->diffInSeconds();

    if ($cacheAgeSeconds >= $cacheExpirationSeconds) {
      return null;
    }

    Log::info('Using cached Crowdin report', [
      'cache_age_seconds' => $cacheAgeSeconds,
      'expires_in_seconds' => $cacheExpirationSeconds - $cacheAgeSeconds,
    ]);

    // Remove comment lines for JSON parsing
    $jsonContent = preg_replace('/^\/\/.*$/m', '', $rawContent);

    try {
      $data = json_decode($jsonContent, true, flags: JSON_THROW_ON_ERROR);
      return GetTopMembersReportResponse::fromJson($data);
    } catch (JsonException $e) {
      Log::warning("Could not parse cached report: {$e->getMessage()}");
      return null;
    }
  }

  /**
   * Generate a new report from Crowdin API.
   */
  private function generateReport(int $projectId): GetTopMembersReportResponse {
    $reportStatus = $this->crowdinApiService->createTopMembersReport($projectId);
    $reportId = $reportStatus->identifier;
    Log::info('Created Crowdin report', ['project_id' => $projectId, 'report_id' => $reportId]);

    // Poll until complete
    $maxAttempts = 600;
    $attempt = 0;
    $pollFactor = 0;

    while ($attempt < $maxAttempts) {
      $pollIntervalMs = 100 * (2 ** $pollFactor);
      usleep($pollIntervalMs * 1000);
      $pollFactor++;
      $attempt++;

      $status = $this->crowdinApiService->getReportStatus($reportId, $projectId);
      Log::debug('Report status check', [
        'project_id' => $projectId,
        'report_id' => $reportId,
        'progress' => $status->progress,
        'status' => $status->status,
      ]);

      if ($status->progress >= 100) {
        break;
      }
    }

    if ($attempt >= $maxAttempts) {
      throw new RuntimeException('Report generation timed out after 10 minutes');
    }

    // Get download link
    $downloadLink = $this->crowdinApiService->getReportDownloadLink($reportId, $projectId);
    Log::info('Got report download link', [
      'project_id' => $projectId,
      'report_id' => $reportId,
      'expires_in' => $downloadLink->expireIn,
    ]);

    // Download and parse report
    $report = $this->crowdinApiService->downloadTopMembersReport($downloadLink->url, $projectId);
    Log::info('Downloaded and parsed report', [
      'project_id' => $projectId,
      'report_id' => $reportId,
      'contributor_count' => count($report->contributors),
    ]);

    return $report;
  }

  /**
   * Persist translator records to database.
   */
  private function persistTranslators(GetTopMembersReportResponse $report, int $projectId, ?int $developerIdFilter, $overrides): ImportResult {
    $created = 0;
    $updated = 0;
    $skipped = 0;
    $processedTranslatorIds = [];
    $processedUserLanguagePairs = [];

    foreach ($report->contributors as $contribution) {
      if ($contribution->languageCode === null) {
        continue;
      }

      $crowdinUserId = $contribution->crowdinUser->id;

      // Skip developer's contributions if filter is set
      if ($developerIdFilter !== null && $crowdinUserId === $developerIdFilter) {
        $skipped++;
        continue;
      }

      $translator = $contribution->crowdinUser->translators()->updateOrCreate(
        [
          'project_id' => $projectId,
          'language_code' => $contribution->languageCode,
        ],
        [
          'translated' => $contribution->translationStrings,
          'approved' => $contribution->approvalStrings,
          'voted' => $contribution->votedStrings,
        ]
      );

      // Track this user+language pair
      $processedUserLanguagePairs[] = "{$crowdinUserId}:{$contribution->languageCode}";

      // Check if this translator has a hide override
      if (isset($overrides[$translator->id]) && $overrides[$translator->id]->hide) {
        Log::debug('Skipping translator due to hide override', [
          'translator_id' => $translator->id,
          'crowdin_user_id' => $crowdinUserId,
          'language_code' => $contribution->languageCode,
        ]);
        $skipped++;
        continue;
      }

      $processedTranslatorIds[] = $translator->id;

      if ($translator->wasRecentlyCreated) {
        $created++;
      } else {
        $updated++;
      }
    }

    // Create stub records for overrides that are not in the report but should be visible
    $overridesProcessed = $this->ensureOverridesHaveTranslators(
      $projectId,
      $overrides,
      $processedUserLanguagePairs,
      $processedTranslatorIds,
      $created
    );

    // Clean up translator records that were not in this import
    $deleted = $this->cleanupMissingTranslators($projectId, $processedTranslatorIds);

    Log::info('Translator import completed', [
      'project_id' => $projectId,
      'created' => $created,
      'updated' => $updated,
      'skipped' => $skipped,
      'deleted' => $deleted,
      'overrides_created' => $overridesProcessed,
    ]);

    return new ImportResult(
      created: $created,
      updated: $updated,
      skipped: $skipped,
    );
  }

  /**
   * Ensure overrides have corresponding translator records.
   * Creates stub records for overrides that are not in the report.
   */
  private function ensureOverridesHaveTranslators(int $projectId, $overrides, array $processedUserLanguagePairs, array &$processedTranslatorIds, int &$created): int {
    $overridesProcessed = 0;

    foreach ($overrides as $override) {
      // Skip hide-only overrides (null entries in config don't matter if there's no translator)
      if ($override->hide && $override->displayName === null && $override->url === null && $override->avatarUrl === null) {
        continue;
      }

      $translator = $override->translator;
      if (!$translator) {
        Log::warning('Override has no associated translator', ['override_id' => $override->id]);
        continue;
      }

      $userLanguagePair = "{$translator->crowdin_user_id}:{$translator->language_code}";

      // If this override's translator wasn't in the report, ensure it's created in this project
      if (!in_array($userLanguagePair, $processedUserLanguagePairs)) {
        // Check if translator already exists for this project
        $projectTranslator = Translator::where('project_id', $projectId)
          ->where('crowdin_user_id', $translator->crowdin_user_id)
          ->where('language_code', $translator->language_code)
          ->first();

        if (!$projectTranslator) {
          // Create stub record with zero values so the override can be applied
          $projectTranslator = Translator::create([
            'project_id' => $projectId,
            'crowdin_user_id' => $translator->crowdin_user_id,
            'language_code' => $translator->language_code,
            'translated' => 0,
            'approved' => 0,
            'voted' => 0,
          ]);

          $created++;
          Log::info('Created stub translator record from override', [
            'translator_id' => $projectTranslator->id,
            'crowdin_user_id' => $translator->crowdin_user_id,
            'language_code' => $translator->language_code,
            'project_id' => $projectId,
          ]);
        }

        $processedTranslatorIds[] = $projectTranslator->id;
        $overridesProcessed++;
      }
    }

    return $overridesProcessed;
  }

  /**
   * Upsert language progress records for a project.
   *
   * @param int $projectId
   * @param TranslationProgressEntry[] $entries
   */
  private function persistTranslationProgress(int $projectId, array $entries): void {
    foreach ($entries as $entry) {
      TranslationProgress::updateOrCreate(
        [
          'project_id' => $projectId,
          'language_code' => $entry->languageId,
        ],
        [
          'translation' => $entry->translationProgress,
          'approval' => $entry->approvalProgress,
        ]
      );
    }

    Log::info('Persisted language progress', [
      'project_id' => $projectId,
      'language_count' => count($entries),
    ]);
  }

  /**
   * Delete translator records for this project that were not in the import.
   */
  private function cleanupMissingTranslators(int $projectId, array $processedIds): int {
    $deleted = Translator::where('project_id', $projectId)
      ->whereNotIn('id', $processedIds)
      ->delete();

    if ($deleted > 0) {
      Log::info('Cleaned up missing translator records', [
        'project_id' => $projectId,
        'deleted_count' => $deleted,
      ]);
    }

    return $deleted;
  }
}
