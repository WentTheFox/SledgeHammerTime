<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebhookDelivery extends Model {
  public $timestamps = false;
  public $incrementing = false;
  protected $keyType = 'string';

  // Without an explicit offset here, Eloquent serializes occurred_at as a bare
  // "Y-m-d H:i:s" string for the INSERT/UPDATE parameter, and Postgres then
  // interprets that offset-less string using the DB session's timezone
  // (config('app.timezone'), since nothing forces the session into UTC) instead
  // of UTC - silently shifting the stored instant by that timezone's offset.
  // Serializing with an explicit offset makes storage (and the read-back) correct
  // regardless of session timezone, without a connection-wide config change.
  protected $dateFormat = 'Y-m-d H:i:sP';

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
