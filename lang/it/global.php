<?php

return [
  'seoDescription' => 'Generate timestamp indicators for Discord chat messages',
  'changeLanguage' => 'Change language',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Nothing to see here.",
  ],
  'incompleteTranslations' => 'Translations are incomplete',
  'contributeTranslations' => 'Contribute',
  'copyToClipboard' => 'Copy to clipboard',
  'copiedToClipboard' => 'Copied to clipboard!',
  'guest' => 'Guest',
  'jsDisabled' => [
    'title' => 'JavaScript is necessary',
    'body' => "Your browser either does not support JavaScript or it's currently disabled. Some browsers disable JavaScript by default for security reasons, but it's necessary for this application. Please enable it and refresh the page, or use a different browser.",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Input settings',
      'customInputs' => [
        'label' => 'Custom inputs',
        'description' => "Replaces the browser's default inputs with custom ones that respect your chosen website language",
      ],
      'separateInputs' => [
        'label' => 'Separate inputs',
        'description' => "Display two different inputs for date and time instead of a combined one (which is not supported in some browsers)",
      ],
      'legacyDateTimeLibrary' => [
        'label' => 'Use legacy datetime library',
        'description' => 'The library used by the old application to calculate timestamps is not maintained anymore, so it needed to be replaced. This option lets you return to the old library in cse you encounter issues. It\'s recommended to completely reload the page after changing this setting.',
      ],
    ],
    'localSettings' => [
      'title' => 'Local Settings',
    ],
    'credits' => [
      'title' => 'Credits',
      'developedBy' => 'Developed by <1></1>',
      'using' => 'Using <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'momentJs' => 'Moment.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Translations by <1></1>',
      'openSourceSoftware' => 'Open-source software',
      'viewSourceCode' => 'View source code',
      'notAffiliated' => 'This project is not affiliated with Discord.',
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
