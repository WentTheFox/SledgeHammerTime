<?php

namespace App\Models;

use App\Enums\AvatarProvider;
use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TranslationCreditOverrideProposal extends Model {
  use HasUuids, HasUiInfo;

  protected $fillable = [
    'id',
    'crowdin_user_id',
    'language_code',
    'proposed_by',
    'rejected_by',
    'rejected_at',
    'display_name',
    'avatar_url',
    'url',
  ];

  protected $casts = [
    'rejected_at' => 'datetime',
  ];

  public function mapToUiInfo():array {
    $avatar = AvatarProvider::parseUri($this->avatar_url);
    return [
      'displayName' => $this->display_name,
      'avatarProvider' => $avatar['provider'] ?? null,
      'avatarId' => $avatar['id'] ?? null,
      'url' => $this->url,
      'rejectedAt' => $this->rejected_at?->toISOString(),
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
  public function proposedBy():BelongsTo {
    return $this->belongsTo(User::class, 'proposed_by');
  }

  /**
   * @return BelongsTo<User, $this>
   */
  public function rejectedBy():BelongsTo {
    return $this->belongsTo(User::class, 'rejected_by');
  }
}
