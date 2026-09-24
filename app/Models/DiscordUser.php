<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiscordUser extends Model implements AvatarUrlProvider {
  use HasUiInfo;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
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

  /**
   * OAuth tokens never leave the model - see the casts below.
   *
   * @var list<string>
   */
  protected $hidden = [
    'access_token',
    'refresh_token',
  ];

  protected $casts = [
    // Since this is a bigint JS might lose precision if it's left as a number
    'id' => 'string',
    // Encrypted with APP_KEY at rest, so a leaked row/dump/log of a failed query never exposes a
    // usable token - rotating APP_KEY requires listing the old key in APP_PREVIOUS_KEYS
    'access_token' => 'encrypted',
    'refresh_token' => 'encrypted',
  ];

  /**
   * @return BelongsTo<User, $this>
   */
  function user():BelongsTo {
    return $this->belongsTo(User::class);
  }

  /**
   * @return HasMany<Settings, $this>
   */
  function settings():HasMany {
    return $this->hasMany(Settings::class);
  }

  function getPublicNameAttribute():string {
    return $this->display_name ?? (trim($this->discriminator) !== '0' ? "{$this->name}#{$this->discriminator}" : $this->name);
  }

  public function getSettingsCacheKeyAttribute():string {
    return "user-settings-{$this->id}";
  }

  function getAvatarUrl():string {
    if (!empty($this->avatar)) {
      $avatarFileExtension = str_starts_with($this->avatar, 'a_') ? 'gif' : 'png';

      return "https://cdn.discordapp.com/avatars/{$this->id}/{$this->avatar}.$avatarFileExtension";
    }

    // Default avatar logic
    $defaultAvatarFileName = (
      $this->discriminator === '0'
        ? (intval($this->id) >> 22)   // New username system
        : intval($this->discriminator) // Old username system
      ) % 5;

    return "https://cdn.discordapp.com/embed/avatars/{$defaultAvatarFileName}.png";
  }

  function mapToUiInfo():array {
    return [
      'id' => $this->id,
      'name' => $this->public_name,
      'avatarUrl' => $this->getAvatarUrl(),
      'discriminator' => $this->discriminator,
    ];
  }
}
