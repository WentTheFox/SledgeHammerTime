<?php

return [
  'title' => 'Asetukset',
  'description' => 'Alla näet tämänhetkiset asetukset HammerTime apissa jokaiselle yhdistetylle käyttäjälle.',
  'learnMore' => 'Et ole varma mikä appi on tai kiinnostunut siitä mitä se voi tehdä? Vieraile <1>Discord apin</1> linkissä oppiaksesi lisää.',
  'advancedSettings' => [
    'toggleText' => 'Edistyneet asetukset',
  ],
  'defaultOption' => 'Oletus',
  'fields' => [
    'timezone' => [
      'displayName' => 'Aikavyöhyke',
    ],
    'format' => [
      'displayName' => 'Muoto',
    ],
    'formatMinimalReply' => [
      'displayName' => 'Vain esikatselu vastaus kun muoto vaihtoehto on käytössä',
    ],
    'columns' => [
      'displayName' => 'Sarakkeet',
    ],
    'ephemeral' => [
      'displayName' => 'Katoava',
    ],
    'header' => [
      'displayName' => 'Otsikko',
    ],
    'boldPreview' => [
      'displayName' => 'Esikatsele muoto lihavoituna',
    ],
    'defaultAtHour' => [
      'displayName' => 'Oletuksena ":hourOptionName" vaihtoehto /:atCommandName komentoa varten',
    ],
    'defaultAtMinute' => [
      'displayName' => 'Oletuksena ":minuteOptionName" vaihtoehto /:atCommandName komentoa varten',
    ],
    'defaultAtSecond' => [
      'displayName' => 'Oletuksena ":secondOptionName" vaihtoehto /:atCommandName komentoa varten',
    ],
    'telemetry' => [
      'displayName' => 'Salli telemetrian keräys',
      'explanation' => 'Tämä on täysin vaihtoehtoista eikä sillä ole vaikutusta apin käyttöön. Katso <1/> sivu saadaksesi lisätietoa.',
    ],
    'defaultAt12Hour' => [
      'displayName' => 'Oletuksena ":hourOptionName" vaihtoehto /:at12CommandName komentoa varten',
    ],
  ],
  'saveSuccess' => 'Asetuksesi tallennettiin onnistuneesti.',
];
