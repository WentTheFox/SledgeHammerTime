<?php

return [
  'seoDescription' => 'Generator znaczników czasu dla wiadomości wysyłanych w Discord',
  'changeLanguage' => 'Zmień język',
  "notFound" => [
    "heading" => "Nie znaleziono strony",
    "content" => "Niczego tutaj nie ma.",
  ],
  'incompleteTranslations' => 'Tłumaczenia są niekompletne',
  'contributeTranslations' => 'Wspomóż',
  'copyToClipboard' => 'Copy to clipboard',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript jest wymagany',
    'body' => "Twoja przeglądarka nie wspiera JavaScript lub jest on aktualnie wyłączony. Niektóre przeglądarki domyślnie wyłączają JavaScripta ze względów bezpieczeństwa, lecz jest on wymagany dla tej aplikacji. Proszę go włączyć i odświeżyć stronę lub użyć innej przeglądarki.",
  ],
  'nav' => [
    'botSettings' => 'Ustawienia aplikacji',
    'profile' => 'Profil',
    'legal' => 'Informacje prawne',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Ustawienia wprowadzania',
      'customInputs' => [
        'label' => 'Pola niestandardowe',
        'description' => "Replaces the browser's default inputs with custom ones that respect your chosen website language",
      ],
      'separateInputs' => [
        'label' => 'Osobne pola',
        'description' => "Wyświetla dwa różne pola na datę i czas zamiast połączonych pól (które są nieobsługiwane przez niektóre przeglądarki)",
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
      'title' => 'Ustawienia lokalne',
    ],
    'credits' => [
      'title' => 'Autorzy',
      'developedBy' => 'Stworzone przez <1></1>',
      'using' => 'Używając <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Tłumaczenia przez <1></1>',
      'openSourceSoftware' => 'Oprogramowanie open-source',
      'viewSourceCode' => 'Zobacz kod źródłowy',
      'notAffiliated' => 'Ten projekt nie jest powiązany z Discordem.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
    ],
  ],
  'designEditor' => [
    'title' => 'Edytor projektu',
    'description' => 'Możesz dostosować wiele aspektów wyglądu witryny za pomocą pól w tabeli poniżej. Nazwy zmiennych są oparte na identyfikatorach w kodzie i dlatego nie mogą być przetłumaczone. Wartości zostaną zresetowane podczas odświeżania strony.',
    'designPageLink' => 'Strona projektu',
    'exportInfo' => 'Możesz wyeksportować swoje zmiany do pliku UserStyle, który może być używany z rozszerzeniem takim jak <1>Stylus</1> aby trwale dostosować wygląd aplikacji. Pamiętaj, że te zmienne mogą ulec zmianie w dowolnym momencie, wymagając ręcznej aktualizacji niestandardowych stylów.',
    'export' => 'Eksportuj jako UserStyle',
    'variableColumnHeader' => 'Zmienna CSS',
    'valueColumnHeader' => 'Wartość',
  ],
];
