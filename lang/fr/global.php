<?php

return [
  'seoDescription' => 'Générez des indicateurs d\'horodatage pour les messages Discord',
  'changeLanguage' => 'Changer la langue',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Il n'y a rien a voir ici.",
  ],
  'incompleteTranslations' => 'La traduction est incomplète',
  'contributeTranslations' => 'Contribuer',
  'copyToClipboard' => 'Copier dans le presse papier',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript est nécessaire',
    'body' => "Votre navigateur ne prend pas en charge JavaScript ou il est actuellement désactivé. Certains navigateurs désactivent JavaScript par défaut pour des raisons de sécurité, mais il est nécessaire pour cette application. Veuillez l'activer et rafraîchir la page, ou utiliser un autre navigateur.",
  ],
  'nav' => [
    'botSettings' => 'Paramètre de l\'application',
    'profile' => 'Profil',
    'legal' => 'Information légale',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Paramètres d\'entrée',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Use the date input of the project instead of the browser default",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Use the time input of the project instead of the browser default",
      ],
      'separateInputs' => [
        'label' => 'Saisies séparées',
        'description' => "Afficher deux entrées différentes pour la date et l'heure au lieu d'une entrée combinée (ce qui n'est pas pris en charge par certains navigateurs)",
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
      'details' => 'Détails',
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
      'title' => 'Crédits',
      'developedBy' => 'Développeur <1></1>',
      'using' => 'Utilisant <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Traduit par <1></1>',
      'openSourceSoftware' => 'Logiciel open-source',
      'viewSourceCode' => 'Voir le code source',
      'notAffiliated' => 'Ce projet n\'est pas affilié avec Discord.',
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
