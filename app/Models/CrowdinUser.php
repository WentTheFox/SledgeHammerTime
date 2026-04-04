<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CrowdinUser extends Model implements AvatarUrlProvider, ProfileUrlProvider {
  use HasUiInfo;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
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
      'url' => $this->getProfileUrl(),
      'avatarUrl' => $this->avatar_url,
    ];
  }

  public function getAvatarUrl():?string {
    return $this->avatar_url;
  }

  public function getProfileUrl(): string {
    return "https://crowdin.com/profile/{$this->username}";
  }

  /**
   * @return BelongsTo<User, $this>
   */
  function user():BelongsTo {
    return $this->belongsTo(User::class);
  }

  /**
   * @return HasMany<Translator, $this>
   */
  function translators():HasMany {
    return $this->hasMany(Translator::class);
  }

  /**
   * @return HasMany<TranslationCreditOverride, $this>
   */
  function creditOverrides():HasMany {
    return $this->hasMany(TranslationCreditOverride::class);
  }

  /**
   * @return HasMany<TranslationCreditOverrideProposal, $this>
   */
  function creditOverrideProposals():HasMany {
    return $this->hasMany(TranslationCreditOverrideProposal::class);
  }
}
