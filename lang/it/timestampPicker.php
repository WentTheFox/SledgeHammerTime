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
      "header" => "r/SplitSecond",
      "p" => "La comunità che ospita sfide settimanali per un gioco di corse sottovalutato che ha ispirato la creazione di questo progetto",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => 'r.3v.fi/discord-timestamps',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => 'timestamp.dabric.xyz',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'header' => 'DiscordTimestamp.com',
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'header' => 'DiscordTimestamp.org',
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'header' => 'sesh.fyi/timestamp',
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
