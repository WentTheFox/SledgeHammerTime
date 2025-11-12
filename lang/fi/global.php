<?php

return [
  'seoDescription' => 'Luo aikaleimailmaisimet Discord-chat-viesteille',
  'changeLanguage' => 'Vaihda kieltä',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Täällä ei ole mitään nähtävää.",
  ],
  'incompleteTranslations' => 'Käännökset eivät ole täydellisiä',
  'contributeTranslations' => 'Avusta',
  'copyToClipboard' => 'Kopioi leikepöydälle',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript on tarpeellinen',
    'body' => "Sinun selaimesi joko ei tue JavaScriptiä, tai se on pois käytöstä. Jotkut selaimet poistaa JavaScriptin käytöstä oletuksena turvallisuussyistä, mutta se on tarpeellinen tälle sovellukselle. Ole hyvä ja ota se käyttöön ja päivitä sivu, tai käytä eri selainta.",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Syöttöasetukset',
      'customInputs' => [
        'label' => 'Mukautetut syötteet',
        'description' => "Replaces the browser's default inputs with custom ones that respect your chosen website language",
      ],
      'separateInputs' => [
        'label' => 'Erilliset tulot',
        'description' => "Näytä kaksi eri päivämäärän ja kellonajan syötettä yhdistetyn syötteen sijaan (mitä ei tueta joissakin selaimissa)",
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
      'title' => 'Tekijät',
      'developedBy' => 'Kehittänyt <1></1>',
      'using' => 'Käyttämällä <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Käännökset <1></1>',
      'openSourceSoftware' => 'avoimen lähdekoodin ohjelmisto',
      'viewSourceCode' => 'Vilkaise lähdekoodia',
      'notAffiliated' => 'Tämä projekti ei ole sidoksissa Discordin kanssa.',
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
