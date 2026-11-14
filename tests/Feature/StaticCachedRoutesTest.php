<?php

namespace Tests\Feature;

use App\Enums\RouteName;
use App\Http\Middleware\CachePageResponse;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class StaticCachedRoutesTest extends TestCase {
  use DatabaseTransactions;

  /** @return array<string, array{RouteName}> */
  public static function cachedPageRoutes(): array {
    $routes = [];
    foreach (CachePageResponse::ENABLED_ROUTES as $route) {
      $routes[$route->value] = [$route];
    }

    return $routes;
  }

  /**
   * CachePageResponse stores the first response's HTML and serves it to everyone, so a
   * page behind it must not embed whoever happened to request it first - the frontend
   * fetches the user and the Crowdin credits separately for these routes.
   */
  #[DataProvider('cachedPageRoutes')]
  public function test_cached_pages_do_not_embed_the_requesting_user(RouteName $route) {
    $user = User::factory()->create();
    $url = route($route->value, ['locale' => 'en']);
    $this->actingAs($user)->get($url)->assertInertia(fn(AssertableInertia $page) => $page
      ->where('auth.user', null)
      ->where('crowdinData', null)
    );
  }
}
