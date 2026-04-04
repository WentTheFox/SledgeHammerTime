<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

use App\Jobs\RefreshCrowdinLocaleData;
use App\Models\CrowdinUser;
use App\Models\TranslationCreditOverride;
use App\Models\TranslationProgress;
use App\Models\Translator;
use App\Services\AvatarProvider\AvatarResolverService;
use DateInterval;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use JsonException;

class CrowdinCreditsService {
  private const string CACHE_KEY = 'crowdin-credits-data-v1';

  public function __construct(protected AvatarResolverService $avatarResolver) {}

  /**
   * @return array{credits: list<array{displayName: string, url: string, avatarUrl: string|null}>, progress: array{translation: int, approval: int}|null}
   * @throws JsonException
   */
  public function getLocaleData(string $locale): array {
    $locale = $this->toCrowdinLocale($locale);
    $cacheTtlMinutes = (int)config('services.crowdin.credits_cache_ttl_minutes', 60);
    $dataKey = $this->getLocaleCacheKey($locale);
    $freshnessKey = $this->getLocaleFreshnessKey($locale);

    $hasFreshData = $cacheTtlMinutes > 0 || Cache::has($freshnessKey);
    $hasData = Cache::has($dataKey);


    if ($hasData) {
      if (!$hasFreshData) {
        RefreshCrowdinLocaleData::dispatch($locale);
      }
      return json_decode(Cache::get($dataKey), associative: true, flags: JSON_THROW_ON_ERROR);
    }

    return $this->refreshLocaleData($locale);
  }

  /**
   * @return array{credits: list<array{displayName: string, url: string, avatarUrl: string|null}>, progress: array{translation: int, approval: int}|null}
   * @throws JsonException
   */
  public function refreshLocaleData(string $locale): array {
    $locale = $this->toCrowdinLocale($locale);
    $cacheTtlMinutes = (int)config('services.crowdin.credits_cache_ttl_minutes', 60);
    $dataKey = $this->getLocaleCacheKey($locale);
    $freshnessKey = $this->getLocaleFreshnessKey($locale);

    $data = $this->buildLocaleData($locale);

    Cache::forever($dataKey, json_encode($data, JSON_THROW_ON_ERROR));
    if ($cacheTtlMinutes > 0) {
      Cache::set($freshnessKey, true, new DateInterval("PT{$cacheTtlMinutes}M"));
    }

    return $data;
  }

  /**
   * @return array<mixed>
   * @throws JsonException
   */
  public function getIndexedReportData(): array {
    $cacheTtlMinutes = (int)config('services.crowdin.credits_cache_ttl_minutes', 60);

    if ($cacheTtlMinutes > 0 && Cache::has(self::CACHE_KEY)) {
      return json_decode(Cache::get(self::CACHE_KEY), associative: true, flags: JSON_THROW_ON_ERROR);
    }

    $data = $this->buildIndexedReportData();

    if ($cacheTtlMinutes > 0) {
      Cache::set(self::CACHE_KEY, json_encode($data, JSON_THROW_ON_ERROR), new DateInterval("PT{$cacheTtlMinutes}M"));
    }

    return $data;
  }

  public function invalidateCache(): void {
    Cache::forget(self::CACHE_KEY);
    foreach (Config::get('languages.supported_locales', []) as $locale) {
      $locale = $this->toCrowdinLocale($locale);
      Cache::forget($this->getLocaleCacheKey($locale));
      Cache::forget($this->getLocaleFreshnessKey($locale));
    }
  }

  private function getLocaleCacheKey(string $locale): string {
    return "crowdin-credits-locale-{$locale}-v1";
  }

  private function getLocaleFreshnessKey(string $locale): string {
    return "crowdin-credits-locale-{$locale}-fresh-v1";
  }

  /**
   * Normalize any locale format (app locale like pt_BR or route locale like pt-BR) to
   * the Crowdin locale code as stored in the database.
   */
  private function toCrowdinLocale(string $locale): string {
    // Convert app locale to route locale (e.g. pt_BR → pt-BR, zh_CN → zh)
    $uiLocaleMapFlip = array_flip(Config::get('languages.ui_locale_map', []));
    $routeLocale = $uiLocaleMapFlip[$locale] ?? $locale;

    // Apply Crowdin-specific overrides for cases where route locale ≠ Crowdin locale (e.g. zh → zh-CN)
    $crowdinLocaleMap = Config::get('languages.crowdin_locale_map', []);
    return $crowdinLocaleMap[$routeLocale] ?? $routeLocale;
  }

  /**
   * @return array<mixed>
   */
  private function buildLocaleData(string $locale): array {
    $mainProjectId = (int)config('services.crowdin.project_id');

    $translators = Translator::where('language_code', $locale)
      ->where(fn($q) => $q->where('translated', '>', 0)->orWhere('voted', '>', 0))
      ->with(['crowdinUser'])
      ->get();

    $progress = TranslationProgress::where('project_id', $mainProjectId)
      ->where('language_code', $locale)
      ->first();

    // Deduplicate by crowdin_user_id, giving the main project's translator precedence.
    $byUser = [];
    foreach ($translators as $translator) {
      $userId = $translator->crowdin_user_id;
      if (!isset($byUser[$userId]) || $translator->project_id === $mainProjectId) {
        $byUser[$userId] = $translator;
      }
    }

    // Load overrides keyed by crowdin_user_id for this locale.
    $crowdinUserIds = array_keys($byUser);
    $overridesByUser = TranslationCreditOverride::whereIn('crowdin_user_id', $crowdinUserIds)
      ->where('language_code', $locale)
      ->get()
      ->keyBy('crowdin_user_id');

    $credits = [];
    foreach ($byUser as $translator) {
      $crowdinUser = $translator->crowdinUser;
      if (!$crowdinUser || $crowdinUser->username === 'REMOVED_USER') {
        continue;
      }

      $override = $overridesByUser->get($translator->crowdin_user_id);

      if ($override?->hide) {
        continue;
      }

      $avatarUrl = $override?->avatar_url !== null
        ? $this->avatarResolver->resolveUri($override->avatar_url)
        : $crowdinUser->avatar_url;

      $credits[] = [
        'displayName' => $override->display_name ?? $crowdinUser->full_name ?? $crowdinUser->username,
        'url' => $override->url ?? $crowdinUser->getProfileUrl(),
        'avatarUrl' => $avatarUrl,
      ];
    }

    return [
      'credits' => $credits,
      'progress' => $progress ? [
        'translation' => $progress->translation,
        'approval' => $progress->approval,
      ] : null,
    ];
  }

  /**
   * @return array{users: array<string, mixed>, languages: array<string, mixed>}
   */
  private function buildIndexedReportData(): array {
    $translators = Translator::where('translated', '>', 0)
      ->orWhere('voted', '>', 0)
      ->get();

    $indexedReportData = [
      'users' => [],
      'languages' => [],
    ];

    $userIds = $translators->pluck('crowdin_user_id')->unique();

    $crowdinUsers = CrowdinUser::whereIn('id', $userIds)
      ->get()
      ->keyBy('id');

    foreach ($crowdinUsers as $user) {
      if ($user->username === 'REMOVED_USER') {
        $userData = null;
      } else {
        $userData = [
          'username' => $user->username,
          'avatarUrl' => $user->avatar_url,
        ];
        if ($user->full_name) {
          $userData['fullName'] = $user->full_name;
        }
      }
      $indexedReportData['users'][(string)$user->id] = $userData;
    }

    foreach ($translators as $translator) {
      if (!$crowdinUsers->has($translator->crowdin_user_id)) {
        continue;
      }
      $langCode = $translator->language_code;
      if (!isset($indexedReportData['languages'][$langCode])) {
        $indexedReportData['languages'][$langCode] = [
          'translatorIds' => [],
        ];
      }
      if (!in_array((string)$translator->crowdin_user_id, $indexedReportData['languages'][$langCode]['translatorIds'], true)) {
        $indexedReportData['languages'][$langCode]['translatorIds'][] = (string)$translator->crowdin_user_id;
      }
    }

    $mainProjectId = (int)config('services.crowdin.project_id');
    $progressRecords = TranslationProgress::where('project_id', $mainProjectId)->get();
    foreach ($progressRecords as $progress) {
      $langCode = $progress->language_code;
      if (!isset($indexedReportData['languages'][$langCode])) {
        $indexedReportData['languages'][$langCode] = ['translatorIds' => []];
      }
      $indexedReportData['languages'][$langCode]['progress'] = [
        'approval' => $progress->approval,
        'translation' => $progress->translation,
      ];
    }

    $approvedOverrides = TranslationCreditOverride::whereNotNull('approved_by')->get();

    foreach ($approvedOverrides as $override) {
      $langCode = $override->language_code;
      $crowdinUserId = (string)$override->crowdin_user_id;

      $indexedReportData['languages'][$langCode] ??= ['translatorIds' => []];
      $indexedReportData['languages'][$langCode]['overrides'] ??= [];
      $indexedReportData['languages'][$langCode]['overrides'][$crowdinUserId] =
        $override->hide ? null : $override->mapToUiInfo();
    }

    return $indexedReportData;
  }
}
