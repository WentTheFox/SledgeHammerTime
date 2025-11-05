<?php

return [
  'seoDescription' => 'Genereer tijdsaanduidingen voor Discord chatberichten',
  'changeLanguage' => 'Wijzig taal',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Niets te zien hier.",
  ],
  'incompleteTranslations' => 'Vertalingen zijn onvolledig',
  'contributeTranslations' => 'Draag bij',
  'copyToClipboard' => 'Kopiëren naar klembord',
  'copiedToClipboard' => 'Copied to clipboard!',
  'guest' => 'Guest',
  'jsDisabled' => [
    'title' => 'JavaScript is noodzakelijk',
    'body' => "Uw browser ondersteunt JavaScript niet of het is momenteel uitgeschakeld. Sommige browsers deactiveren JavaScript standaard om veiligheidsredenen, maar het is noodzakelijk voor de werking van deze webapplicatie. Activeer JavaScript en ververs de pagina of gebruik een andere browser.",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profiel',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Input instellingen',
      'customInputs' => [
        'label' => 'Aangepaste inputs',
        'description' => "Replaces the browser's default inputs with custom ones that respect your chosen website language",
      ],
      'separateInputs' => [
        'label' => 'Gescheiden inputs',
        'description' => "Toon twee gescheiden inputs voor datum en tijd in plaats van één gecombineerde (sommige browsers ondersteunen de gecombineerde input niet)",
      ],
      'autoTimeSync' => [
        'label' => 'Synchronize time with server (beta)',
        'description' => 'If your system clock is over 15 minutes off compared to the server time (excluding timezone differences), all calculations will be adjusted to take this into account, so your timestamps remain accurate. Synchronization happens on each reload.',
      ],
    ],
    'localSettings' => [
      'title' => 'Local Settings',
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
  'timeSync' => [
    'title' => 'Server Time Sync',
    'description' => 'This feature synchronizes your local time with the HammerTime servers. This is done automatically, completely transparent to the user, but it\'s also possible to trigger this process manually when needed.',
    'autoApplyCheckbox' => 'Apply calculated offset to DateTime library',
    'syncButtonLabel' => 'Synchronize',
    'syncResultsHeading' => 'Synchronization Results',
    't0' => 'The client\'s timestamp of the request transmission',
    't1' => 'The server\'s timestamp of the request reception',
    't2' => 'The server\'s timestamp of the response transmission',
    't3' => 'The client\'s timestamp of the response reception',
    'dtlOffsetCell' => 'Current Offset (DateTime library)',
    'timestampValue' => ':value s',
    'offsetAmount' => ':offset ms',
    'networkOffsetCell' => 'Calculated Offset (Network)',
  ],
];
