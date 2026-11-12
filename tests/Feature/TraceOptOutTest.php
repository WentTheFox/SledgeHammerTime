<?php

namespace Tests\Feature;

use App\Providers\AppServiceProvider;
use Inertia\Ssr\HttpGateway;
use ReflectionMethod;
use ReflectionProperty;
use Tests\TestCase;

class TraceOptOutTest extends TestCase {
  /** @return array<string, string> */
  private function ssrRequestHeaders():array {
    $gateway = app(HttpGateway::class);
    $request = (new ReflectionMethod($gateway, 'pendingRequest'))->invoke($gateway);

    return (new ReflectionProperty($request, 'options'))->getValue($request)['headers'] ?? [];
  }

  public function test_the_ssr_request_of_an_opted_out_visitor_has_an_unsampled_parent():void {
    $this->withUnencryptedCookie(AppServiceProvider::TRACE_OPT_OUT_COOKIE, '1');
    $this->get('/frontend/does-not-exist');

    $this->app->instance('request', \Illuminate\Http\Request::create('/', 'GET', cookies: [AppServiceProvider::TRACE_OPT_OUT_COOKIE => '1']));
    $this->assertMatchesRegularExpression('/^00-[0-9a-f]{32}-[0-9a-f]{16}-00$/', $this->ssrRequestHeaders()['traceparent'] ?? '');
  }

  public function test_the_cookie_is_not_encrypted():void {
    $response = $this->withUnencryptedCookie(AppServiceProvider::TRACE_OPT_OUT_COOKIE, '1')->get('/frontend/does-not-exist');

    $response->assertNotFound();
    $this->assertSame('1', $this->app['request']->cookie(AppServiceProvider::TRACE_OPT_OUT_COOKIE));
  }
}
