<?php

namespace App\Http\Controllers;

use App\Enums\DiscordBotCommandOptionType;
use App\Enums\ReviewDecision;
use App\Http\Middleware\CachePageResponse;
use App\Http\Requests\BotLoginRequest;
use App\Http\Requests\ReviewTranslationCreditOverrideProposal;
use App\Http\Requests\SaveWebhookDeliveryRequest;
use App\Http\Requests\TelemetryRequest;
use App\Http\Requests\UpdateBotCommandsRequest;
use App\Http\Requests\UpdateBotTimezonesRequest;
use App\Http\Requests\UpdateFaqEntriesRequest;
use App\Models\BotCommand;
use App\Models\BotCommandOption;
use App\Models\BotCommandOptionChoice;
use App\Models\BotTimezone;
use App\Models\DiscordUser;
use App\Models\FaqEntry;
use App\Models\Settings;
use App\Models\TranslationCreditOverride;
use App\Models\TranslationCreditOverrideProposal;
use App\Models\User;
use App\Models\WebhookDelivery;
use App\Services\Crowdin\CrowdinCreditsService;
use App\Services\Crowdin\ImportCrowdinTranslatorsService;
use App\Services\Discord\DiscordUserService;
use App\Services\Discord\GetUserResponse;
use App\Services\DiscordMarkdownService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class BotApiController extends Controller {
  public function __construct(
    protected DiscordUserService $discordUserService,
    protected ImportCrowdinTranslatorsService $importTranslatorsService,
    protected CrowdinCreditsService $crowdinCreditsService,
    protected DiscordMarkdownService $discordMarkdownService,
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

  function storeWebhookDelivery(SaveWebhookDeliveryRequest $request):JsonResponse {
    $requestData = $request->validated();

    WebhookDelivery::create([
      'occurred_at' => $requestData['occurred_at'],
      'error_count' => $requestData['status_code'] >= 400 ? 1 : 0,
      'avg_duration_ms' => $requestData['duration_ms'],
      'p95_duration_ms' => $requestData['duration_ms'],
    ]);

    return response()->json(['success' => true]);
  }

  function updateBotCommands(UpdateBotCommandsRequest $request):JsonResponse {
    $requestData = $request->validated();

    $commands = DB::transaction(function () use ($requestData) {
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

        // Collected across the whole command (including its options/choices) and
        // synced against the DB in one pass at the end - doing this per-locale as
        // we used to (~40 languages x several fields x every option/choice) made
        // this endpoint the slowest step of every bot deploy (30s-2min).
        $pendingTranslations = [];
        $this->collectLocalizations($pendingTranslations, $commandData['name_localizations'] ?? [], 'name');
        $this->collectLocalizations($pendingTranslations, $commandData['description_localizations'] ?? [], 'description');

        foreach ($commandData['options'] ?? [] as $order => $optionData){
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
          $this->collectLocalizations($pendingTranslations, $optionData['name_localizations'] ?? [], 'name', $option->id);
          $this->collectLocalizations($pendingTranslations, $optionData['description_localizations'] ?? [], 'description', $option->id);

          if ($option->deleted_at !== null){
            $option->deleted_at = null;
            $option->save();
          }

          // Cleans up a stale row left behind under the same name with a now-outdated
          // type (updateOrCreate's match key is name+type, so a type change creates a
          // new row rather than updating the old one in place) - scoped to this
          // option's own name, not a general "remove options missing from this sync".
          $command->options()
            ->where('name', $option->name)
            ->whereNot('id', $option->id)
            ->update(['deleted_at' => Carbon::now()]);

          switch ($option->type){
            case DiscordBotCommandOptionType::STRING->value:
            case DiscordBotCommandOptionType::NUMBER->value:
            case DiscordBotCommandOptionType::INTEGER->value:
              foreach ($optionData['choices'] ?? [] as $choiceData){
                /**
                 * @var BotCommandOptionChoice $choice
                 */
                $choice = $option->choices()->updateOrCreate([
                  'value' => json_encode($choiceData['value']),
                ], [
                  'value' => $choiceData['value'],
                  'name' => $choiceData['name'],
                ]);
                $this->collectLocalizations($pendingTranslations, $choiceData['name_localizations'] ?? [], 'name', $option->id, $choice->id);
              }
            break;
          }
        }

        $this->syncLocalizations($command->id, $pendingTranslations);

        $commands[] = $command;
      }

      return $commands;
    });

    CachePageResponse::forgetPage('botinfo');

    return response()->json($commands);
  }

  /**
   * @param array<array{locale: string, field: string, value: string, option_id: ?string, choice_id: ?string}> $pending
   * @param array<string, string> $localizations
   */
  private function collectLocalizations(array &$pending, array $localizations, string $field, ?string $optionId = null, ?string $choiceId = null):void {
    foreach ($localizations as $locale => $value){
      $pending[] = [
        'locale' => $locale,
        'field' => $field,
        'value' => $value,
        'option_id' => $optionId,
        'choice_id' => $choiceId,
      ];
    }
  }

  /**
   * Syncs every collected (command|option|choice, locale, field) -> value pair for a single
   * command against bot_command_translations in one upsert, relying on the
   * bot_command_translations_natural_key unique constraint (command_id, option_id, choice_id,
   * locale, field) instead of an application-side preload-then-insert/update.
   *
   * That constraint is also what makes this safe under concurrent requests: the old
   * preload-then-decide approach let two overlapping syncs (e.g. a bot deploy client retrying
   * this endpoint after a timeout while the first, slow, request was still running) each decide
   * a row didn't exist yet and both insert it - an upsert against a real unique constraint can't
   * do that, since a conflicting concurrent insert either waits and then updates, or updates in
   * place. This also drops the preload SELECT entirely, which was the other major contributor
   * to this endpoint OOMing on its default 128M memory_limit for commands with a lot of
   * accumulated (largely duplicate) rows.
   *
   * @param array<array{locale: string, field: string, value: string, option_id: ?string, choice_id: ?string}> $pending
   */
  private function syncLocalizations(string $commandId, array $pending):void {
    if (empty($pending)){
      return;
    }

    $rows = array_map(fn(array $row) => [
      'command_id' => $commandId,
      'option_id' => $row['option_id'],
      'choice_id' => $row['choice_id'],
      'locale' => $row['locale'],
      'field' => $row['field'],
      'value' => $row['value'],
    ], $pending);

    DB::table('bot_command_translations')->upsert(
      $rows,
      ['command_id', 'option_id', 'choice_id', 'locale', 'field'],
      ['value'],
    );
  }

  protected function updateBotTimezones(UpdateBotTimezonesRequest $request):Response {
    $data = $request->validated();

    foreach ($data['timezones'] as $timezoneName){
      $botTimezoneData = ['name' => $timezoneName];
      BotTimezone::updateOrCreate($botTimezoneData, $botTimezoneData);
    }

    return response(status: 204);
  }

  public function commandTelemetry(TelemetryRequest $request):JsonResponse {
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

    if ($projectIdentifiersEnv){
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

    $this->crowdinCreditsService->invalidateCache();

    return response()->json([
      'created' => $result->created,
      'updated' => $result->updated,
      'skipped' => $result->skipped,
      'total' => $result->total(),
    ]);
  }

  public function getCrowdinTranslatorCredits():JsonResponse {
    return response()->json($this->crowdinCreditsService->getIndexedReportData());
  }

  public function reviewCreditOverride(ReviewTranslationCreditOverrideProposal $request, TranslationCreditOverrideProposal $proposal):JsonResponse {
    $data = $request->validated();
    $reviewerDiscordUser = $this->discordUserService->updateUserInfo(
      GetUserResponse::fromArray($data['approver'])
    );
    $reviewerUser = $reviewerDiscordUser->user()->first();
    if (!$reviewerUser || !$reviewerUser->horizon_access){
      return response()->json([
        'success' => false,
        'message' => 'You do not have permission to review credit overrides',
      ]);
    }
    switch ($data['decision']){
      case ReviewDecision::APPROVE->value:
        $isBlank = !$proposal->display_name && !$proposal->avatar_url && !$proposal->url;

        DB::transaction(function () use ($proposal, $isBlank, $reviewerUser) {
          if ($isBlank){
            TranslationCreditOverride::where('crowdin_user_id', $proposal->crowdin_user_id)
              ->where('language_code', $proposal->language_code)
              ->delete();
          }
          else {
            $override = TranslationCreditOverride::updateOrCreate(
              ['crowdin_user_id' => $proposal->crowdin_user_id, 'language_code' => $proposal->language_code],
              [
                'created_by' => $proposal->proposed_by,
                'display_name' => $proposal->display_name,
                'avatar_url' => $proposal->avatar_url,
                'url' => $proposal->url,
              ],
            );
            $override->approved_by = $reviewerUser->id;
            $override->approved_at = now();
            $override->save();
          }
          $proposal->delete();
        });

        $this->crowdinCreditsService->invalidateCache();
      break;
      case ReviewDecision::REJECT->value:
        $proposal->rejected_by = $reviewerUser->id;
        $proposal->rejected_at = now();
        $proposal->save();
      break;
      default:
        return response()->json([
          'success' => false,
          'message' => "Unhandled review decision: {$data['decision']}",
        ]);
    }

    return response()->json(['success' => true]);
  }

  public function updateFaqEntries(UpdateFaqEntriesRequest $request): JsonResponse {
    $data = $request->validated();
    $entries = $data['entries'];

    // Convert mention arrays to id => name mappings
    $channels = $this->mentionArrayToMap($data['channels'] ?? []);
    $users = $this->mentionArrayToMap($data['users'] ?? []);
    $roles = $this->mentionArrayToMap($data['roles'] ?? []);
    $guildId = $data['guild_id'];

    DB::transaction(function () use ($entries, $channels, $users, $roles, $guildId) {
      FaqEntry::truncate();

      $now = now();
      $rows = array_map(fn(array $entry) => [
        'identifier' => $entry['identifier'],
        'topic' => $entry['topic'],
        'source_text' => $entry['source_text'],
        'converted_html' => $this->discordMarkdownService->convert(
          $entry['source_text'],
          $channels,
          $users,
          $roles,
          $guildId
        ),
        'created_at' => $now,
        'updated_at' => $now,
      ], $entries);

      if (!empty($rows)) {
        FaqEntry::insert($rows);
      }
    });

    return response()->json(['count' => count($entries)]);
  }

  /**
   * Convert mention arrays with id/name to id => name mappings
   *
   * @param array<array{id: ?string, name: ?string}> $mentions
   *
   * @return array<string, string> Mapping of ID to name
   */
  private function mentionArrayToMap(array $mentions): array {
    $map = [];
    foreach ($mentions as $mention) {
      if (isset($mention['id'], $mention['name'])) {
        $map[(string)$mention['id']] = $mention['name'];
      }
    }
    return $map;
  }
}
