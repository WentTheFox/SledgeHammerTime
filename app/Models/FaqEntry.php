<?php

namespace App\Models;

use App\Traits\HasUiInfo;
use Illuminate\Database\Eloquent\Model;

class FaqEntry extends Model {
  use HasUiInfo;

  protected $primaryKey = 'identifier';
  public $incrementing = false;
  protected $keyType = 'int';

  protected $fillable = [
    'identifier',
    'topic',
    'source_text',
    'converted_html',
  ];

  public function mapToUiInfo(): array {
    return [
      'identifier' => $this->identifier,
      'topic' => $this->topic,
      'body' => $this->converted_html,
    ];
  }
}
