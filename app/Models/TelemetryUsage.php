<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Model;

class TelemetryUsage extends Model {
  use HasUiInfo;

  protected $table = 'telemetry_usage';

  protected $fillable = [
    'source_id',
    'source_type',
    'date',
    'value',
  ];

  public function source() {
    return $this->morphTo('source');
  }

  public function mapToUiInfo():array {
    return [
      'date' => $this->date,
      'value' => $this->value,
    ];
  }
}
