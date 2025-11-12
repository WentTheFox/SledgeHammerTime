<?php

return [
  'seoDescription' => 'Genera marques de temps per a missatges de Discord',
  'changeLanguage' => 'Canvia l\'idioma',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "No hi ha res a veure ací.",
  ],
  'incompleteTranslations' => 'Traducció incompleta',
  'contributeTranslations' => 'Contribuïu',
  'copyToClipboard' => 'Copia al porta-retalls',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'No s\'ha trobat JavaScript',
    'body' => "El vostre navegador no és compatible amb JavaScript o està desactivat. Alguns navegadors desactiven JavaScript per defecte per motius de seguretat, però és necessari per a aquesta aplicació. Per favor, activeu-la i refresqueu la pàgina, o utilitzeu un navegador diferent.",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Configuració d\'entrada',
      'customInputs' => [
        'label' => 'Entrades personalitzades',
        'description' => "Replaces the browser's default inputs with custom ones that respect your chosen website language",
      ],
      'separateInputs' => [
        'label' => 'Entrades separades',
        'description' => "Mostra dues entrades diferents per a la data i l'hora en vegada d'una combinada (cosa que no és compatible amb alguns navegadors)",
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
      'details' => 'Detalls',
      'autoApplyCheckbox' => 'Apply calculated offset to DateTime library when pressing :syncButtonLabel manually (only applies if the difference is above the :offset threshold)',
      'syncButtonLabel' => 'Synchronize',
      'resetOffsetButtonLabel' => 'Reset applied offset',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'dtlOffsetCell' => 'Active Calculation Offset',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
    ],
    'localSettings' => [
      'title' => 'Local Settings',
    ],
    'credits' => [
      'title' => 'Crèdits',
      'developedBy' => 'Desenvolupat per <1></1>',
      'using' => 'Utilitzant <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Traducció per <1></1>',
      'openSourceSoftware' => 'Programari de codi obert',
      'viewSourceCode' => 'Vore codi font',
      'notAffiliated' => 'Aquest projecte no està afiliat amb Discord.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
    ],
  ],
  'designEditor' => [
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'CSS Variable',
    'valueColumnHeader' => 'Value',
  ],
];
