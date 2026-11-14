<?php

use App\Enums\RouteName;
use App\Http\Middleware\RemoveUselessQueryParams;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class RemoveUselessQueryParamsTest extends TestCase {
  protected function setUp():void {
    parent::setUp();
  }

  private function handle(string $url) {
    $request = Request::create($url);
    $route = app('router')->getRoutes()->match($request);
    $request->setRouteResolver(fn() => $route);

    return (new RemoveUselessQueryParams())->handle($request, fn() => response('Content'));
  }

  public function test_picker_route_with_no_query_string():void {
    $result = $this->handle(route('home', ['locale' => 'en']));

    $this->assertEquals(200, $result->getStatusCode());
  }

  /** @return array<string, array{string}> */
  public static function pickerQueryStrings():array {
    return [
      't' => ['?t=1792969080'],
      'tz' => ['?tz=Asia%2FShanghai'],
      'both' => ['?t=1792969080&tz=GMT%2000:00'],
    ];
  }

  /** @return array<string, array{string}> */
  public static function uselessQueryStrings():array {
    return [
      'amp' => ['?amp'],
      'utm_source' => ['?utm_source=test'],
      'both_useless' => ['?utm_source=test&amp'],
    ];
  }

  /** @return array<string, array{string}> */
  public static function mixedQueryStrings():array {
    return [
      't-amp' => ['?amp&t=1792969080'],
      'tz-amp' => ['?amp&tz=GMT%2000:00'],
    ];
  }

  #[DataProvider('pickerQueryStrings')]
  public function test_picker_route_with_preserved_query_string(string $query):void {
    $result = $this->handle(route(RouteName::HOME->value, ['locale' => 'en']).$query);

    $this->assertNotInstanceOf(Illuminate\Routing\Redirector::class, $result);
    $this->assertNotInstanceOf(Illuminate\Http\RedirectResponse::class, $result);
    $this->assertEquals(200, $result->getStatusCode());
  }

  #[DataProvider('uselessQueryStrings')]
  public function test_picker_route_with_useless_query_string_redirects(string $query):void {
    $path = route(RouteName::HOME->value, ['locale' => 'en'], false);
    $result = $this->handle('http://localhost'.$path.$query);

    $this->assertInstanceOf(Illuminate\Http\RedirectResponse::class, $result);
    $this->assertEquals(302, $result->getStatusCode());
    $this->assertStringEndsWith(ltrim($path, '/'), $result->getTargetUrl());
    $this->assertStringNotContainsString('?', $result->getTargetUrl());
  }

  #[DataProvider('mixedQueryStrings')]
  public function test_picker_route_with_mixed_query_string_keeps_only_useful_params(string $query):void {
    $path = route(RouteName::HOME->value, ['locale' => 'en'], false);
    $result = $this->handle('http://localhost'.$path.$query);

    $this->assertInstanceOf(Illuminate\Http\RedirectResponse::class, $result);
    $target = $result->getTargetUrl();
    $this->assertStringNotContainsString('amp', $target);
    $this->assertMatchesRegularExpression('/[?&](t|tz)=/', $target);
  }
}
