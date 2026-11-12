<?php

namespace App\Providers;

use App\Jobs\RefreshCrowdinUserInfo;
use App\Jobs\RefreshDiscordUserInfo;
use App\Models\PersonalAccessToken;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\RateLimiter;
use Inertia\Ssr\HttpGateway;
use OpenTelemetry\API\Trace\Propagation\TraceContextPropagator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use SocialiteProviders\Crowdin\Provider as CrowdinProvider;

class AppServiceProvider extends ServiceProvider {
  /** Set on the privacy policy page by visitors who opt out of performance monitoring (see public/index.php) */
  public const TRACE_OPT_OUT_COOKIE = 'ht_trace_optout';

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
    // Written by JavaScript on the privacy policy page, so it is plain text
    EncryptCookies::except(self::TRACE_OPT_OUT_COOKIE);
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
      if (request()->cookie(self::TRACE_OPT_OUT_COOKIE) === '1'){
        // PHP records nothing for this visitor, so the SSR server must not either: a valid but unsampled parent
        // makes its sampler drop the trace
        return $request->withHeaders(['traceparent' => sprintf('00-%s-%s-00', bin2hex(random_bytes(16)), bin2hex(random_bytes(8)))]);
      }
      $headers = [];
      TraceContextPropagator::getInstance()->inject($headers);

      return $headers === [] ? $request : $request->withHeaders($headers);
    });
  }
}
