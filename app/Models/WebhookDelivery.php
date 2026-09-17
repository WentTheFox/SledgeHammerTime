<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebhookDelivery extends Model {
  public $timestamps = false;

  protected $fillable = [
    'occurred_at',
    'request_count',
    'error_count',
    'avg_duration_ms',
    'p95_duration_ms',
  ];

  protected $casts = [
    'occurred_at' => 'datetime',
  ];
}
