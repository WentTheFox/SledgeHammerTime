<?php

namespace App\Services;

use Illuminate\Http\Client\Response;

interface CreateFromResponseInterface {
  public static function fromResponse(Response $response):self;
}
