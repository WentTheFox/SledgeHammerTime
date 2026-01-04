<?php

return [
  'howTo' => 'Scegli una data, copia il timestamp desiderato dalla colonna :syntaxColName, quindi incollalo ovunque in un messaggio testuale. Il risultato sarà un timestamp dinamico che ognuno visualizzerá diversamente in base al proprio fuso orario.',
  'picker' => [
    'label' => [
      'date' => 'Data',
      'time' => 'Ora',
      'dateAndTime' => 'Data e ora',
      'timezone' => 'Fuso orario',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Offset Assoluto',
      'modeZoneName' => 'Nome Zona',
    ],
    'button' => [
      'jumpToToday' => 'Salta al mese corrente',
      'contextRange' => '<0/>-<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Imposta all\'orario attuale',
      'lock' => 'Blocca timestamp tramite URL',
      'unlock' => 'Sblocca timestamp',
      'previousYear' => 'Anno precedente',
      'previousMonth' => 'Mese precedente',
      'previousDecade' => 'Decennio precedente',
      'nextMonth' => 'Mese successivo',
      'nextYear' => 'Anno successivo',
      'nextDecade' => 'Decennio successivo',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Impossibile analizzare l\'input in linguaggio naturale'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintassi della chat',
    'resultColumn' => 'Risultato d\'esempio',
  ],
  'usefulLinks' => [
    'lead' => 'Potresti anche trovare questi utili:',
    'server' => [
      'header' => 'Server Ufficiale HammerTime',
      'p' => 'Discuti sul sito web, prova la sintassi e suggerisci funzioni',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Genera timestamp dall\'interno di Discord usando i comandi slash',
    ],
    'oldSite' => [
      'header' => 'Il vecchio sito web di HammerTime',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Generatore di Testo <1>Colorato</1> di Rebane',
      'p' => 'Una semplice app che crea messaggi Discord colorati utilizzando i codici colore ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "La comunità che ospita sfide settimanali per un gioco di corse sottovalutato che ha ispirato la creazione di questo progetto",
    ],
  ],
];
