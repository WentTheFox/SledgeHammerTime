<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model {
  public $timestamps = false;

  protected $fillable = [
    'route_name',
    'locale',
    'amount',
    'date',
  ];
}
