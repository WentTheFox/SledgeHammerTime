<?php

return [
  'seoDescription' => 'Genera indicatori di timestamp per i messaggi testuali di Discord',
  'changeLanguage' => 'Cambia lingua',
  "notFound" => [
    "heading" => "Pagina Non Trovata",
    "content" => "Niente da vedere qui.",
  ],
  "maintenanceMode" => [
    "heading" => "In manutenzione",
    "content" => [
      'pleaseWait' => "L'applicazione è in corso di aggiornamento, riprova tra pochi secondi.",
      'joinSupportServer' => "Se il problema persiste per più di qualche minuto, unisciti al server di supporto Discord e faccelo sapere.",
      'contactDeveloper' => "Se il problema persiste per più di pochi minuti, contatta lo sviluppatore e fallo sapere.",
    ],
    "supportServerButton" => "Server di Supporto",
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
    'analytics' => 'Analytics',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Impostazioni di input',
      'naturalLanguageInput' => [
        'label' => 'Campo di input @time',
        'description' => 'Consente di manipolare il timestamp selezionato con il linguaggio naturale (ad esempio "tra 5 ore") tramite un input aggiuntivo di testo libero. Simile al nuovo tag @time di Discord. È supportato solo un numero limitato di lingue.',
      ],
      'customDateInput' => [
        'label' => 'Input data personalizzato',
        'description' => "Sostituisci l'input predefinito della data del browser con uno personalizzato.",
      ],
      'customTimeInput' => [
        'label' => 'Input orario personalizzato',
        'description' => "Sostituisci l'input orario predefinito del browser con uno personalizzato. Ciò è particolarmente utile se hai problemi a selezionare l'ora sui browser mobili.",
      ],
      'separateInputs' => [
        'label' => 'Input separati',
        'description' => "Mostra due input diversi per data e ora invece di uno combinato (che non è supportato in alcuni browser)",
      ],
      'flatUi' => [
        'label' => 'Appiattisci interfaccia',
        'description' => "Disabilita gli effetti di ombra e altezza sugli input e sui pulsanti",
      ],
      'hourCycle' => [
        'label' => 'Tipo di orologio input orario personalizzato',
        'description' => 'Cambia la modalità di visualizzazione delle ore nell\'inserimento dell\'ora personalizzata. Non ha alcun effetto sulle anteprime nella colonna dei risultati di esempio.',
        'options' => [
          'default' => 'Lingua predefinita',
          'h12' => '12 ore',
          'h24' => '24 ore',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'Primo giorno della settimana',
        'description' => 'Change which day should be considered the first day of the week in the calendar of the custom date input.',
        'options' => [
          'default' => 'Impostazione predefinita della lingua',
        ],
      ],
      'advancedSettings' => 'Impostazioni di input avanzate',
    ],
    'timeSync' => [
      'title' => 'Sincronizzazione oraria',
      'status' => [
        'syncing' => 'L\'orologio del suo sistema è in fase di sincronizzazione con i nostri server, attendere.',
        'accurate' => 'L\'orologio del tuo sistema è preciso.',
        'potentiallyWrong' => 'L\'orologio del tuo sistema potrebbe essere sbagliato.',
        'value' => 'La differenza tra l\'ora locale e quella del server è :offset.',
      ],
      'details' => 'Dettagli',
      'syncButtonLabel' => 'Sincronizza',
      'roundTripDuration' => 'Durata del viaggio',
      't0' => 'Il timestamp del client della trasmissione della richiesta',
      't1' => 'Il timestamp del server della ricezione della richiesta',
      't2' => 'Il timestamp del server della trasmissione della risposta',
      't3' => 'Il timestamp del client della ricezione della risposta',
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
      'chrono' => 'chrono',
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
