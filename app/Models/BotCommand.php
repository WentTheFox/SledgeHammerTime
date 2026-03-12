<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class BotCommand extends Model {
  protected $fillable = [
    'id',
    'name',
    'description',
    'type',
    'deleted_at',
    'total_executions',
  ];

  protected $casts = [
    'id' => 'string',
  ];

  /**
   * @return HasMany<BotCommandOption, $this>
   */
  function options():HasMany {
    return $this->hasMany(BotCommandOption::class)
      ->withTrashed()
      ->orderBy('required', 'desc')
      ->orderBy('order');
  }

  /**
   * @return HasMany<BotCommandTranslation, $this>
   */
  function translations():HasMany {
    return $this->hasMany(BotCommandTranslation::class, 'command_id')->whereNull('option_id');
  }

  /**
   * @return HasMany<TelemetryCommandExecution, $this>
   */
  function telemetryExecutions():HasMany {
    return $this->hasMany(TelemetryCommandExecution::class);
  }

  /**
   * @return MorphMany<TelemetryUsage, $this>
   */
  function telemetryUsage():MorphMany {
    return $this->morphMany(TelemetryUsage::class, 'source');
  }
}
