<?php

namespace App\Http\Controllers;

use App\Enums\SocialProvider;
use App\Http\Requests\BotLoginRequest;
use App\Http\Requests\OauthProviderRequest;
use App\Models\CrowdinUser;
use App\Models\DiscordUser;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Contracts\Provider as ProviderContract;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use RuntimeException;
use SocialiteProviders\Discord\Provider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AuthController extends Controller {
  protected const string LOGIN_LOCALE_SESSION_KEY = 'login_locale';

  private static function createRedirectUrl(string $provider):string {
    $baseUrl = config('app.url');
    $callback_path = Auth::check() ? 'callback-auth' : 'callback';

    return "$baseUrl/oauth/$callback_path/$provider";
  }

  /**
   * Runs $callback, re-throwing any database error without its query bindings. The upserts below
   * write OAuth access/refresh tokens, and a QueryException's message embeds the full SQL with every
   * bound value - so any failure there (a read-only DB role, a constraint violation, ...) would
   * otherwise put live tokens straight into laravel.log and anywhere else exceptions get reported.
   * The original exception is deliberately not chained as `previous` either, since the logger
   * prints previous exceptions' messages too; only the first line of the driver's error is kept,
   * as Postgres' DETAIL lines can quote column values as well.
   *
   * @template T
   * @param callable(): T $callback
   * @return T
   */
  private static function withoutLoggingQueryBindings(callable $callback):mixed {
    try {
      return $callback();
    } catch (QueryException $e) {
      $driverError = strtok($e->errorInfo[2] ?? '', "\n") ?: 'unknown error';
      throw new RuntimeException("Failed to save login data (SQLSTATE {$e->getCode()}: $driverError), query: {$e->getSql()}");
    }
  }

  private static function createSocialiteDriver(string $provider):ProviderContract {
    /** @var Provider $driver */
    $driver = Socialite::driver($provider);
    return $driver
      ->redirectUrl(self::createRedirectUrl($provider))
      ->stateless();
  }

  public function redirect(OauthProviderRequest $request): \Symfony\Component\HttpFoundation\RedirectResponse {
    $validated = $request->validated();
    $driver = self::createSocialiteDriver($validated['provider']);
    switch ($validated['provider']){
      case SocialProvider::Discord->value:
        // Overwrite scopes from socialite provider package, we do not need nor want user e-mails
        $driver->setScopes(['identify']);
      break;
      case SocialProvider::Crowdin->value:
        // Prevent not found page from showing, no changes needed otherwise
      break;
      default:
        throw new NotFoundHttpException();
    }

    return $driver->redirect();
  }

  public function callbackGuest(OauthProviderRequest $request):RedirectResponse {
    $validated = $request->validated();
    $driver = self::createSocialiteDriver($validated['provider']);
    $data = $driver->user();
    if ($validated['provider'] !== SocialProvider::Discord->value){
      abort(500, "Validated provider {$validated['provider']} does not match expectations");
    }

    $discord_user = $this->updateOrCreateDiscordUser($data);

    /**
     * @type $user User
     */
    $user = $discord_user->user()->first();
    if (!$user){
      $user = Auth::user();
      if (!$user){
        $user = User::create([
          'name' => $discord_user->public_name,
        ]);
      }
      $discord_user->update(['user_id' => $user->id]);
    }

    Auth::login($user);

    $login_locale = session()->pull(self::LOGIN_LOCALE_SESSION_KEY);

    return redirect(RouteServiceProvider::HOME.($login_locale ?? ''));
  }

  public function callbackAuthenticated(OauthProviderRequest $request):RedirectResponse {
    /**
     * @type $user User|null
     */
    $user = Auth::user();
    if (!$user){
      abort(403, "User is not logged in");
    }

    $validated = $request->validated();
    $driver = self::createSocialiteDriver($validated['provider']);
    $data = $driver->user();
    switch ($validated['provider']){
      case SocialProvider::Discord->value:
        $discord_user = $this->updateOrCreateDiscordUser($data);
        $discord_user->update(['user_id' => $user->id]);
      break;
      case SocialProvider::Crowdin->value:
        $this->updateOrCreateCrowdinUser($data, $user);
      break;
      default:
        abort(500, "Validated provider {$validated['provider']} does not match expectations");
    }
    $login_locale = session()->pull(self::LOGIN_LOCALE_SESSION_KEY) ?? App::getLocale();

    return redirect()->route('profile.edit', ['locale' => $login_locale]);
  }

  protected function updateOrCreateDiscordUser(SocialiteUser $data): DiscordUser {
    /**
     * @var DiscordUser $result
     */
    $result = self::withoutLoggingQueryBindings(fn() => DiscordUser::updateOrCreate([
      'id' => $data->getId(),
    ], [
      'id' => $data->getId(),
      'name' => $data->user['username'],
      'display_name' => $data->user['global_name'] ?? null,
      'discriminator' => $data->user['discriminator'],
      'avatar' => $data->user['avatar'],
      'access_token' => $data->token,
      'refresh_token' => $data->refreshToken,
      'scopes' => $data->accessTokenResponseBody['scope'],
      'token_expires' => (new Carbon())->add('seconds', $data->expiresIn),
    ]));

    return $result;
  }

  protected function updateOrCreateCrowdinUser(SocialiteUser $data, User $user): CrowdinUser {
    $username = $data->getName();
    $fullName = $data->getNickname();
    return self::withoutLoggingQueryBindings(fn() => CrowdinUser::updateOrCreate([
      'id' => $data->getId(),
    ], [
      'id' => $data->getId(),
      'username' => $username,
      'full_name' => $fullName === $username ? null : $fullName,
      'avatar_url' => $data->getAvatar(),
      'access_token' => $data->token,
      'refresh_token' => $data->refreshToken,
      'scopes' => $data->accessTokenResponseBody['scope'] ?? null,
      'token_expires' => (new Carbon())->add('seconds', $data->expiresIn),
      'user_id' => $user->id,
    ]));
  }

  public function login(Request $request):RedirectResponse {
    $locale = $request->route('locale') ?? App::getLocale();
    $possible_locales = [
      ...config('languages.supported_locales'),
      ...array_keys(config('languages.locale_route_alias')),
    ];
    if (in_array($locale, $possible_locales, true)){
      session()->put(self::LOGIN_LOCALE_SESSION_KEY, $locale);
    }

    return redirect("/$locale/oauth/redirect/discord");
  }

  /**
   * Destroy an authenticated session.
   */
  public function logout(Request $request):RedirectResponse {
    Auth::guard('web')->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }

  public function botLogin(BotLoginRequest $request): Response {
    if (!$request->hasValidSignature()){
      abort(401);
    }

    $discordUserId = $request->route('discordUserId');
    $locale = $request->route('locale');
    $data = $request->validated();

    /** @var ?User $user */
    $user = self::withoutLoggingQueryBindings(fn() => DB::transaction(function () use ($discordUserId, $data) {
      $discordUser = DiscordUser::updateOrCreate(['id' => $discordUserId], $data);

      /** @var ?User $user */
      $user = $discordUser->user()->first();
      if (!$user){
        $user = $discordUser->user()->create([
          'name' => $discordUser->public_name,
        ]);
        $discordUser->update(['user_id' => $user->id]);
      }

      return $user;
    }));

    if (!$user){
      return response(status: 500);
    }

    Auth::login($user);

    $locale_route_alias = config('languages.locale_route_alias');
    if (array_key_exists($locale, $locale_route_alias)){
      $locale = $locale_route_alias[$locale];
    }

    return redirect()->route('settings', ['locale' => $locale]);
  }

  public function userInfo(Request $request): JsonResponse {
    $requestUser = $request->user();
    if (!$requestUser){
      abort(401);
    }
    return response()->json($requestUser->mapToUiInfo());
  }
}
