<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class NoindexQueryVariantsTest extends TestCase {
  use DatabaseTransactions;

  /** @return array<string, array{string, bool}> */
  public static function urls(): array {
    return [
      'plain picker' => ['/en', false],
      'picker t' => ['/en?t=1792969080', true],
      'picker tz' => ['/en?tz=Asia%2FShanghai', true],
      'picker t and tz' => ['/en?t=1792969080&tz=GMT%2000:00', true],
      'picker amp' => ['/en?amp', true],
      'picker amp with empty value' => ['/en?amp=', true],
      'login amp' => ['/en/login?amp', true],
      'legal amp' => ['/en/legal?amp=&t=1791156240', true],
      'plain legal' => ['/en/legal', false],
      // t and tz only mean something to the picker
      'legal t' => ['/en/legal?t=1791156240', false],
      'unrelated parameter' => ['/en?utm_source=newsletter', false],
    ];
  }

  #[DataProvider('urls')]
  public function test_query_variants_are_noindexed(string $url, bool $noindexed): void {
    $response = $this->get($url);

    $this->assertLessThan(400, $response->getStatusCode(), "Unexpected status for $url");
    if ($noindexed) {
      $response->assertHeader('X-Robots-Tag', 'noindex');
    } else {
      $response->assertHeaderMissing('X-Robots-Tag');
    }
  }
}
