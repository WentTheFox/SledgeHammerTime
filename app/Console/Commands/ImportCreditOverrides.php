<?php

namespace App\Console\Commands;

use App\Models\CrowdinUser;
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

        // Use the Crowdin locale code stored in the DB, falling back to the config key
        $dbLanguageCode = $languageData['crowdinLocale'] ?? $languageCode;

        foreach ($languageData['creditOverrides'] as $crowdinUserId => $override){
          $crowdinUserIdInt = (int)$crowdinUserId;

          try {
            // Verify the Crowdin user exists
            if (!CrowdinUser::where('id', $crowdinUserIdInt)->exists()){
              $this->warn("Crowdin user $crowdinUserIdInt not found in database, skipping");
              $skipped++;
              continue;
            }

            if ($override === null){
              // Hide this translator
              TranslationCreditOverride::updateOrCreate(
                ['crowdin_user_id' => $crowdinUserIdInt, 'language_code' => $dbLanguageCode],
                [
                  'hide' => true,
                  'created_by' => $consoleUser->id,
                  'approved_by' => $consoleUser->id,
                  'approved_at' => now(),
                  'display_name' => null,
                  'avatar_url' => null,
                  'url' => null,
                ]
              );
            }
            else if (is_array($override)){
              // Set override properties — system-imported, bypass model events to avoid clearing approval
              $data = [
                'created_by' => $consoleUser->id,
                'approved_by' => $consoleUser->id,
                'approved_at' => now(),
                'hide' => false,
              ];

              if (isset($override['displayName'])){
                $data['display_name'] = $override['displayName'];
              }

              if (isset($override['url'])){
                $data['url'] = $override['url'];
              }

              if (isset($override['avatarUrl'])){
                $data['avatar_url'] = $override['avatarUrl'];
              }

              TranslationCreditOverride::withoutEvents(function () use ($crowdinUserIdInt, $dbLanguageCode, $data) {
                TranslationCreditOverride::updateOrCreate(
                  ['crowdin_user_id' => $crowdinUserIdInt, 'language_code' => $dbLanguageCode],
                  $data
                );
              });
            }

            $processed++;
          }
          catch (Exception $e){
            $errors[] = "Failed to process user $crowdinUserIdInt in language '$dbLanguageCode': {$e->getMessage()}";
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
