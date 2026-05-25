<?php

return [
  'enabled' => env('ANALYTICS_ENABLED', true),
  'cache_enabled' => env('ANALYTICS_CACHE_ENABLED', true),
  'cache_ttl_minutes' => env('ANALYTICS_CACHE_TTL_MINUTES', 10),
];
