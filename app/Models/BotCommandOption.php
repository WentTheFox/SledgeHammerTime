<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasVersion4Uuids as HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BotCommandOption extends Model {
  use HasUuids, SoftDeletes;

  protected $fillable = [
    'bot_command_id',
    'name',
    'type',
    'description',
    'required',
    'order',
    'min_value',
    'max_value',
    'min_length',
    'max_length',
    'deleted_at',
    'total_uses',
  ];

  protected $casts = [
    'deleted_at' => 'datetime',
  ];

  function command():BelongsTo {
    return $this->belongsTo(BotCommand::class);
  }

  function translations():HasMany {
    return $this->hasMany(BotCommandTranslation::class, 'option_id');
  }

  public function choices():HasMany {
    return $this->hasMany(BotCommandOptionChoice::class);
  }

  function telemetryUses():HasMany {
    return $this->hasMany(TelemetryCommandOptionUse::class);
  }

  function telemetryUsage() {
    return $this->morphMany(TelemetryUsage::class, 'source');
  }
}
