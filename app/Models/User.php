<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Casts\Json;
use App\Traits\HasUiInfo;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasVersion4Uuids as HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
  /**
   * @use HasFactory<UserFactory>
   */
  use HasApiTokens, HasFactory, Notifiable, HasUuids, HasUiInfo;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'id',
    'name',
    'hidden_formats',
    'horizon_access',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, class-string>
   */
  protected $casts = [
    'hidden_formats' => Json::class,
  ];

  /**
   * @return HasMany<DiscordUser, $this>
   */
  public function discordUsers():HasMany {
    return $this->hasMany(DiscordUser::class);
  }

  /**
   * @return HasMany<CrowdinUser, $this>
   */
  public function crowdinUsers():HasMany {
    return $this->hasMany(CrowdinUser::class);
  }

  /**
   * @return array{id: string, name: string, hiddenFormats: string[], horizonAccess: boolean}
   */
  public function mapToUiInfo():array {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'hiddenFormats' => $this->hidden_formats,
      'horizonAccess' => $this->horizon_access,
    ];
  }
}
