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
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Input separati',
        'description' => "Mostra due input diversi per data e ora invece di uno combinato (che non è supportato in alcuni browser)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
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
      't0' => 'Il timestamp del client della trasmissione della richiesta',
      't1' => 'Il timestamp del server della ricezione della richiesta',
      't2' => 'Il timestamp del server della trasmissione della risposta',
      't3' => 'Il timestamp del client della ricezione della risposta',
      'dtlOffsetCell' => 'Offset di calcolo attivo',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Offset rilevato (via rete)',
    ],
    'localSettings' => [
      'title' => 'Impostazioni Locali',
    ],
    'credits' => [
      'title' => 'Crediti',
      'developedBy' => 'Sviluppato da <1></1>',
      'using' => 'Utilizzando <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Traduzioni di <1></1>',
      'openSourceSoftware' => 'Software open source',
      'viewSourceCode' => 'Visualizza codice sorgente',
      'notAffiliated' => 'Questo progetto non è affiliato con Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tema Scuro',
      'light' => 'Tema Chiaro',
      'system' => 'Usa tema di sistema',
    ],
  ],
  'designEditor' => [
    'title' => 'Editor Progettazione',
    'description' => 'È possibile regolare molti aspetti dell\'aspetto del sito web utilizzando gli input nella tabella sottostante. I nomi delle variabili sono basati su identificatori nel codice e quindi non possono essere tradotti. I valori verranno reimpostati quando si aggiorna la pagina.',
    'designPageLink' => 'Pagina Design',
    'exportInfo' => 'È possibile esportare le modifiche a un file UserStyle, che può essere utilizzato con un\'estensione come <1>Stylus</1> per personalizzare l\'aspetto dell\'app in modo permanente. Notare, tuttavia, che queste variabili possono cambiare in qualsiasi momento, richiedendo di aggiornare manualmente i tuoi stili personalizzati.',
    'export' => 'Esporta come UserStyle',
    'variableColumnHeader' => 'Variabile CSS',
    'valueColumnHeader' => 'Valore',
  ],
];
