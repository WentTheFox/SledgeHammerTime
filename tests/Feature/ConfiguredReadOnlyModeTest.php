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

  public function test_pages_flag_the_mode_to_the_frontend():void {
    config(['app.read_only' => true]);

    $this->get('/en')->assertOk()->assertInertia(fn(AssertableInertia $page) => $page->where('app.readOnly', true));
  }

  public function test_it_is_off_by_default():void {
    $this->get('/en')->assertOk()->assertInertia(fn(AssertableInertia $page) => $page->where('app.readOnly', false));
  }

  public function test_deploy_window_flag_still_sends_retry_after():void {
    ReadOnlyMode::enable();

    $this->postJson('/logout')->assertStatus(503)->assertHeader('Retry-After');
  }

  public function test_configured_mode_message_is_not_about_an_update():void {
    config(['app.read_only' => true]);

    $this->postJson('/logout')->assertStatus(503)->assertJsonPath('message', 'This instance is read-only, changes are not accepted.');
  }

  public function test_deploy_window_message_mentions_the_update():void {
    ReadOnlyMode::enable();

    $this->postJson('/logout')->assertStatus(503)->assertJsonPath('message', 'The service is temporarily read-only while an update is being applied.');
  }

  public function test_local_settings_cookie_is_still_persisted():void {
    config(['app.read_only' => true]);

    $this->postJson('/frontend/local-settings', [])->assertSuccessful();
  }
}
