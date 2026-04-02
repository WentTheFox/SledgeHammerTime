<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class TranslationProgress extends Model {
  use HasUuids;

  protected $fillable = [
    'project_id',
    'language_code',
    'translation',
    'approval',
  ];

  protected $casts = [
    'translation' => 'integer',
    'approval' => 'integer',
  ];
}
