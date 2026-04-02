<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Translator extends Model {
  use HasUuids, HasUiInfo;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'project_id',
    'crowdin_user_id',
    'language_code',
    'translated',
    'approved',
    'voted',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'translated' => 'integer',
    'approved' => 'integer',
    'voted' => 'integer',
  ];

  public function mapToUiInfo(): array {
    return [
      'languageCode' => $this->language_code,
      'translated' => $this->translated,
      'approved' => $this->approved,
      'voted' => $this->voted,
      'override' => $this->creditOverride()->first()?->mapToUiInfo(),
    ];
  }

  /**
   * @return BelongsTo<CrowdinUser, $this>
   */
  public function crowdinUser(): BelongsTo {
    return $this->belongsTo(CrowdinUser::class);
  }

  /**
   * @return HasOne<TranslationCreditOverride, $this>
   */
  public function creditOverride() {
    return $this->hasOne(TranslationCreditOverride::class);
  }
}
