<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

  function options():HasMany {
    return $this->hasMany(BotCommandOption::class)
      ->withTrashed()
      ->orderBy('required', 'desc')
      ->orderBy('order');
  }

  function translations():HasMany {
    return $this->hasMany(BotCommandTranslation::class, 'command_id')->whereNull('option_id');
  }

  function telemetryExecutions():HasMany {
    return $this->hasMany(TelemetryCommandExecution::class);
  }

  function telemetryUsage() {
    return $this->morphMany(TelemetryUsage::class, 'source');
  }
}
