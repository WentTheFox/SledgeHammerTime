<?php

return [
  'heading' => 'API Access',
  'description' => 'Generate timestamps and change your app settings from your own programs. Every endpoint matches an app command, and requests follow the settings of the Discord account the key was created for.',
  'overview' => [
    'baseUrl' => 'Juuriosoite',
    'reference' => 'Interaktiivinen viite',
    'spec' => 'OpenAPI-spesifikaatio',
  ],
  'keys' => [
    'loginPrompt' => 'Kirjaudu sisään luodaksesi API-avaimia. Avaimet toimivat kuin yhtenä profiiliisi linkitetyistä Discord-tileistä.',
  ],
  'usage' => [
    'heading' => 'API:n käyttö',
    'authentication' => 'Send your key as a bearer token in the Authorization header of every request.',
    'example' => 'Tämä palauttaa aikaleiman, joka vastaa kello 18.30 tänään tallennetussa aikavyöhykkeessäsi. Avain esimerkeissä on keksitty, käytä omaasi:',
    'limits' => 'Requests are rate limited per key. The RateLimit headers of every response tell you where you stand, and a 429 response comes with a Retry-After header.',
    'statistics' => 'Runs are counted like app commands, and the reply says which run it was, unless you turned telemetry off in your app settings.',
  ],
  'permissions' => [
    'heading' => 'Käyttöoikeudet',
    'description' => 'Avaimella on ne käyttöoikeudet, joilla se oli luotu, ja loput tästä sivusta viittaa niihin näillä koodeilla.',
    'me' => 'Jokainen avain voi kutsua <1/>-funktiota, riippumatta sen käyttöoikeuksista, selvittääkseen mitkä sillä on.',
    'columns' => [
      'permission' => 'Käyttöoikeus',
      'allows' => 'Sallii',
    ],
    'scopes' => [
      'timestamps:create' => 'Aikaleimojen luominen aikaleima-päätepisteillä ja MCP-työkaluilla, Discord-tilinä jona avain toimii.',
      'settings:read' => 'Reading the app settings of that account.',
      'settings:write' => 'Changing the app settings of that account, only the fields that are sent.',
    ],
  ],
  'reference' => [
    'heading' => 'Päätepisteen viite',
    'description' => 'Jokainen päätepiste sekä sen kentät ja antamat vastaukset. Tämä luetaan OpenAPI-spesifikaatiosta API-palvelimesta, eli se täsmää aina käytössä olevaa versiota.',
    'errors' => 'Virheet',
    'errorsDescription' => 'Jokaisella virhevasteella on tämä runko. Tilakoodi kertoo minkälainen virhe se on, ja error.code kertoo tarkan syyn.',
    'optional' => 'valinnainen',
    'unavailable' => 'Viitettä ei voitu juuri nyt ladata. Interaktiivisella viitteellä on sama tieto.',
    'permission' => 'Käyttöoikeus',
    'anyKey' => 'Mikä tahansa kelvollinen avain',
    'noKey' => 'Avainta ei tarvita',
    'requestBody' => 'Pyynnön runko (JSON)',
    'responses' => 'Vastaukset',
    'nullable' => 'Voi olla tyhjä',
  ],
  'mcp' => [
    'heading' => 'Käyttää MCP-palvelinta',
    'description' => 'The MCP server uses the Streamable HTTP transport and the same keys. It offers one tool per command plus settings, and only the tools your key\'s permissions allow.',
    'url' => 'Palvelimen URL-osoite',
    'placeholderKey' => 'Avain seuraavissa esimerkeissä on keksitty, se ei toimi. Korvaa se yhdellä omista avaimistasi.',
    'claudeCode' => 'Lisää se Claude Codeen seuraavasti:',
    'otherClients' => 'Toiset asiakasohjelmat ottavat samanlaisia konfiguraatioita, URL-osoitteen ja Authorization-otsikon kanssa:',
  ],
];
