<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Translator extends Model {
  use HasUuids;

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

  /**
   * @return BelongsTo<CrowdinUser, $this>
   */
  public function crowdinUser(): BelongsTo {
    return $this->belongsTo(CrowdinUser::class);
  }

  /**
   * @return \Illuminate\Database\Eloquent\Relations\HasOne<TranslationCreditOverride, $this>
   */
  public function creditOverride() {
    return $this->hasOne(TranslationCreditOverride::class);
  }
}
