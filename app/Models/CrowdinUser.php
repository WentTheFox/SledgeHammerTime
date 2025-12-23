<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrowdinUser extends Model {
  use HasUiInfo;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'username',
    'full_name',
    'avatar_url',
    'access_token',
    'refresh_token',
    'scopes',
    'token_expires',
    'user_id',
    'updated_at',
  ];

  function mapToUiInfo():array {
    return [
      'id' => $this->id,
      'username' => $this->username,
      'fullName' => $this->full_name,
      'avatarUrl' => $this->avatar_url,
    ];
  }

  function user():BelongsTo {
    return $this->belongsTo(User::class);
  }
}
