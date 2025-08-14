<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\CrowdinUser;
use App\Models\DiscordUser;
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
      $discordUsers = $authUser->discordUsers()->get(['id', 'name', 'display_name', 'discriminator', 'avatar'])->map(fn(DiscordUser $du) => $du->mapToUiInfo());
      $crowdinUsers = $authUser->crowdinUsers()->get(['id', 'username', 'full_name', 'avatar_url'])->map(fn(CrowdinUser $cu) => $cu->mapToUiInfo());
    }

    return Inertia::render('Profile/Index', [
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
