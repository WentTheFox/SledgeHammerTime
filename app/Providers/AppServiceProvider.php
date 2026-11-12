<?php

namespace App\Providers;

use App\Jobs\RefreshCrowdinUserInfo;
use App\Jobs\RefreshDiscordUserInfo;
use App\Models\PersonalAccessToken;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\RateLimiter;
use Inertia\Ssr\HttpGateway;
use OpenTelemetry\API\Trace\Propagation\TraceContextPropagator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use SocialiteProviders\Crowdin\Provider as CrowdinProvider;

class AppServiceProvider extends ServiceProvider {
  /**
   * Register any application services.
   */
  public function register():void {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot():void {
    $this->bootCrowdinSocialite();
    $this->propagateTraceContextToSsr();

    Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);

    RateLimiter::for(RefreshDiscordUserInfo::RATE_LIMIT_KEY, function (RefreshDiscordUserInfo $job) {
      return Limit::perHour(1)->by($job->discordUserId);
    });
    RateLimiter::for(RefreshCrowdinUserInfo::RATE_LIMIT_KEY, function (RefreshCrowdinUserInfo $job) {
      return Limit::perHour(1)->by($job->crowdinUserId);
    });
  }

  private function bootCrowdinSocialite(): void {
    $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
    $socialite->extend(
      'crowdin',
      function ($app) use ($socialite) {
        $config = $app['config']['services.crowdin'];

        return $socialite->buildProvider(CrowdinProvider::class, $config);
      }
    );
  }

  /**
   * The auto-instrumentation records the SSR call as a client span but does not send `traceparent`, so the SSR server's
   * spans would start separate traces. Only the (internal) SSR server gets the header, not third-party HTTP calls.
   */
  private function propagateTraceContextToSsr(): void {
    $this->app->make(HttpGateway::class)->configureRequestUsing(function (PendingRequest $request): PendingRequest {
      $headers = [];
      TraceContextPropagator::getInstance()->inject($headers);

      return $headers === [] ? $request : $request->withHeaders($headers);
    });
  }
}
