<?php

return [
  'heading' => 'API Access',
  'description' => 'Időbélyegek létrehozása és az alkalmazás beállításainak módosítása a saját programjaidból. Minden végpont egy app parancshoz tartozik, és a kérések a kulcs létrehozásakor megadott Discord fiók beállításait követik.',
  'overview' => [
    'baseUrl' => 'Base URL',
    'reference' => 'Interactive reference',
    'spec' => 'OpenAPI specification',
  ],
  'keys' => [
    'loginPrompt' => 'Log in to create API keys. The keys act as one of the Discord accounts linked to your profile.',
  ],
  'usage' => [
    'heading' => 'Using the API',
    'authentication' => 'Send your key as a bearer token in the Authorization header of every request.',
    'example' => 'This returns the timestamp for 18:30 today in your saved time zone. The key in the examples is made up, use your own:',
    'limits' => 'Requests are rate limited per key. The RateLimit headers of every response tell you where you stand, and a 429 response comes with a Retry-After header.',
    'statistics' => 'Runs are counted like app commands, and the reply says which run it was, unless you turned telemetry off in your app settings.',
  ],
  'permissions' => [
    'heading' => 'Permissions',
    'description' => 'A key has the permissions it was created with, and the rest of this page refers to them by these codes.',
    'me' => 'Every key can call <1/>, whatever its permissions, to find out which ones it has.',
    'columns' => [
      'permission' => 'Permission',
      'allows' => 'Allows',
    ],
    'scopes' => [
      'timestamps:create' => 'Időbélyegek létrehozása az időbélyeg-végpontok és az MCP tool-ok segítségével, a kulcs által képviselt Discord-fiók használatával.',
      'settings:read' => 'Reading the app settings of that account.',
      'settings:write' => 'Changing the app settings of that account, only the fields that are sent.',
    ],
  ],
  'reference' => [
    'heading' => 'Endpoint reference',
    'description' => 'Every endpoint with the fields it takes and the responses it gives. This is read from the OpenAPI specification of the API server, so it always matches the version that is running.',
    'errors' => 'Errors',
    'errorsDescription' => 'Every error response has this body. The status code tells what kind of error it is, and error.code the exact reason.',
    'optional' => 'optional',
    'unavailable' => 'The reference could not be loaded right now. The interactive reference has the same information.',
    'permission' => 'Permission',
    'anyKey' => 'Any valid key',
    'noKey' => 'No key needed',
    'requestBody' => 'Request body (JSON)',
    'responses' => 'Responses',
    'nullable' => 'Can be null',
  ],
  'mcp' => [
    'heading' => 'Az MCP-kiszolgáló használata',
    'description' => 'Az MCP-kiszolgáló a Streamable HTTP-átviteli protokollt és ugyanazokat a kulcsokat használja. Parancsonként egy tool-t és a beállításokat kínálja, és kizárólag azokat a tool-okat, amelyekre a kulcsod jogosultságai kiterjednek.',
    'url' => 'Kiszolgáló webcíme',
    'placeholderKey' => 'Az alábbi példákban szereplő kulcs kitalált, nem fog működni. Cseréld ki a saját kulcsodra!',
    'claudeCode' => 'A következő paranccsal tudod hozzáadni a Claude Code-hoz:',
    'otherClients' => 'Más kliensek hasonló konfigurációt alkalmaznak, az URL-címmel és egy Authorization header-rel:',
  ],
];
