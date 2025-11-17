<?php

return [
  'seoDescription' => 'Generišite vremenske oznake za poruke na Discord aplikaciji',
  'changeLanguage' => 'Promeni jezik',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Nema ništa da se vidi ovde.",
  ],
  'incompleteTranslations' => 'Prevodi su nepotpuni',
  'contributeTranslations' => 'Pomogni u prevodu',
  'copyToClipboard' => 'Kopiraj u klipboard',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript je neophodan',
    'body' => "Vaš internet pretraživač ne podržava JavaScript ili ga je onemogućio. Neki internet pretraživači podrazumevano onemogućavaju JavaScript iz bezbednosnih razloga, ali on je neophodan za ovu aplikaciju. Omogućite ga i osvežite stranicu ili koristite drugi internet pretraživač.",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Podešavanja unosa',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Odvojeni ulazi',
        'description' => "Prikaži dva različita unosa za datum i vreme umesto kombinovanog (što nije podržano u nekim internet pretraživačima)",
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
      'title' => 'Autori',
      'developedBy' => 'Naprvaio <1></1>',
      'using' => 'Koristeći <1></1>',
      'fontAwesomeFree' => 'Font Awesome (Besplatna Verzija)',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Prevod <1></1>',
      'openSourceSoftware' => 'Softver otvorenog koda',
      'viewSourceCode' => 'Pogledajte izvorni kod',
      'notAffiliated' => 'Ovaj projekat nije povezan sa Discord-om.',
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
