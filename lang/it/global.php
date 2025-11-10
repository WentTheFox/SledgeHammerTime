<?php

return [
  'seoDescription' => 'Genera indicatori di timestamp per i messaggi testuali di Discord',
  'changeLanguage' => 'Cambia lingua',
  "notFound" => [
    "heading" => "Pagina Non Trovata",
    "content" => "Niente da vedere qui.",
  ],
  'incompleteTranslations' => 'Le traduzioni sono incomplete',
  'contributeTranslations' => 'Contribuisci',
  'copyToClipboard' => 'Copia negli appunti',
  'copiedToClipboard' => 'Copiato negli appunti!',
  'jsDisabled' => [
    'title' => 'JavaScript è necessario',
    'body' => "Il tuo browser non supporta JavaScript o è attualmente disabilitato. Alcuni browser disabilitano JavaScript per motivi di sicurezza, ma è necessario per questa applicazione. Si prega di abilitare e aggiornare la pagina, o utilizzare un browser differente.",
  ],
  'nav' => [
    'botSettings' => 'Impostazioni App',
    'profile' => 'Profilo',
    'legal' => 'Informazioni legali',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Impostazioni di input',
      'customInputs' => [
        'label' => 'Input personalizzati',
        'description' => "Sostituisce gli input predefiniti del browser con quelli personalizzati che rispettano la lingua scelta nel sito web",
      ],
      'separateInputs' => [
        'label' => 'Input separati',
        'description' => "Mostra due input diversi per data e ora invece di uno combinato (che non è supportato in alcuni browser)",
      ],
    ],
    'timeSync' => [
      'title' => 'Sincronizzazione oraria',
      'status' => [
        'syncing' => 'L\'orologio del suo sistema è in fase di sincronizzazione con i nostri server, attendere.',
        'accurate' => 'L\'orologio del tuo sistema è preciso.',
        'potentiallyWrong' => 'L\'orologio del tuo sistema potrebbe essere sbagliato.',
        'value' => 'La differenza tra l\'ora locale e quella del server è :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Applica l\'offset temporale del server ai calcoli (beta)',
        'description' => 'Se il suo orologio di sistema è sfasato di oltre :offset rispetto all\'ora del server (escluse le differenze di fuso orario), alcuni calcoli dell\'ora saranno adattati per tenerne conto, in modo che i suoi timestamp avranno meno probabilità di essere errati. <1>Si tratta di una funzione sperimentale, da utilizzare con cautela!</1> La sincronizzazione avviene al primo caricamento della pagina e subito dopo l\'attivazione dell\'impostazione.',
      ],
      'details' => 'Dettagli',
      'autoApplyCheckbox' => 'Applica l\'offset calcolato alla libreria DateTime quando si preme manualmente :syncButtonLabel (si applica solo se la differenza è superiore alla soglia :offset)',
      'syncButtonLabel' => 'Sincronizza',
      'resetOffsetButtonLabel' => 'Reimposta offset applicato',
      'roundTripDuration' => 'Durata del viaggio',
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
      'title' => 'Credits',
      'developedBy' => 'Developed by <1></1>',
      'using' => 'Using <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
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
];
