<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TranslationCreditOverride extends Model {
  use HasUuids, HasUiInfo;

  protected $fillable = [
    'translator_id',
    'created_by',
    'approved_by',
    'displayName',
    'avatarUrl',
    'url',
    'hide',
  ];

  protected $casts = [
    'hide' => 'boolean',
  ];

  public function mapToUiInfo():array {
    return [
      'displayName' => $this->displayName,
      'avatarUrl' => $this->avatarUrl,
      'url' => $this->url,
      'hide' => $this->hide,
    ];
  }

  /**
   * @return BelongsTo<Translator, $this>
   */
  public function translator():BelongsTo {
    return $this->belongsTo(Translator::class);
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
