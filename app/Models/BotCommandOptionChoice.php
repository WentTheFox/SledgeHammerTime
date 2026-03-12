<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Concerns\HasVersion4Uuids as HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BotCommandOptionChoice extends Model {
  use HasUuids;

  public $timestamps = false;

  protected $fillable = [
    'bot_command_option_id',
    'value',
    'name',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'value' => Json::class,
  ];

  /**
   * @return HasMany<BotCommandTranslation, $this>
   */
  function translations():HasMany {
    return $this->hasMany(BotCommandTranslation::class, 'choice_id');
  }

  /**
   * @return BelongsTo<BotCommandOption, $this>
   */
  public function option():BelongsTo {
    return $this->belongsTo(BotCommandOption::class);
  }
}
