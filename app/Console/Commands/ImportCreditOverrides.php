<?php

namespace App\Console\Commands;

use App\Models\CrowdinUser;
use App\Models\Translator;
use App\Models\TranslationCreditOverride;
use App\Models\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use JsonException;

class ImportCreditOverrides extends Command {
  protected $signature = 'crowdin:import-overrides';

  protected $description = 'Import credit overrides from lang/config.json';

  public function handle():int {
    try {
      $configPath = base_path('lang/config.json');

      if (!file_exists($configPath)){
        $this->error("Config file not found: $configPath");

        return self::FAILURE;
      }

      $configContent = file_get_contents($configPath);
      $config = json_decode($configContent, associative: true, flags: JSON_THROW_ON_ERROR);

      if (!isset($config['languages']) || !is_array($config['languages'])){
        $this->error('Invalid config format: languages key not found or not an array');

        return self::FAILURE;
      }

      $consoleUser = User::find(config('app.console_user_uuid'));
      if (!$consoleUser){
        $this->error('No console user found');

        return self::FAILURE;
      }

      $processed = 0;
      $skipped = 0;
      $errors = [];

      foreach ($config['languages'] as $languageCode => $languageData){
        if (!isset($languageData['creditOverrides']) || !is_array($languageData['creditOverrides'])){
          continue;
        }

        foreach ($languageData['creditOverrides'] as $crowdinUserId => $override){
          $crowdinUserIdInt = (int)$crowdinUserId;

          try {
            // Find the translator record for this user and language
            $translator = Translator::whereHas('crowdinUser', function ($query) use ($crowdinUserIdInt) {
              $query->where('id', $crowdinUserIdInt);
            })->where('language_code', $languageCode)->first();

            if (!$translator){
              // Null entries are skip-only, don't create stubs for them
              if ($override === null) {
                $skipped++;
                continue;
              }

              // Only log warnings for actual overrides (not null entries)
              if (is_array($override) && !empty($override)) {
                $this->warn("Missing translator record: User $crowdinUserIdInt in language '$languageCode' has override but no translator record");
                $this->line("Override data: " . json_encode($override, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
                Log::warning('Missing translator record for override - import will create stub during next sync', [
                  'crowdin_user_id' => $crowdinUserIdInt,
                  'language_code' => $languageCode,
                  'override_data' => $override,
                ]);
              }
              $skipped++;
              continue;
            }

            if ($override === null){
              // Hide this translator
              TranslationCreditOverride::updateOrCreate(
                ['translator_id' => $translator->id],
                [
                  'hide' => true,
                  'created_by' => $consoleUser->id,
                  'displayName' => null,
                  'avatarUrl' => null,
                  'url' => null,
                ]
              );
            }
            else if (is_array($override)){
              // Set override properties
              $data = [
                'created_by' => $consoleUser->id,
                'hide' => false,
              ];

              if (isset($override['displayName'])){
                $data['displayName'] = $override['displayName'];
              }

              if (isset($override['url'])){
                $data['url'] = $override['url'];
              }

              if (isset($override['avatarUrl'])){
                $data['avatarUrl'] = $override['avatarUrl'];
              }

              TranslationCreditOverride::updateOrCreate(
                ['translator_id' => $translator->id],
                $data
              );
            }

            $processed++;
          }
          catch (Exception $e){
            $errors[] = "Failed to process user $crowdinUserIdInt in language '$languageCode': {$e->getMessage()}";
            $skipped++;
          }
        }
      }

      Log::info('Credit overrides imported', [
        'processed' => $processed,
        'skipped' => $skipped,
        'errors' => count($errors),
      ]);

      $this->info("Successfully imported credit overrides:");
      $this->line("  Processed: $processed");
      $this->line("  Skipped: $skipped");

      if (!empty($errors)){
        $this->warn("Errors encountered:");
        foreach ($errors as $error){
          $this->line("  - $error");
        }
      }

      return self::SUCCESS;
    }
    catch (JsonException $e){
      $this->error("Invalid JSON in config file: {$e->getMessage()}");
      Log::error('Failed to import credit overrides', ['error' => $e->getMessage()]);

      return self::FAILURE;
    }
    catch (Exception $e){
      $this->error("An error occurred: {$e->getMessage()}");
      Log::error('Failed to import credit overrides', ['error' => $e->getMessage()]);

      return self::FAILURE;
    }
  }
}
