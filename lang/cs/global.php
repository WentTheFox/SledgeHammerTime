<?php

return [
  'seoDescription' => 'Generování ukazatelů časových razítek pro zprávy chatu Discord',
  'changeLanguage' => 'Změnit jazyk',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Není zde nic k zobrazení.",
  ],
  'incompleteTranslations' => 'Překlad není úplný',
  'contributeTranslations' => 'Přispět',
  'copyToClipboard' => 'Zkopírovat do schránky',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript je nezbytný',
    'body' => "Váš prohlížeč buď nepodporuje JavaScript, nebo je momentálně vypnutý. Některé prohlížeče JavaScript ve výchozím nastavení z bezpečnostních důvodů zakazují, ale pro tuto aplikaci je nezbytný. Povolte jej a obnovte stránku nebo použijte jiný prohlížeč.",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Nastavení vstupu',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Oddělit vstupy',
        'description' => "Zobrazí dva odlišné vstupy pro datum a čas namísto jednoho kombinovaného (což v některých prohlížečích nemusí být podporováno)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
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
      'details' => 'Podrobnosti',
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
      'title' => 'Zásluhy',
      'developedBy' => 'Vytvořili <1></1>',
      'using' => 'Použitím <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Přeložili <1></1>',
      'openSourceSoftware' => 'Otevřený software',
      'viewSourceCode' => 'Zobrazit zdrojový kód',
      'notAffiliated' => 'Tento projekt není nijak přidružen k společnosti Discord.',
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
