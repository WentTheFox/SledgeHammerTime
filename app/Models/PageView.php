<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
  protected $fillable = [
    'route_name',
    'locale',
    'amount',
    'date',
  ];
}
