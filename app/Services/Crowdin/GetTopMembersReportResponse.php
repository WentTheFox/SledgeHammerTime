<?php

declare(strict_types=1);

namespace App\Services\Crowdin;

use App\Models\CrowdinUser;
use App\Services\CreateFromResponseInterface;
use Illuminate\Http\Client\Response;
use Log;

/**
 * Response from Crowdin top members report.
 * @see https://support.crowdin.com/developer/api/v2/#tag/Reports/operation/api.projects.reports.post
 */
final readonly class GetTopMembersReportResponse implements CreateFromResponseInterface {

  /**
   * @param TranslationContribution[] $contributors
   */
  public function __construct(
    public array $contributors,
  ) {
  }

  public static function fromResponse(Response $response): self {
    return self::fromJson($response->json());
  }

  public static function fromJson(mixed $data): self {
    if (!is_array($data) || empty($data['data'])) {
      Log::warning('Top members report returned empty data', [
        'response_keys' => is_array($data) ? array_keys($data) : gettype($data),
      ]);
      return new self(contributors: []);
    }

    $contributors = [];

    foreach ($data['data'] ?? [] as $entry) {
      $userData = $entry['user'] ?? [];

      if (empty($userData['id'])) {
        continue;
      }

      // Create or update CrowdinUser
      $username = $userData['username'] ?? null;
      $crowdinUser = CrowdinUser::updateOrCreate([
        'id' => (int)$userData['id'],
      ], [
        'id' => (int)$userData['id'],
        'username' => $username,
        'full_name' => self::normalizeFullName($userData['fullName'] ?? null, $username),
        'avatar_url' => $userData['avatarUrl'] ?? null,
      ]);

      // Get stats for this user (across all languages)
      $translationStrings = (int)($entry['translated'] ?? 0);
      $approvalStrings = (int)($entry['approved'] ?? 0);
      $votedStrings = (int)($entry['voted'] ?? 0);

      // Create a contributor record for each language the user contributed to
      foreach ($entry['languages'] ?? [] as $language) {
        if (empty($language['id'])) {
          continue;
        }

        $contributors[] = new TranslationContribution(
          crowdinUser: $crowdinUser,
          languageCode: $language['id'],
          translationStrings: $translationStrings,
          approvalStrings: $approvalStrings,
          votedStrings: $votedStrings,
        );
      }
    }

    Log::info('Parsed top members report', [
      'total_records' => count($contributors),
    ]);

    return new self(contributors: $contributors);
  }

  protected static function normalizeFullName(?string $fullName, ?string $username): ?string {
    if ($fullName === $username) {
      $fullName = null;
    } else {
      $usernameSuffix = " ($username)";
      if (str_ends_with($fullName, $usernameSuffix)) {
        $fullName = rtrim(substr($fullName, 0, -1 * strlen($usernameSuffix)));
      }
    }
    return $fullName;
  }
}
