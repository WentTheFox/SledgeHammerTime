<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasVersion4Uuids as HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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

  /**
   * @return BelongsTo<BotCommand, $this>
   */
  function command():BelongsTo {
    return $this->belongsTo(BotCommand::class);
  }

  /**
   * @return HasMany<BotCommandTranslation, $this>
   */
  function translations():HasMany {
    return $this->hasMany(BotCommandTranslation::class, 'option_id');
  }

  /**
   * @return HasMany<BotCommandOptionChoice, $this>
   */
  public function choices():HasMany {
    return $this->hasMany(BotCommandOptionChoice::class);
  }

  /**
   * @return HasMany<TelemetryCommandOptionUse, $this>
   */
  function telemetryUses():HasMany {
    return $this->hasMany(TelemetryCommandOptionUse::class);
  }

  /**
   * @return MorphMany<TelemetryUsage, $this>
   */
  function telemetryUsage():MorphMany {
    return $this->morphMany(TelemetryUsage::class, 'source');
  }
}
