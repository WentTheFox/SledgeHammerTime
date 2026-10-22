<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApiKeyRequest;
use App\Services\ApiKeys\ApiKeyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

/**
 * Lets a user manage the keys that give programs access to the public API and the MCP server
 * as one of their linked Discord accounts.
 */
class ApiKeyController extends Controller {
  public function __construct(protected ApiKeyService $apiKeyService) { }

  public function store(StoreApiKeyRequest $request):RedirectResponse {
    $data = $request->validated();
    $user = $request->user();

    $newToken = $this->apiKeyService->create(
      $user,
      $user->discordUsers()->findOrFail($data['discord_user_id']),
      $data['name'],
      $data['scopes'],
      isset($data['expires_in_days']) ? now()->addDays((int)$data['expires_in_days']) : null,
    );

    // Flashed, not a prop: this is the only time the key is shown and it must not end up in the browser history
    Inertia::flash('newApiKey', [
      'id' => (string)$newToken->accessToken->getKey(),
      'name' => $newToken->accessToken->name,
      'token' => $newToken->plainTextToken,
    ]);

    return Redirect::route('profile.edit', ['locale' => App::getLocale()]);
  }

  public function destroy(Request $request, string $tokenId):RedirectResponse {
    abort_unless($this->apiKeyService->revoke($request->user(), $tokenId), 404);

    return Redirect::route('profile.edit', ['locale' => App::getLocale()]);
  }
}
