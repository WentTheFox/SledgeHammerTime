<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
      'id' => (string)$this->id,
      'languageCode' => $this->language_code,
      'translated' => $this->translated,
      'approved' => $this->approved,
      'voted' => $this->voted,
    ];
  }

  /**
   * @return BelongsTo<CrowdinUser, $this>
   */
  public function crowdinUser(): BelongsTo {
    return $this->belongsTo(CrowdinUser::class);
  }
}
