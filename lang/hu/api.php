<?php

return [
  'heading' => 'API hozzáférés',
  'description' => 'Időbélyegek létrehozása és az alkalmazás beállításainak módosítása a saját programjaidból. Minden végpont egy app parancshoz tartozik, és a kérések a kulcs létrehozásakor megadott Discord fiók beállításait követik.',
  'overview' => [
    'baseUrl' => 'Alap URL',
    'reference' => 'Interaktív kézikönyv',
    'spec' => 'OpenAPI specifikáció',
  ],
  'keys' => [
    'loginPrompt' => 'Jelentkezz be az API-kulcsok létrehozásához. Ezek a kulcsok a profilodhoz kapcsolt Discord-fiókok egyikeként működnek.',
  ],
  'usage' => [
    'heading' => 'Az API használata',
    'authentication' => 'Minden kérésnél az Authorization header-ben kell küldened a kulcsodat.',
    'example' => 'Ez a mai nap 18:30-as időbélyegét adja vissza a mentett időzónádban. A példákban szereplő kulcs kitalált, használd a sajátodat:',
    'limits' => 'A lekérdezések kulcsanként korlátozottak. Minden válasz RateLimit header-jéből megtudhatod, hol tartasz, a 429-es válasz pedig Retry-After header-t tartalmaz.',
    'statistics' => 'A futtatásokat úgy számolja a rendszer, mint az app parancsait, és a válaszban szerepel, hogy melyik futtatásról van szó, kivéve, ha az alkalmazás beállításaiban kikapcsoltad a telemetriát.',
  ],
  'permissions' => [
    'heading' => 'Jogosultságok',
    'description' => 'Egy kulcs rendelkezik azokkal a jogosultságokkal, amelyekkel létrehozták, és az oldal további része ezekre a kódokra hivatkozik.',
    'me' => 'Bármelyik kulcs jogosultságaitól függetlenül meghívhatja a(z) <1/> végpontot, ami visszaadja, milyen jogosultságokkal rendelkezik.',
    'columns' => [
      'permission' => 'Jogosultság',
      'allows' => 'Lehetővé tesz',
    ],
    'scopes' => [
      'timestamps:create' => 'Időbélyegek létrehozása az időbélyeg-végpontok és az MCP tool-ok segítségével, a kulcs által képviselt Discord-fiók használatával.',
      'settings:read' => 'Az adott fiók app beállításainak olvasása.',
      'settings:write' => 'A fiók app beállításainak módosítása, csak az elküldött mezők.',
    ],
  ],
  'reference' => [
    'heading' => 'Végpontok listája',
    'description' => 'Minden végpont a szükséges mezőkkel és a visszaadott válaszokkal együtt. Ezeket az API-kiszolgáló OpenAPI-specifikációjából olvassa be, így mindig megegyeznek a futó verzióval.',
    'errors' => 'Hibák',
    'errorsDescription' => 'Minden hibaüzenetnek ilyen body-ja van. A státusz kód jelzi, hogy milyen típusú hibáról van szó, az error.code pedig a pontos okot.',
    'optional' => 'nem kötelező',
    'unavailable' => 'A lista jelenleg nem tölthető be. Az interaktív hivatkozás ugyanazokat az információkat tartalmazza.',
    'permission' => 'Jogosultság',
    'anyKey' => 'Bármely érvényes kulcs',
    'noKey' => 'Nincs szükség kulcsra',
    'requestBody' => 'Kérés body-ja (JSON)',
    'responses' => 'Válaszok',
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
