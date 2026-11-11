<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * The post-deploy smoke test (tests/smoke) waits until the JSON /status reports the commit that was deployed
 */
class StatusBuildTest extends TestCase {
  public function test_status_reports_the_running_build():void {
    config(['app.build' => 'abc1234']);

    $this->getJson('/status')->assertJson(['build' => 'abc1234']);
  }

  public function test_status_reports_unknown_when_the_build_is_not_baked_in():void {
    config(['app.build' => null]);

    $this->getJson('/status')->assertJson(['build' => 'unknown']);
  }
}
