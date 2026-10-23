<?php

namespace Tests\Feature;

use App\Services\Api\PublicApiSpec;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class PublicApiSpecTest extends TestCase {
  private const string SPEC_URL = 'https://api.hammertime.cyou/generated/api-docs.json';

  protected function setUp():void {
    parent::setUp();
    Cache::forget('public-api-openapi');
    Cache::forget('public-api-openapi-failed');
  }

  protected function tearDown():void {
    Cache::forget('public-api-openapi');
    Cache::forget('public-api-openapi-failed');
    parent::tearDown();
  }

  public function test_it_fetches_the_document_from_the_api_server_and_reuses_it():void {
    Http::fake([self::SPEC_URL => Http::response(['openapi' => '3.0.3', 'paths' => ['/at' => []]])]);

    $this->assertSame(['openapi' => '3.0.3', 'paths' => ['/at' => []]], app(PublicApiSpec::class)->get());
    app(PublicApiSpec::class)->get();

    Http::assertSentCount(1);
  }

  public function test_the_api_page_has_the_document(): void {
    Http::fake([self::SPEC_URL => Http::response(['openapi' => '3.0.3', 'paths' => ['/at' => []]])]);

    $this->get('/en/api')->assertOk()->assertInertia(fn(Assert $page) => $page->where('openApi.paths', ['/at' => []]));
  }

  public function test_it_goes_without_the_document_when_the_server_is_down_and_does_not_keep_asking():void {
    Http::fake([self::SPEC_URL => Http::response('nope', 502)]);

    $this->assertNull(app(PublicApiSpec::class)->get());
    $this->assertNull(app(PublicApiSpec::class)->get());
    Http::assertSentCount(1);

    $this->get('/en/api')->assertOk()->assertInertia(fn(Assert $page) => $page->where('openApi', null));
  }

  public function test_it_does_not_accept_something_that_is_not_an_openapi_document():void {
    Http::fake([self::SPEC_URL => Http::response(['paths' => 'nope'])]);

    $this->assertNull(app(PublicApiSpec::class)->get());
  }

  public function test_a_network_error_is_not_fatal():void {
    Http::fake(fn() => throw new \Illuminate\Http\Client\ConnectionException('refused'));

    $this->assertNull(app(PublicApiSpec::class)->get());
  }
}
