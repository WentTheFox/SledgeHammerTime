<?php

namespace App\Http\Controllers;

use App\Enums\DiscordBotCommandOptionType;
use App\Http\Requests\BotLoginRequest;
use App\Http\Requests\SaveShardStatsRequest;
use App\Http\Requests\TelemetryRequest;
use App\Http\Requests\UpdateBotCommandsRequest;
use App\Http\Requests\UpdateBotTimezonesRequest;
use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\BotCommandOptionChoice;
use App\Models\BotShard;
use App\Models\BotTimezone;
use App\Models\CrowdinUser;
use App\Models\DiscordUser;
use App\Models\TranslationProgress;
use App\Models\Settings;
use App\Models\Translator;
use App\Models\User;
use App\Services\Crowdin\ImportCrowdinTranslatorsService;
use App\Services\Discord\DiscordUserService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class BotApiController extends Controller {
  public function __construct(
    protected DiscordUserService $discordUserService,
    protected ImportCrowdinTranslatorsService $importTranslatorsService,
  ) {
  }

  function user(Request $request):JsonResponse {
    /** @var User|null $user */
    $user = $request->user();

    return response()->json($user?->mapToUiInfo());
  }

  function loginLink(BotLoginRequest $request):JsonResponse {
    $data = $request->validated();

    $expiresAt = now()->addMinutes(5);
    $loginUrl = URL::temporarySignedRoute(
      'botLogin',
      $expiresAt,
      array_merge([
        'discordUserId' => $request->route('discordUserId'),
        'locale' => $request->route('locale'),
      ], $data),
    );

    return response()->json(['loginUrl' => $loginUrl, 'expiresAt' => $expiresAt->unix()]);
  }

  function settings(Request $request):JsonResponse {
    $discordUserId = $request->route('discordUserId');
    /**
     * @var DiscordUser|null $discordUser
     */
    $discordUser = DiscordUser::find($discordUserId);
    $settings = [];
    if ($discordUser){
      $settings = $this->discordUserService->getSettingsRecord($discordUser);
    }
    $mergedSettings = Settings::mergeWithDefaults($settings);

    return response()->json($mergedSettings);
  }

  function updateShardStats(SaveShardStatsRequest $request):JsonResponse {
    $requestData = $request->validated();

    $shard = BotShard::updateOrCreate([
      'id' => $requestData['id'],
    ], [
      'id' => $requestData['id'],
      'server_count' => $requestData['server_count'],
      'member_count' => $requestData['member_count'],
      'started_at' => $requestData['started_at'],
    ]);
    $shard->touch();

    return response()->json($shard);
  }

  function updateBotCommands(UpdateBotCommandsRequest $request):JsonResponse {
    $requestData = $request->validated();

    $commands = [];
    foreach ($requestData as $commandData){
      /**
       * @var BotCommand $command
       */
      $command = BotCommand::updateOrCreate([
        'name' => $commandData['name'],
      ], [
        'id' => $commandData['id'],
        'name' => $commandData['name'],
        'description' => $commandData['description'],
        'type' => $commandData['type'],
      ]);
      if (!empty($commandData['name_localizations'])){
        foreach ($commandData['name_localizations'] as $locale => $value){
          $this->saveLocalizations(
            command: $command,
            locale: $locale,
            field: 'name',
            value: $value
          );
        }
      }
      if (!empty($commandData['description_localizations'])){
        foreach ($commandData['description_localizations'] as $locale => $value){
          $this->saveLocalizations(
            command: $command,
            locale: $locale,
            field: 'description',
            value: $value
          );
        }
      }
      if (!empty($commandData['options'])){
        foreach ($commandData['options'] as $order => $optionData){
          /**
           * @var BotCommandOption $option
           */
          $option = $command->options()->updateOrCreate([
            'name' => $optionData['name'],
            'type' => $optionData['type'],
          ], [
            'name' => $optionData['name'],
            'description' => $optionData['description'],
            'type' => $optionData['type'],
            'required' => $optionData['required'] ?? false,
            'min_value' => $optionData['min_value'] ?? null,
            'max_value' => $optionData['max_value'] ?? null,
            'min_length' => $optionData['min_length'] ?? null,
            'max_length' => $optionData['max_length'] ?? null,
            'order' => $order,
          ]);
          if (!empty($optionData['name_localizations'])){
            foreach ($optionData['name_localizations'] as $locale => $value){
              $this->saveLocalizations(
                command: $command,
                locale: $locale,
                field: 'name',
                value: $value,
                optionId: $option->id
              );
            }
          }
          if (!empty($optionData['description_localizations'])){
            foreach ($optionData['description_localizations'] as $locale => $value){
              $this->saveLocalizations(
                command: $command,
                locale: $locale,
                field: 'description',
                value: $value,
                optionId: $option->id
              );
            }
          }

          if ($option->deleted_at !== null){
            $option->deleted_at = null;
            $option->save();
          }

          $command->options()
            ->where('name', $option->name)
            ->whereNot('id', $option->id)
            ->update(['deleted_at' => Carbon::now()]);

          switch ($option->type){
            case DiscordBotCommandOptionType::STRING->value:
            case DiscordBotCommandOptionType::NUMBER->value:
            case DiscordBotCommandOptionType::INTEGER->value:
              if (!empty($optionData['choices'])){
                foreach ($optionData['choices'] as $choiceData){
                  /**
                   * @var BotCommandOptionChoice $choice
                   */
                  $choice = $option->choices()->updateOrCreate([
                    'value' => json_encode($choiceData['value']),
                  ], [
                    'value' => $choiceData['value'],
                    'name' => $choiceData['name'],
                  ]);
                  if (!empty($choiceData['name_localizations'])){
                    foreach ($choiceData['name_localizations'] as $locale => $value){
                      $this->saveLocalizations(
                        command: $command,
                        locale: $locale,
                        field: 'name',
                        value: $value,
                        optionId: $option->id,
                        choiceId: $choice->id,
                      );
                    }
                  }
                }
              }
            break;
          }
        }
      }
      $commands[] = $command;
    }

    return response()->json($commands);
  }

  protected function saveLocalizations(BotCommand $command, string $locale, string $field, string $value, ?string $optionId = null, ?string $choiceId = null):void {
    $queryBy = [
      'command_id' => $command->id,
      'option_id' => $optionId,
      'choice_id' => $choiceId,
      'locale' => $locale,
      'field' => $field,
    ];
    $command->translations()->updateOrCreate($queryBy, array_merge(
      $queryBy,
      ['value' => $value]
    ));
  }

  protected function updateBotTimezones(UpdateBotTimezonesRequest $request): Response {
    $data = $request->validated();

    foreach ($data['timezones'] as $timezoneName){
      $botTimezoneData = ['name' => $timezoneName];
      BotTimezone::updateOrCreate($botTimezoneData, $botTimezoneData);
    }

    return response(status: 204);
  }

  public function commandTelemetry(TelemetryRequest $request): JsonResponse {
    $data = $request->validated();

    $command = BotCommand::find($data['commandId']);
    if ($command){
      $command->telemetryExecutions()->create();
    }

    foreach ($data['options'] as $optionData){
      /**
       * @var BotCommandOption|null $option
       */
      $option = $command->options()->where('name', $optionData['name'])->whereNull('deleted_at')->first();
      if ($option){
        $option->telemetryUses()->create();
      }
    }

    $executionNumber = $command->telemetryExecutions()->count();

    return response()->json([
      'executionNumber' => $executionNumber,
      'privacyPolicyUrl' => Url::route('legal', ['locale' => $data['locale']]).'#telemetry-statistics',
      'commandName' => $command->name,
      'commandId' => (string)$command->id,
    ]);
  }

  public function importCrowdinTranslators(Request $request):JsonResponse {
    $bypassCache = $request->boolean('force', false);
    $projectIdentifiersEnv = config('services.crowdin.project_identifiers_for_credits');
    $projectIds = [];

    if ($projectIdentifiersEnv) {
      $identifiers = array_filter(array_map('trim', explode(',', $projectIdentifiersEnv)));
      $projectIds = $this->importTranslatorsService->resolveProjectIdentifiersToIds($identifiers);
    }

    $developerId = config('services.crowdin.developer_id');
    $developerIdInt = null;

    if ($developerId !== null && $developerId !== false && $developerId !== ''){
      $developerIdInt = (int)$developerId;
    }

    $result = $this->importTranslatorsService->import(
      bypassCache: $bypassCache,
      developerIdFilter: $developerIdInt > 0 ? $developerIdInt : null,
      projectIds: $projectIds,
    );

    return response()->json([
      'created' => $result->created,
      'updated' => $result->updated,
      'skipped' => $result->skipped,
      'total' => $result->total(),
    ]);
  }

  public function getCrowdinTranslatorCredits():JsonResponse {
    $translators = Translator::where('translated', '>', 0)->orWhere('voted', '>', 0)->get();

    // Build the indexed report data structure
    $indexedReportData = [
      'users' => [],
      'languages' => [],
    ];

    // Collect all unique user IDs
    $userIds = $translators->pluck('crowdin_user_id')->unique();

    // Build users dictionary, excluding accounts removed from Crowdin
    $crowdinUsers = CrowdinUser::whereIn('id', $userIds)
      ->where('username', '!=', 'REMOVED_USER')
      ->get()
      ->keyBy('id');

    foreach ($crowdinUsers as $user){
      $userData = [
        'username' => $user->username,
        'avatarUrl' => $user->avatar_url,
      ];
      if ($user->full_name){
        $userData['fullName'] = $user->full_name;
      }
      $indexedReportData['users'][(string)$user->id] = $userData;
    }

    foreach ($translators as $translator){
      // Skip translators whose Crowdin account has been removed
      if (!$crowdinUsers->has($translator->crowdin_user_id)){
        continue;
      }
      $langCode = $translator->language_code;
      if (!isset($indexedReportData['languages'][$langCode])){
        $indexedReportData['languages'][$langCode] = [
          'translatorIds' => [],
        ];
      }
      if (!in_array((string)$translator->crowdin_user_id, $indexedReportData['languages'][$langCode]['translatorIds'], true)){
        $indexedReportData['languages'][$langCode]['translatorIds'][] = (string)$translator->crowdin_user_id;
      }
    }

    // Attach per-language progress from the main project only
    $mainProjectId = (int)config('services.crowdin.project_id');
    $progressRecords = TranslationProgress::where('project_id', $mainProjectId)->get();
    foreach ($progressRecords as $progress){
      $langCode = $progress->language_code;
      if (!isset($indexedReportData['languages'][$langCode])){
        $indexedReportData['languages'][$langCode] = ['translatorIds' => []];
      }
      $indexedReportData['languages'][$langCode]['progress'] = [
        'approval' => $progress->approval,
        'translation' => $progress->translation,
      ];
    }

    return response()->json($indexedReportData);
  }
}
