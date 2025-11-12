<?php

return [
  'seoDescription' => 'Genereer tijdsaanduidingen voor Discord chatberichten',
  'changeLanguage' => 'Wijzig taal',
  "notFound" => [
    "heading" => "Pagina Niet Gevonden",
    "content" => "Niets te zien hier.",
  ],
  'incompleteTranslations' => 'Vertalingen zijn onvolledig',
  'contributeTranslations' => 'Draag bij',
  'copyToClipboard' => 'Kopiëren naar klembord',
  'copiedToClipboard' => 'Naar klembord gekopieerd!',
  'jsDisabled' => [
    'title' => 'JavaScript is noodzakelijk',
    'body' => "Uw browser ondersteunt JavaScript niet of het is momenteel uitgeschakeld. Sommige browsers deactiveren JavaScript standaard om veiligheidsredenen, maar het is noodzakelijk voor de werking van deze webapplicatie. Activeer JavaScript en ververs de pagina of gebruik een andere browser.",
  ],
  'nav' => [
    'botSettings' => 'App-instellingen',
    'profile' => 'Profiel',
    'legal' => 'Juridische informatie',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Input instellingen',
      'customInputs' => [
        'label' => 'Aangepaste inputs',
        'description' => "Vervangt de standaardinstellingen van de browser door aangepaste instellingen die rekening houden met de door u gekozen websitetaal",
      ],
      'separateInputs' => [
        'label' => 'Gescheiden inputs',
        'description' => "Toon twee gescheiden inputs voor datum en tijd in plaats van één gecombineerde (sommige browsers ondersteunen de gecombineerde input niet)",
      ],
    ],
    'timeSync' => [
      'title' => 'Time Synchronization',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'Your system clock is accurate.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'The difference between the local and server time is :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Apply server time offset to calculations (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => 'Details',
      'autoApplyCheckbox' => 'Apply calculated offset to DateTime library when pressing :syncButtonLabel manually (only applies if the difference is above the :offset threshold)',
      'syncButtonLabel' => 'Synchroniseer',
      'resetOffsetButtonLabel' => 'Reset applied offset',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'De tijdstempel van de client op het moment van het verzenden van het verzoek',
      't1' => 'De tijdstempel van de server bij ontvangst van het verzoek',
      't2' => 'De tijdstempel van de server bij het verzenden van de respons',
      't3' => 'De tijdstempel van de client bij ontvangst van de respons',
      'dtlOffsetCell' => 'Active Calculation Offset',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
    ],
    'localSettings' => [
      'title' => 'Lokale Instellingen',
    ],
    'credits' => [
      'title' => 'Met dank aan',
      'developedBy' => 'Ontwikkeld door <1></1>',
      'using' => 'Met behulp van <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Vertalingen door <1></1>',
      'openSourceSoftware' => 'Open-source software',
      'viewSourceCode' => 'Bekijk de source code',
      'notAffiliated' => 'Dit project is niet geassocieerd met Discord.',
    ],
    'themeButton' => [
      'dark' => 'Donker Thema',
      'light' => 'Licht Thema',
      'system' => 'Systeemthema gebruiken',
    ],
  ],
  'designEditor' => [
    'title' => 'Ontwerp-editor',
    'description' => 'U kunt veel aspecten van het uiterlijk van de website aanpassen met behulp van de invoervelden in de onderstaande tabel. Variabelenamen zijn gebaseerd op identificatoren in de code en kunnen daarom niet worden vertaald. Waarden worden teruggezet bij het vernieuwen van de pagina.',
    'designPageLink' => 'Ontwerp Pagina',
    'exportInfo' => 'U kunt uw aanpassingen exporteren naar een UserStyle-bestand, dat kan worden gebruikt met een extensie zoals <1>Stylus</1> om het uiterlijk van de app permanent aan te passen. Houd er echter rekening mee dat deze variabelen op elk moment kunnen veranderen, waardoor u uw aangepaste stijlen handmatig moet bijwerken.',
    'export' => 'Exporteren als UserStyle',
    'variableColumnHeader' => 'CSS Variabele',
    'valueColumnHeader' => 'Waarde',
  ],
];
