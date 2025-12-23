<?php

namespace App\Providers;

use App\Jobs\RefreshCrowdinUserInfo;
use App\Jobs\RefreshDiscordUserInfo;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
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

    RateLimiter::for(RefreshDiscordUserInfo::RATE_LIMIT_KEY, function (RefreshDiscordUserInfo $job) {
      return Limit::perHour(1)->by($job->discordUserId);
    });
    RateLimiter::for(RefreshCrowdinUserInfo::RATE_LIMIT_KEY, function (RefreshCrowdinUserInfo $job) {
      return Limit::perHour(1)->by($job->crowdinUserId);
    });
  }

  private function bootCrowdinSocialite() {
    $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
    $socialite->extend(
      'crowdin',
      function ($app) use ($socialite) {
        $config = $app['config']['services.crowdin'];

        return $socialite->buildProvider(CrowdinProvider::class, $config);
      }
    );
  }
}
