<?php

return [
  'title' => 'Setări aplicație',
  'description' => 'Mai jos puteți vedea setările curente din aplicația HammerTime pentru fiecare cont conectat.',
  'learnMore' => 'Nu sunteți sigur ce este aplicația sau sunteți curios ce poate face? Vizitați link-ul <1>Discord App</1> pentru a afla mai multe.',
  'advancedSettings' => [
    'toggleText' => 'Setări avansate',
  ],
  'defaultOption' => 'Default',
  'fields' => [
    'timezone' => [
      'displayName' => 'Fus orar',
    ],
    'format' => [
      'displayName' => 'Formatul',
    ],
    'formatMinimalReply' => [
      'displayName' => 'Răspuns numai pentru previzualizare atunci când se utilizează opțiunea de formatare',
    ],
    'columns' => [
      'displayName' => 'Coloane',
    ],
    'ephemeral' => [
      'displayName' => 'Efemer',
    ],
    'header' => [
      'displayName' => 'Antet',
    ],
    'boldPreview' => [
      'displayName' => 'Format previzualizare ca bold',
    ],
    'defaultAtHour' => [
      'displayName' => 'Opțiunea implicită „:hourOptionName” pentru comanda /:atCommandName',
    ],
    'defaultAtMinute' => [
      'displayName' => 'Opțiunea implicită „:minuteOptionName” pentru comanda /:atCommandName',
    ],
    'defaultAtSecond' => [
      'displayName' => 'Opțiunea implicită „:secondOptionName” pentru comanda /:atCommandName',
    ],
    'telemetry' => [
      'displayName' => 'Permiteți colectarea telemetriei',
      'explanation' => 'Acest lucru este complet opțional și nu are niciun efect asupra capacității de a folosi bot-ul. Vezi pagina <1/> pentru detalii.',
    ],
    'defaultAt12Hour' => [
      'displayName' => 'Opțiunea implicită „:hourOptionName” pentru comanda /:at12CommandName',
    ],
  ],
  'saveSuccess' => 'Setările dvs. au fost salvate cu succes.',
];
