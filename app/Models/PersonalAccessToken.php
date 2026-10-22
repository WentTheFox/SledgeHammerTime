<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

/**
 * @property string|null $discord_user_id The Discord account an API key acts as, null for tokens that are not API keys
 */
class PersonalAccessToken extends SanctumPersonalAccessToken {
  protected $fillable = [
    'name',
    'token',
    'abilities',
    'expires_at',
    'discord_user_id',
  ];

  protected function casts():array {
    return [
      ...parent::casts(),
      // Since this is a bigint JS might lose precision if it's left as a number
      'discord_user_id' => 'string',
    ];
  }

  /**
   * @return BelongsTo<DiscordUser, $this>
   */
  public function discordUser():BelongsTo {
    return $this->belongsTo(DiscordUser::class);
  }
}
