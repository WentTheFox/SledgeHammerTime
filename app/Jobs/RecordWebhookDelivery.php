<?php

namespace App\Jobs;

use App\Models\WebhookDelivery;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class RecordWebhookDelivery implements ShouldQueue {
  use Queueable;

  public function __construct(
    protected string $occurredAt,
    protected int $statusCode,
    protected int $durationMs,
  ) {
  }

  /**
   * Execute the job.
   */
  public function handle():void {
    WebhookDelivery::create([
      'occurred_at' => $this->occurredAt,
      'error_count' => $this->statusCode >= 400 ? 1 : 0,
      'avg_duration_ms' => $this->durationMs,
      'p95_duration_ms' => $this->durationMs,
    ]);
  }
}
