<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApiKeyRequest;
use App\Services\ApiKeys\ApiKeyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Laravel\Sanctum\NewAccessToken;

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

    return $this->showNewKey($newToken);
  }

  public function rotate(Request $request, string $tokenId):RedirectResponse {
    $newToken = $this->apiKeyService->rotate($request->user(), $tokenId);
    abort_if($newToken === null, 404);

    return $this->showNewKey($newToken);
  }

  private function showNewKey(NewAccessToken $newToken):RedirectResponse {
    // Flashed, not a prop: this is the only time the key is shown and it must not end up in the browser history
    Inertia::flash('newApiKey', [
      'id' => (string)$newToken->accessToken->getKey(),
      'name' => $newToken->accessToken->name,
      'token' => $newToken->plainTextToken,
    ]);

    return $this->backToApiPage();
  }

  public function destroy(Request $request, string $tokenId):RedirectResponse {
    abort_unless($this->apiKeyService->revoke($request->user(), $tokenId), 404);

    return $this->backToApiPage();
  }

  /**
   * Back to the API page, straight to the final URL: the app locale (en_GB) is not the one in the URL (en-GB), and a redirect to the app
   * locale gets redirected again, which uses up the flashed key before the page that shows it is rendered.
   */
  private function backToApiPage():RedirectResponse {
    $appLocale = App::getLocale();
    $urlLocale = array_search($appLocale, config('languages.ui_locale_map'), true);

    return Redirect::route('api', ['locale' => $urlLocale === false ? $appLocale : $urlLocale]);
  }
}
