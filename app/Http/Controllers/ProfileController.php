<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Jobs\RefreshCrowdinUserInfo;
use App\Jobs\RefreshDiscordUserInfo;
use App\Models\CrowdinUser;
use App\Models\DiscordUser;
use App\Models\Translator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller {
  /**
   * Display the user's profile form.
   */
  public function edit(Request $request):Response {
    $discordUsers = [];
    $crowdinUsers = [];
    $authUser = Auth::user();
    if ($authUser){
      $discordUsers = $authUser->discordUsers()->get()->map(function (DiscordUser $du) {
        $result = $du->mapToUiInfo();
        if ($du->updated_at->addHours(1)->isPast()) {
          $result['staleAt'] = now();
          RefreshDiscordUserInfo::dispatch($du->id);
        }

        return $result;
      });
      $crowdinProjectId = config('services.crowdin.project_id');
      $crowdinUsers = $authUser->crowdinUsers()->with(['translators', 'creditOverrides', 'creditOverrideProposals'])->get()->map(function (CrowdinUser $cu) use ($crowdinProjectId) {
        $result = $cu->mapToUiInfo();
        if ($cu->updated_at->addHours(1)->isPast()) {
          $result['staleAt'] = now();
          RefreshCrowdinUserInfo::dispatch((string)$cu->id);
        }

        $overridesByLang = $cu->creditOverrides->keyBy('language_code');
        $proposalsByLang = $cu->creditOverrideProposals->keyBy('language_code');

        $result['translators'] = $cu->translators
          ->groupBy('language_code')
          ->map(fn($group) => $group->firstWhere('project_id', $crowdinProjectId) ?? $group->first())
          ->values()
          ->map(function (Translator $t) use ($overridesByLang, $proposalsByLang) {
            return array_merge($t->mapToUiInfo(), [
              'override' => $overridesByLang->get($t->language_code)?->mapToUiInfo(),
              'proposal' => $proposalsByLang->get($t->language_code)?->mapToUiInfo(),
            ]);
          });

        return $result;
      });
    }

    return Inertia::render('Profile/IndexComponent', [
      'discordUsers' => $discordUsers,
      'crowdinUsers' => $crowdinUsers,
    ]);
  }

  /**
   * Update the user's profile information.
   */
  public function update(ProfileUpdateRequest $request):RedirectResponse {
    $request->user()->fill($request->validated());

    $request->user()->save();

    return Redirect::route('profile.edit', ['locale' => App::getLocale()]);
  }

  /**
   * Delete the user's account.
   */
  public function destroy(Request $request):RedirectResponse {
    $user = $request->user();

    Auth::logout();

    $user->delete();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return Redirect::to('/');
  }
}
