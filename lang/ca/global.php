<?php

return [
  'seoDescription' => 'Genera marques de temps per a missatges de Discord',
  'changeLanguage' => 'Canvia l\'idioma',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "No hi ha res a veure ací.",
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
    'profile' => 'Perfil',
    'legal' => 'Informacio legal',
    'analytics' => 'Analytics',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Configuració d\'entrada',
      'naturalLanguageInput' => [
        'label' => '@time input field',
        'description' => 'Allow manipulating the selected timestamp with natural language (e.g. “in 5 hours”) via an additional free-text input. Similar to the new Discord @time tag. Only a limited number of languages are supported.',
      ],
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Entrades separades',
        'description' => "Mostra dues entrades diferents per a la data i l'hora en vegada d'una combinada (cosa que no és compatible amb alguns navegadors)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
      'hourCycle' => [
        'label' => 'Custom time input clock type',
        'description' => 'Change how hours should be displayed in the custom time input. Has no effect on the previews in the example results column.',
        'options' => [
          'default' => 'Language default',
          'h12' => '12-hour',
          'h24' => '24-hour',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'First day of the week',
        'description' => 'Change which day should be considered the first day of the week in the calendar of the custom date input.',
        'options' => [
          'default' => 'Language default',
        ],
      ],
      'advancedSettings' => 'Advanced input settings',
    ],
    'timeSync' => [
      'title' => 'Sincronització Del Temps',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'El teu rellotge es exacte.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'La diferència entra al temps local i el temps del servidor es :offset.',
      ],
      'details' => 'Detalls',
      'syncButtonLabel' => 'Synchronize',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
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
      'chrono' => 'chrono',
      'translatedBy' => 'Traducció per <1></1>',
      'openSourceSoftware' => 'Programari de codi obert',
      'viewSourceCode' => 'Vore codi font',
      'notAffiliated' => 'Aquest projecte no està afiliat amb Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tema fosc',
      'light' => 'Tema clar',
      'system' => 'Utilitzeu el tema del sistema',
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
