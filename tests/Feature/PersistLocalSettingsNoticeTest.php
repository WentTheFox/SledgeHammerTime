<?php

namespace Tests\Feature;

use Tests\TestCase;

class PersistLocalSettingsNoticeTest extends TestCase {
  public function test_the_notice_dismissal_time_is_persisted():void {
    $response = $this->post('/frontend/local-settings', ['privacy-notice-dismissed-at' => '2026-11-13T08:00:00.000Z']);

    $response->assertOk();
    $this->assertStringContainsString('privacy-notice-dismissed-at', $response->getContent());
  }

  public function test_a_value_that_is_not_a_date_is_rejected():void {
    $this->postJson('/frontend/local-settings', ['privacy-notice-dismissed-at' => 'tomorrow-ish-garbage'])->assertUnprocessable();
  }
}
