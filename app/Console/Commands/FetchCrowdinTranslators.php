<?php

namespace App\Console\Commands;

use App\Services\Crowdin\ImportCrowdinTranslatorsService;
use Exception;
use Illuminate\Console\Command;

class FetchCrowdinTranslators extends Command {
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'crowdin:fetch-translators {--f|force : Bypass cache and regenerate report}';

  /**
   * The console command description.
   *
   * @var string
   */
  protected $description = 'Fetch all translators from Crowdin top members report and write to database';

  public function __construct(protected ImportCrowdinTranslatorsService $importService) {
    parent::__construct();
  }

  /**
   * Execute the console command.
   */
  public function handle(): int {
    try {
      $bypassCache = $this->option('force');

      // Get developer ID to exclude from persistence
      $developerId = config('services.crowdin.developer_id');
      $developerIdInt = null;
      if ($developerId !== null && $developerId !== false && $developerId !== '') {
        $developerIdInt = (int)$developerId;
      }

      if ($developerIdInt !== null && $developerIdInt > 0) {
        $this->info("Excluding developer user ID {$developerIdInt} from persistence");
      }

      // Resolve project identifiers to IDs
      $projectIdentifiersEnv = config('services.crowdin.project_identifiers_for_credits');
      $projectIds = [];

      if ($projectIdentifiersEnv) {
        $identifiers = array_filter(array_map('trim', explode(',', $projectIdentifiersEnv)));
        $this->info("Resolving project identifiers: " . implode(', ', $identifiers));
        $projectIds = $this->importService->resolveProjectIdentifiersToIds($identifiers);

        if (empty($projectIds)) {
          $this->warn('No projects found for provided identifiers');
          return 1;
        }

        $this->info("Resolved to project IDs: " . implode(', ', $projectIds));
      }

      $this->info('Fetching Crowdin translators…');

      $result = $this->importService->import(
        bypassCache: $bypassCache,
        developerIdFilter: $developerIdInt,
        projectIds: $projectIds,
      );

      $this->newLine();
      $this->info('Translator import completed successfully');
      $this->line("Created: <fg=green>{$result->created}</> records");
      $this->line("Updated: <fg=yellow>{$result->updated}</> records");
      $this->line("Total: <fg=blue>" . $result->total() . "</> records processed");

      if ($result->skipped > 0) {
        $this->line("Skipped: <fg=cyan>{$result->skipped}</> developer records");
      }

      return 0;
    } catch (Exception $e) {
      $this->newLine();
      $this->error("Failed to fetch translators: Error: {$e->getMessage()}");

      return 1;
    }
  }
}

