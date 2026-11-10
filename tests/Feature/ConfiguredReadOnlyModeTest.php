<?php

namespace Tests\Feature;

use App\Support\ReadOnlyMode;
use Inertia\Testing\AssertableInertia;
use Tests\TestCase;

/**
 * APP_READ_ONLY: the long-running read-only mode (e.g. while cutting over to a new server)
 */
class ConfiguredReadOnlyModeTest extends TestCase {
  protected function tearDown():void {
    ReadOnlyMode::disable();
    parent::tearDown();
  }

  public function test_writes_are_rejected_without_retry_after():void {
    config(['app.read_only' => true]);

    $response = $this->postJson('/logout')->assertStatus(503);

    $this->assertFalse($response->headers->has('Retry-After'), 'Long read-only mode must not make clients retry');
  }

  public function test_the_frontend_can_ask_whether_it_is_on():void {
    config(['app.read_only' => true]);

    $this->getJson('/frontend/read-only')->assertOk()->assertExactJson(['readOnly' => true])->assertHeader('Cache-Control', 'no-store, private');
  }

  public function test_it_is_off_by_default():void {
    $this->getJson('/frontend/read-only')->assertOk()->assertExactJson(['readOnly' => false]);
  }

  public function test_the_flag_is_kept_out_of_the_cacheable_page_props():void {
    config(['app.read_only' => true]);

    $this->get('/en')->assertOk()->assertInertia(fn(AssertableInertia $page) => $page->missing('app.readOnly'));
  }

  public function test_deploy_window_flag_still_sends_retry_after():void {
    ReadOnlyMode::enable();

    $this->postJson('/logout')->assertStatus(503)->assertHeader('Retry-After');
  }
}
