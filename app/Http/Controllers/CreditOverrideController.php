<?php

namespace App\Http\Controllers;

use App\Enums\DiscordButtonStyle;
use App\Enums\DiscordComponentType;
use App\Http\Requests\UpsertCreditOverrideRequest;
use App\Models\CrowdinUser;
use App\Models\TranslationCreditOverride;
use App\Models\TranslationCreditOverrideProposal;
use App\Models\User;
use App\Services\AvatarProvider\AvatarResolverService;
use App\Services\Crowdin\CrowdinCreditsService;
use App\Services\Discord\DiscordUserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class CreditOverrideController extends Controller {
  public function __construct(
    protected CrowdinCreditsService $crowdinCreditsService,
    protected AvatarResolverService $avatarResolver,
    protected DiscordUserService $discordUserService,
  ) {
  }

  public function upsert(UpsertCreditOverrideRequest $request, CrowdinUser $crowdinUser, string $languageCode):RedirectResponse {
    /** @var User $authUser */
    $authUser = Auth::user();

    if (!$authUser->crowdinUsers()->where('id', $crowdinUser->id)->exists()) {
      abort(403);
    }

    $validated = $request->validated();
    $existingOverride = $this->findOverride($crowdinUser->id, $languageCode);

    if ($this->doesSubmittedMatchOverride($validated, $existingOverride)){
      return Redirect::route('profile.edit', ['locale' => App::getLocale()]);
    }

    if ($this->isOnlyHideChanging($validated, $existingOverride)){
      $hide = (bool)($validated['hide'] ?? false);

      if ($existingOverride === null){
        if ($hide){
          TranslationCreditOverride::create([
            'crowdin_user_id' => $crowdinUser->id,
            'language_code' => $languageCode,
            'created_by' => $authUser->id,
            'hide' => true,
          ]);
        }
      }
      else {
        $existingOverride->hide = $hide;
        if ($this->isBlankOverride($existingOverride)){
          $existingOverride->delete();
        }
        else {
          $existingOverride->save();
        }
      }

      $this->crowdinCreditsService->invalidateCache();

      return Redirect::route('profile.edit', ['locale' => App::getLocale()]);
    }

    if ($this->isBlankSubmission($validated)){
      DB::transaction(function () use ($crowdinUser, $languageCode) {
        $this->findProposal($crowdinUser->id, $languageCode)?->delete();
        $this->findOverride($crowdinUser->id, $languageCode)?->delete();
      });

      $this->crowdinCreditsService->invalidateCache();

      return Redirect::route('profile.edit', ['locale' => App::getLocale()]);
    }

    $existingProposal = $this->findProposal($crowdinUser->id, $languageCode);
    if ($existingProposal !== null && $existingProposal->rejected_at === null){
      throw ValidationException::withMessages([
        'proposal' => ['A proposal is already pending approval for this translator.'],
      ]);
    }

    DB::transaction(function () use ($authUser, $crowdinUser, $languageCode, $validated) {
      $proposal = TranslationCreditOverrideProposal::updateOrCreate(
        ['crowdin_user_id' => $crowdinUser->id, 'language_code' => $languageCode],
        array_merge($validated, [
          // Force new ID to invalidate previous approval messages
          'id' => Uuid::uuid4(),
          'proposed_by' => $authUser->id,
          'rejected_by' => null,
          'rejected_at' => null,
        ]),
      );

      $this->sendDiscordWebhook($proposal, $crowdinUser, $languageCode);
    });

    return Redirect::route('profile.edit', ['locale' => App::getLocale()]);
  }

  public function cancelProposal(CrowdinUser $crowdinUser, string $languageCode):Response {
    /** @var User $authUser */
    $authUser = Auth::user();

    if (!$authUser->crowdinUsers()->where('id', $crowdinUser->id)->exists()) {
      abort(403);
    }

    $this->findProposal($crowdinUser->id, $languageCode)?->delete();

    return response(status: 200);
  }

  public function deleteOverride(CrowdinUser $crowdinUser, string $languageCode):RedirectResponse {
    /** @var User $authUser */
    $authUser = Auth::user();

    if (!$authUser->crowdinUsers()->where('id', $crowdinUser->id)->exists()) {
      abort(403);
    }

    DB::transaction(function () use ($crowdinUser, $languageCode) {
      $this->findProposal($crowdinUser->id, $languageCode)?->delete();
      $this->findOverride($crowdinUser->id, $languageCode)?->delete();
    });

    return Redirect::route('profile.edit', ['locale' => App::getLocale()]);
  }

  private function findOverride(int $crowdinUserId, string $languageCode):?TranslationCreditOverride {
    return TranslationCreditOverride::where('crowdin_user_id', $crowdinUserId)
      ->where('language_code', $languageCode)
      ->first();
  }

  private function findProposal(int $crowdinUserId, string $languageCode):?TranslationCreditOverrideProposal {
    return TranslationCreditOverrideProposal::where('crowdin_user_id', $crowdinUserId)
      ->where('language_code', $languageCode)
      ->first();
  }

  protected function sendDiscordWebhook(TranslationCreditOverrideProposal $proposal, CrowdinUser $crowdinUser, string $languageCode):void {
    $webhookUrl = config('services.discord.credits_webhook_url');
    if (!$webhookUrl){
      Log::warning("Credits webhook URL is not configured");

      return;
    }

    $name = ($crowdinUser->full_name
      ? "{$crowdinUser->full_name} ({$crowdinUser->username})"
      : $crowdinUser->username
    );
    $profileUrl = $crowdinUser->getProfileUrl();

    $resolvedAvatarUrl = is_string($proposal->avatar_url)
      ? $this->avatarResolver->resolve($proposal->proposedBy, $proposal->avatar_url)?->getAvatarUrl()
      : null;

    $content = [];
    $mediaGallery = null;
    if ($proposal->display_name !== null){
      $content[] = "Display name: {$proposal->display_name}";
    }
    if ($proposal->url !== null){
      $content[] = "URL: {$proposal->url}";
    }
    if ($proposal->avatar_url !== null){
      $content[] = "Avatar: <$resolvedAvatarUrl> (from `{$proposal->avatar_url}`)";

      if (is_string($resolvedAvatarUrl)){
        $mediaGallery = [
          'type' => DiscordComponentType::MEDIA_GALLERY->value,
          'items' => [
            [
              'media' => [
                'url' => $resolvedAvatarUrl,
              ],
            ],
          ],
        ];
      }
    }

    $contentStr = implode("\n", $content);

    $result = Http::asJson()->post("$webhookUrl?with_components=true", [
      'flags' => 1 << 15,
      'components' => [
        [
          'type' => DiscordComponentType::CONTAINER->value,
          'components' => [
            [
              'type' => DiscordComponentType::TEXT_DISPLAY->value,
              'content' => <<<MD
                  User: [$name](<$profileUrl>) | Language: {$languageCode}
                  $contentStr
                  MD,
            ],
            ...($mediaGallery ? [$mediaGallery] : []),
            [
              'type' => DiscordComponentType::ACTION_ROW->value,
              'components' => [
                [
                  'type' => DiscordComponentType::BUTTON->value,
                  'custom_id' => "approve-proposal:{$proposal->id}",
                  'label' => 'Approve',
                  'style' => DiscordButtonStyle::SUCCESS->value,
                ],
                [
                  'type' => DiscordComponentType::BUTTON->value,
                  'custom_id' => "reject-proposal:{$proposal->id}",
                  'label' => 'Reject',
                  'style' => DiscordButtonStyle::DANGER->value,
                ],
              ],
            ],
          ],
        ],
      ],
    ]);
    if (!$result->successful()){
      throw new RuntimeException("Discord Webhook failed to send: HTTP {$result->status()}\n{$result->body()}");
    }
  }

  /**
   * @param array<string, string> $validated
   */
  private function doesSubmittedMatchOverride(array $validated, ?TranslationCreditOverride $existingOverride):bool {
    return ($existingOverride->display_name ?? null) === ($validated['display_name'] ?? null)
      && ($existingOverride->avatar_url ?? null) === ($validated['avatar_url'] ?? null)
      && ($existingOverride->url ?? null) === ($validated['url'] ?? null)
      && (bool)($existingOverride->hide ?? false) === (bool)($validated['hide'] ?? false);
  }

  /**
   * @param array<string, string> $validated
   */
  private function isOnlyHideChanging(array $validated, ?TranslationCreditOverride $existingOverride):bool {
    return ($existingOverride->display_name ?? null) === ($validated['display_name'] ?? null)
      && ($existingOverride->avatar_url ?? null) === ($validated['avatar_url'] ?? null)
      && ($existingOverride->url ?? null) === ($validated['url'] ?? null)
      && (bool)($existingOverride->hide ?? false) !== (bool)($validated['hide'] ?? false);
  }

  private function isBlankOverride(TranslationCreditOverride $override):bool {
    return !$override->display_name && !$override->avatar_url && !$override->url && !$override->hide;
  }

  /**
   * @param array<string, string> $validated
   */
  private function isBlankSubmission(array $validated):bool {
    return !($validated['display_name'] ?? null)
      && !($validated['avatar_url'] ?? null)
      && !($validated['url'] ?? null);
  }
}
