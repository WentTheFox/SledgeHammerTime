<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiscordUser extends Model {
  use HasUiInfo;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'name',
    'display_name',
    'discriminator',
    'avatar',
    'access_token',
    'refresh_token',
    'scopes',
    'token_expires',
    'user_id',
    'updated_at',
  ];

  protected $casts = [
    // Since this is a bigint JS might lose precision if it's left as a number
    'id' => 'string',
  ];

  function user():BelongsTo {
    return $this->belongsTo(User::class);
  }

  function settings():HasMany {
    return $this->hasMany(Settings::class);
  }

  function getPublicNameAttribute():string {
    return $this->display_name ?? (trim($this->discriminator) !== '0' ? "{$this->name}#{$this->discriminator}" : $this->name);
  }

  public function getSettingsCacheKeyAttribute():string {
    return "user-settings-{$this->id}";
  }

  function mapToUiInfo():array {
    return [
      'id' => $this->id,
      'name' => $this->public_name,
      'avatar' => $this->avatar,
      'discriminator' => $this->discriminator,
    ];
  }
}
