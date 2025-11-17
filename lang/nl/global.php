<?php

return [
  'seoDescription' => 'Genereer tijdsaanduidingen voor Discord chatberichten',
  'changeLanguage' => 'Wijzig taal',
  "notFound" => [
    "heading" => "Pagina Niet Gevonden",
    "content" => "Niets te zien hier.",
  ],
  "maintenanceMode" => [
    "heading" => "Maintenance Mode",
    "content" => [
      'pleaseWait' => "The application is currently being updated, please try again in a few seconds.",
      'joinSupportServer' => "If the issue persists for more than a few minutes, please join the Discord support server and let us know.",
      'contactDeveloper' => "If the issue persists for more than a few minutes, please contact the developer and let them know.",
    ],
    "supportServerButton" => "Support Server",
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
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Gescheiden inputs',
        'description' => "Toon twee gescheiden inputs voor datum en tijd in plaats van één gecombineerde (sommige browsers ondersteunen de gecombineerde input niet)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
    ],
    'timeSync' => [
      'title' => 'Tijdsynchronisatie',
      'status' => [
        'syncing' => 'Uw systeemklok wordt momenteel gesynchroniseerd met onze servers. Een moment geduld a.u.b.',
        'accurate' => 'Uw systeemklok is accuraat.',
        'potentiallyWrong' => 'Het kan zijn dat uw systeemklok fout is.',
        'value' => 'Het verschil tussen uw lokale tijd en de servertijd is :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Server tijd toepassen op berekeningen (bèta)',
        'description' => 'Als uw systeemklok meer dan :offset verschilt met de servertijd (exclusief tijdsverschil door tijdzones), zullen sommige tijdsberekeningen aangepast worden om hier rekening mee te houden. Hierdoor is er een kleinere kans dat de tijdstempels incorrect zijn. <1>Dit is een experimentele feature, dus wees voorzichtig!</1> Het synchroniseren gebeurt wanneer de pagina geladen wordt, en meteen nadat de instelling aangezet wordt.',
      ],
      'details' => 'Details',
      'autoApplyCheckbox' => 'Pas berekend tijdsverschil toe aan de DateTime library wanneer handmatig op :syncButtonLabel wordt gedrukt (past alleen toen wanneer het verschil hoger is dan :offset)',
      'syncButtonLabel' => 'Synchroniseer',
      'resetOffsetButtonLabel' => 'Reset tijdsverschil',
      'roundTripDuration' => 'Heen-en-terugtijd',
      't0' => 'De tijdstempel van de client op het moment van het verzenden van het verzoek',
      't1' => 'De tijdstempel van de server bij ontvangst van het verzoek',
      't2' => 'De tijdstempel van de server bij het verzenden van de respons',
      't3' => 'De tijdstempel van de client bij ontvangst van de respons',
      'dtlOffsetCell' => 'Actieve correctie berekeningen',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Gedetecteerd verschil (via Netwerk)',
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
