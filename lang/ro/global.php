<?php

return [
  'seoDescription' => 'Generarea indicatorilor timestamp pentru mesajele de chat Discord',
  'changeLanguage' => 'Schimbă limba',
  "notFound" => [
    "heading" => "Pagina nu a fost găsită",
    "content" => "Nimic de văzut aici.",
  ],
  'incompleteTranslations' => 'Traducerile sunt incomplete',
  'contributeTranslations' => 'Contribuie',
  'copyToClipboard' => 'Copiați în clipboard',
  'copiedToClipboard' => 'Copiat în clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript este necesar',
    'body' => "Browserul dvs. fie nu acceptă JavaScript, fie este dezactivat în prezent. Unele browsere dezactivează JavaScript în mod implicit din motive de securitate, dar este necesar pentru această aplicație. Vă rugăm să îl activați și să reîncărcați pagina sau să folosiți un alt browser.",
  ],
  'nav' => [
    'botSettings' => 'Setări aplicație',
    'profile' => 'Profil',
    'legal' => 'Informații legale',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Setări de intrare',
      'customInputs' => [
        'label' => 'Intrări personalizate',
        'description' => "Înlocuiește intrările implicite ale browserului cu intrări personalizate care respectă limba aleasă pentru site-ul web",
      ],
      'separateInputs' => [
        'label' => 'Intrări separate',
        'description' => "Afișarea a două intrări diferite pentru dată și oră în loc de una combinată (care nu este acceptată în unele browsere)",
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
      'title' => 'Setări locale',
    ],
    'credits' => [
      'title' => 'Credite',
      'developedBy' => 'Dezvoltat de <1></1>',
      'using' => 'Folosind <1></1>',
      'fontAwesomeFree' => 'Font Awesome Gratuit',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'data-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Tradus de <1></1>',
      'openSourceSoftware' => 'Software cu sursă deschisă',
      'viewSourceCode' => 'Vezi codul sursă',
      'notAffiliated' => 'Acest proiect nu este afiliat cu Discord.',
    ],
    'themeButton' => [
      'dark' => 'Temă întunecată',
      'light' => 'Temă luminată',
      'system' => 'Utilizați tema sistemului',
    ],
  ],
  'designEditor' => [
    'title' => 'Editor de design',
    'description' => 'Puteți ajusta multe aspecte ale aspectului site-ului utilizând intrările din tabelul de mai jos. Numele variabilelor se bazează pe identificatorii din cod și, prin urmare, nu pot fi traduse. Valorile vor fi resetate la actualizarea paginii.',
    'designPageLink' => 'Pagina de design',
    'exportInfo' => 'Puteți exporta modificările într-un fișier UserStyle, care poate fi utilizat cu o extensie precum <1>Stylus</1> pentru a personaliza permanent aspectul aplicației. Rețineți, totuși, că aceste variabile se pot modifica în orice moment, fiind necesar să vă actualizați manual stilurile personalizate.',
    'export' => 'Exportați ca UserStyle',
    'variableColumnHeader' => 'Variabilă CSS',
    'valueColumnHeader' => 'Valoare',
  ],
];
