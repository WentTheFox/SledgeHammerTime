<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\HorizonApplicationServiceProvider;

class HorizonServiceProvider extends HorizonApplicationServiceProvider {
  /**
   * Bootstrap any application services.
   */
  public function boot():void {
    parent::boot();
  }

  /**
   * Register the Horizon gate.
   * This gate determines who can access Horizon in non-local environments.
   */
  protected function gate():void {
    Gate::define('viewHorizon', fn($user = null) => optional($user)->horizon_access === true);
  }
}
