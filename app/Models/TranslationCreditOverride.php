<?php

namespace App\Models;

use App\Enums\AvatarProvider;
use App\Services\AvatarProvider\AvatarResolverService;
use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TranslationCreditOverride extends Model {
  use HasUuids, HasUiInfo;

  protected $fillable = [
    'crowdin_user_id',
    'language_code',
    'created_by',
    'approved_by',
    'approved_at',
    'display_name',
    'avatar_url',
    'url',
    'hide',
  ];

  protected $casts = [
    'hide' => 'boolean',
    'approved_at' => 'datetime',
  ];

  public function mapToUiInfo():array {
    $avatar = AvatarProvider::parseUri($this->avatar_url);
    $avatarUrl = null;
    if ($this->avatar_url !== null) {
      /**
       * @var AvatarResolverService $avatarResolverService
       */
      $avatarResolverService = app(AvatarResolverService::class);
      $avatarUrl = $avatarResolverService->resolveUri($this->avatar_url);
    }
    return [
      'displayName' => $this->display_name,
      'avatarProvider' => $avatar['provider'] ?? null,
      'avatarId' => $avatar['id'] ?? null,
      'avatarUrl' => $avatarUrl,
      'url' => $this->url,
      'hide' => $this->hide,
    ];
  }

  /**
   * @return BelongsTo<CrowdinUser, $this>
   */
  public function crowdinUser():BelongsTo {
    return $this->belongsTo(CrowdinUser::class);
  }

  /**
   * @return BelongsTo<User, $this>
   */
  public function createdBy():BelongsTo {
    return $this->belongsTo(User::class, 'created_by');
  }

  /**
   * @return BelongsTo<User, $this>
   */
  public function approvedBy():BelongsTo {
    return $this->belongsTo(User::class, 'approved_by');
  }
}
