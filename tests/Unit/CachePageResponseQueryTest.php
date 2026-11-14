<?php

namespace Tests\Unit;

use App\Enums\RouteName;
use App\Http\Middleware\CachePageResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class CachePageResponseQueryTest extends TestCase {
  private const VALID_PAGE = '<!DOCTYPE html><html><body><script data-page="app" type="application/json">{"component":"Picker\/IndexComponent"}</script><div data-server-rendered="true" id="app">%s</div></body></html>';

  protected function setUp(): void {
    parent::setUp();
    config(['app.page_cache.enabled' => true, 'app.url' => 'http://localhost']);
    Cache::flush();
  }

  private function page(string $marker): string {
    return sprintf(self::VALID_PAGE, $marker);
  }

  private function handle(string $url, string $renderedMarker, string $page = RouteName::HOME->value) {
    $request = Request::create($url);
    $route = app('router')->getRoutes()->match($request);
    $request->setRouteResolver(fn() => $route);

    return (new CachePageResponse())->handle($request, fn() => response($this->page($renderedMarker)), $page);
  }

  private function cacheKey(): string {
    return CachePageResponse::cacheKey(RouteName::HOME, App::getLocale(), null);
  }

  public function test_plain_requests_are_stored(): void {
    $this->handle('http://localhost/en', 'plain')->getContent();

    $this->assertNotNull(Cache::get($this->cacheKey()));
  }

  /** @return array<string, array{string}> */
  public static function queryUrls(): array {
    return [
      't' => ['http://localhost/en?t=1792969080'],
      'tz' => ['http://localhost/en?tz=Asia%2FShanghai'],
      'both' => ['http://localhost/en?t=1792969080&tz=GMT%2000:00'],
    ];
  }

  #[DataProvider('queryUrls')]
  public function test_renders_for_t_and_tz_are_never_stored(string $url): void {
    $content = $this->handle($url, 'locked')->getContent();

    $this->assertStringContainsString('locked', $content);
    $this->assertNull(Cache::get($this->cacheKey()));
  }

  #[DataProvider('queryUrls')]
  public function test_t_and_tz_requests_are_served_the_cached_generic_page(string $url): void {
    $this->handle('http://localhost/en', 'plain');

    $content = $this->handle($url, 'locked')->getContent();

    $this->assertStringContainsString('plain', $content);
    $this->assertStringNotContainsString('locked', $content);
  }

  public function test_renders_with_any_query_are_never_stored_on_other_pages(): void {
    $this->handle('http://localhost/en/legal?t=1', 'legal', RouteName::LEGAL->value);

    $this->assertNull(Cache::get(CachePageResponse::cacheKey(RouteName::LEGAL, App::getLocale(), null)));
  }

  public function test_plain_requests_are_stored_on_other_pages(): void {
    $this->handle('http://localhost/en/legal', 'legal', RouteName::LEGAL->value);

    $this->assertNotNull(Cache::get(CachePageResponse::cacheKey(RouteName::LEGAL, App::getLocale(), null)));
  }
}
