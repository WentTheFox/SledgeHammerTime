<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasVersion4Uuids as HasUuids;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model {
  use HasUuids;

  public $timestamps = false;

  protected $fillable = [
    'route_name',
    'locale',
    'amount',
    'date',
    'is_crawler',
  ];

  protected $casts = [
    'is_crawler' => 'boolean',
  ];
}
