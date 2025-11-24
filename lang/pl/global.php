<?php

return [
  'seoDescription' => 'Generator znaczników czasu dla wiadomości wysyłanych w Discord',
  'changeLanguage' => 'Zmień język',
  "notFound" => [
    "heading" => "Nie znaleziono strony",
    "content" => "Niczego tutaj nie ma.",
  ],
  "maintenanceMode" => [
    "heading" => "Tryb serwisowy",
    "content" => [
      'pleaseWait' => "Aplikacja jest obecnie aktualizowana, proszę spróbować ponownie za kilka sekund.",
      'joinSupportServer' => "Jeśli problem będzie się powtarzał przez więcej niż kilka minut, dołącz do serwera wsparcia Discorda i daj nam znać.",
      'contactDeveloper' => "Jeśli problem będzie się powtarzał przez więcej niż kilka minut, skontaktuj się z twórcą i daj im znać.",
    ],
    "supportServerButton" => "Serwer pomocy technicznej",
  ],
  'incompleteTranslations' => 'Tłumaczenia są niekompletne',
  'contributeTranslations' => 'Wspomóż',
  'copyToClipboard' => 'Skopiuj do schowka',
  'copiedToClipboard' => 'Skopiowano do schowka!',
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
      'customDateInput' => [
        'label' => 'Niestandardowe wprowadzanie daty',
        'description' => "Zastąp domyślną datę w przeglądarce na niestandardową.",
      ],
      'customTimeInput' => [
        'label' => 'Niestandardowe wprowadzanie czasu',
        'description' => "Zastąp domyślny czas wejścia przeglądarki niestandardowym. Jest to szczególnie przydatne, jeśli masz problemy z wybraniem czasu w przeglądarkach mobilnych.",
      ],
      'separateInputs' => [
        'label' => 'Osobne pola',
        'description' => "Wyświetla dwa różne pola na datę i czas zamiast połączonych pól (które są nieobsługiwane przez niektóre przeglądarki)",
      ],
      'flatUi' => [
        'label' => 'Wyrównaj interfejs',
        'description' => "Wyłącz efekt cienia i wysokości na polach tekstowych i przyciskach",
      ],
    ],
    'timeSync' => [
      'title' => 'Synchronizacja czasu',
      'status' => [
        'syncing' => 'Twój zegar systemowy jest obecnie synchronizowany z naszymi serwerami, proszę czekać.',
        'accurate' => 'Twój zegar systemowy jest dokładny.',
        'potentiallyWrong' => 'Twój zegar systemowy może być błędny.',
        'value' => 'Różnica między czasem lokalnym a czasem serwera to :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Apply server time offset to calculations (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => 'Szczegóły',
      'autoApplyCheckbox' => 'Zastosuj obliczony offset w bibliotece DateTime po ręcznym naciśnięciu :syncButtonLabel (dotyczy tylko wtedy, gdy różnica przekracza próg :offset)',
      'syncButtonLabel' => 'Synchronize',
      'resetOffsetButtonLabel' => 'Reset applied offset',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'Znacznik czasu klienta przekazania żądania',
      't1' => 'Znacznik czasu serwera odbioru żądania',
      't2' => 'Znacznik czasu serwera przesyłania odpowiedzi',
      't3' => 'Znacznik czasu odbioru odpowiedzi przez klienta',
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
      'dark' => 'Ciemny motyw',
      'light' => 'Jasny Motyw',
      'system' => 'Użyj motywu systemowego',
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
