<?php

namespace App\Http\Controllers;

use App\Enums\TelemetrySource;
use App\Http\Requests\InternalCommandTelemetryRequest;
use App\Http\Requests\InternalSettingsPatchRequest;
use App\Http\Requests\ValidateApiKeyRequest;
use App\Models\BotCommand;
use App\Models\DiscordUser;
use App\Services\ApiKeys\ApiKeyService;
use App\Services\Discord\DiscordUserService;
use App\Services\Telemetry\CommandTelemetryService;
use Illuminate\Http\JsonResponse;
use JsonException;

/**
 * The endpoints the API server (packages/api in HammerTimeBot) uses to reach the data it does not own.
 * Reachable only with the shared secret, see {@see \App\Http\Middleware\InternalServiceMiddleware}.
 */
class InternalApiController extends Controller {
  public function __construct(
    protected ApiKeyService $apiKeyService,
    protected DiscordUserService $discordUserService,
    protected CommandTelemetryService $commandTelemetryService,
  ) {
  }

  /**
   * Which account and scopes an API key stands for, 401 when it is not (or no longer) a valid key
   */
  public function validateKey(ValidateApiKeyRequest $request):JsonResponse {
    $key = $this->apiKeyService->validate($request->validated('token'));
    if ($key === null){
      return response()->json(['message' => 'Unknown, expired or revoked key.'], 401);
    }

    return response()->json($key);
  }

  /**
   * @throws JsonException
   */
  public function settings(string $discordUserId):JsonResponse {
    return response()->json($this->discordUserService->getSettingsWithDefaults($discordUserId));
  }

  /**
   * @throws JsonException
   */
  public function updateSettings(InternalSettingsPatchRequest $request, string $discordUserId):JsonResponse {
    $discordUser = DiscordUser::find($discordUserId);
    if (!$discordUser){
      return response()->json(['message' => 'Unknown Discord account.'], 404);
    }

    $this->discordUserService->patchSettings($discordUser, $request->validated());

    return response()->json($this->discordUserService->getSettingsWithDefaults($discordUserId));
  }

  public function commandTelemetry(InternalCommandTelemetryRequest $request):JsonResponse {
    $data = $request->validated();

    $command = BotCommand::where('name', $data['commandName'])->first();
    if (!$command){
      return response()->json(['message' => 'Unknown command.'], 404);
    }

    return response()->json($this->commandTelemetryService->record(
      $command,
      array_column($data['options'] ?? [], 'name'),
      TelemetrySource::from($data['source']),
      $data['locale'],
    ));
  }
}
