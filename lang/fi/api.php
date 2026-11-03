<?php

return [
  'heading' => 'API-yhteys',
  'description' => 'Luo aikaleimoja ja vaihda apin asetuksia omista ohjelmistasi. Jokainen päätepiste vastaa apin komentoa, ja pyynnöt seuraavat sen Discord-tilin asetuksia, jolle avain luotiin.',
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
    'authentication' => 'Lähetä avaimesi bearer-tunnisteena jokaisen pyynnös Authorization-otsikossa.',
    'example' => 'Tämä palauttaa aikaleiman, joka vastaa kello 18.30 tänään tallennetussa aikavyöhykkeessäsi. Avain esimerkeissä on keksitty, käytä omaasi:',
    'limits' => 'Pyynntöjen määrää rajoitetaan avainkohtaisesti. Jokaisen vastauksen RateLimit-otsikot kertovat missä vaiheessa olet, ja HTTP-virhe 429 tulee Retry-After-otsikon mukana.',
    'statistics' => 'Suoritukset lasketaan kuin appikomennot, ja vastaus ilmoittaa monesko suoritus se oli, ellet ole poistanut telemetriatietojen keräämistä käytöstä.',
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
      'settings:read' => 'Lukee käyttäjän apin asetuksia.',
      'settings:write' => 'Vaihtaa käyttäjän apin asetuksia, vain kentät jotka lähetettiin.',
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
    'description' => 'MCP-palvelin käyttää Streamable HTTP -siirtotapaa ja samoja avaimia. Se tarjoaa yhden työkalun kutakin komentoia kohti sekä asetukset, ja vain niitä työkaluja joita avaimesi asetukset sallivat.',
    'url' => 'Palvelimen URL-osoite',
    'placeholderKey' => 'Avain seuraavissa esimerkeissä on keksitty, se ei toimi. Korvaa se yhdellä omista avaimistasi.',
    'claudeCode' => 'Lisää se Claude Codeen seuraavasti:',
    'otherClients' => 'Toiset asiakasohjelmat ottavat samanlaisia konfiguraatioita, URL-osoitteen ja Authorization-otsikon kanssa:',
  ],
];
