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
    'editFormats' => 'Personalizza formati',
    'resetFormats' => 'Ripristina i valori predefiniti',
    'hideFormat' => 'Nascondi questo formato',
    'showFormat' => 'Mostra questo formato',
    'unhideInProfile' => 'Non nascondere nelle impostazioni del profilo',
  ],
  'faq' => [
    'title' => 'Domande Frequenti',
    'description' => 'Questa sezione è solo in inglese per ora, ed è fortemente basata sui contenuti del <1>nostro server Discord</1>. Alcuni link potrebbero non funzionare come previsto, a meno che non sia un membro.',
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
      'p' => 'Il vecchio sito web del progetto, ancora disponibile fino a nuovo avviso',
    ],
    'textColor' => [
      'header' => 'Generatore di Testo <1>Colorato</1> di Rebane',
      'p' => 'Una semplice app che crea messaggi Discord colorati utilizzando i codici colore ANSI',
    ],
    "subreddit" => [
      "p" => "La comunità che ospita sfide settimanali per un gioco di corse sottovalutato che ha ispirato la creazione di questo progetto",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Sapevi che HammerTime non è l\'unico strumento per generare timestamp?',
        'p2' => 'Può dare un\'occhiata a questi altri generatori di timestamp Discord per trovare quello che funziona meglio per lei:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'Un generatore di timestamp semplice e veloce di 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Generatore timestamp di Discord in linguaggio naturale, di dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Generatore gratuito di timestamp di Discord con supporto del fuso orario locale, di Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Generatore di timestamp Discord e convertitore di tempo di DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Crea timestamp di markdown Discord dall\'ecosistema del bot di pianificazione Sesh da Tunks',
      ],
    ],
  ],
];
