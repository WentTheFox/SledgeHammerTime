<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class StaticCachedRoutesTest extends TestCase {
  use DatabaseTransactions;

  /** @return array<string, array{string}> */
  public static function cachedPageUrls(): array {
    return [
      'picker' => ['/en'],
      'botInfo' => ['/en/app'],
      'legal' => ['/en/legal'],
      'analytics' => ['/en/analytics'],
    ];
  }

  /**
   * CachePageResponse stores the first response's HTML and serves it to everyone, so a
   * page behind it must not embed whoever happened to request it first - the frontend
   * fetches the user and the Crowdin credits separately for these routes.
   */
  #[DataProvider('cachedPageUrls')]
  public function test_cached_pages_do_not_embed_the_requesting_user(string $url) {
    $user = User::factory()->create();

    $this->actingAs($user)->get($url)->assertInertia(fn(AssertableInertia $page) => $page
      ->where('auth.user', null)
      ->where('crowdinData', null)
    );
  }
}
