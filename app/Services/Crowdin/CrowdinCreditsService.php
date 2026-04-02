<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

use App\Models\CrowdinUser;
use App\Models\Translator;
use App\Models\TranslationProgress;
use DateInterval;
use Illuminate\Support\Facades\Cache;
use JsonException;

class CrowdinCreditsService {
  private const string CACHE_KEY = 'crowdin-credits-data-v1';

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
  }

  /**
   * @return array{users: array<string, mixed>, languages: array<string, mixed>}
   */
  private function buildIndexedReportData(): array {
    $translators = Translator::where('translated', '>', 0)->orWhere('voted', '>', 0)->get();

    $indexedReportData = [
      'users' => [],
      'languages' => [],
    ];

    $userIds = $translators->pluck('crowdin_user_id')->unique();

    $crowdinUsers = CrowdinUser::whereIn('id', $userIds)
      ->where('username', '!=', 'REMOVED_USER')
      ->get()
      ->keyBy('id');

    foreach ($crowdinUsers as $user) {
      $userData = [
        'username' => $user->username,
        'avatarUrl' => $user->avatar_url,
      ];
      if ($user->full_name) {
        $userData['fullName'] = $user->full_name;
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

    return $indexedReportData;
  }
}
