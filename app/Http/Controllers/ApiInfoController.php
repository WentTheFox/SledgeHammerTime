<?php

namespace App\Http\Controllers;

use App\Enums\ApiKeyScope;
use App\Models\DiscordUser;
use App\Models\PersonalAccessToken;
use App\Services\Api\PublicApiSpec;
use App\Services\ApiKeys\ApiKeyService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

/**
 * Everything about the public API and the MCP server in one place: how to use them, and the keys that give access.
 * The page is public, the keys are only listed for a signed-in user.
 */
class ApiInfoController extends Controller {
  public function __construct(protected ApiKeyService $apiKeyService, protected PublicApiSpec $publicApiSpec) { }

  public function index(Request $request):Response {
    $user = $request->user();

    return Inertia::render('Api/IndexComponent', [
      // Null when the API server can not be reached, the page then points to its own reference
      'openApi' => $this->publicApiSpec->get(),
      'authenticated' => $user !== null,
      'apiUrl' => rtrim((string)config('services.public_api.url'), '/'),
      'apiKeys' => $user ? $this->apiKeyService->listFor($user)->map(fn(PersonalAccessToken $key) => [
        'id' => (string)$key->getKey(),
        'name' => $key->name,
        'discordUserId' => $key->discord_user_id,
        'scopes' => $key->abilities,
        'createdAt' => $key->created_at,
        'lastUsedAt' => $key->last_used_at,
        'expiresAt' => $key->expires_at,
      ])->values() : [],
      'discordUsers' => $user ? $user->discordUsers()->get()->map(fn(DiscordUser $du) => $du->mapToUiInfo())->values() : [],
      'apiKeyScopes' => ApiKeyScope::values(),
      'maxApiKeys' => ApiKeyService::MAX_KEYS_PER_DISCORD_USER,
    ]);
  }
}
