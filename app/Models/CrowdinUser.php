<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CrowdinUser extends Model {
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
  ];

  function user():BelongsTo {
    return $this->belongsTo(User::class);
  }
}
