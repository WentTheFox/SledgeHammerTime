<?php

namespace App\Providers;

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
