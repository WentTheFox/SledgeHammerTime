<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class TelemetryUsage extends Model {
  use HasUiInfo;

  protected $table = 'telemetry_usage';

  protected $fillable = [
    'source_id',
    'source_type',
    'date',
    'value',
  ];

  /**
   * @return MorphTo<Model, $this>
   */
  public function source():MorphTo {
    return $this->morphTo('source');
  }

  public function mapToUiInfo():array {
    return [
      'date' => $this->date,
      'value' => $this->value,
    ];
  }
}
