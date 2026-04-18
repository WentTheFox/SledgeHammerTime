<?php

return [
  'howTo' => 'Izaberite datum, kopirajte željenu vremensku oznaku iz kolone :syntaxColName, a zatim je nalepite bilo gde u poruci. Rezultat će biti dinamička vremenska oznaka koja se prikazuje različito za svakoga na osnovu njihove vremenske zone.',
  'picker' => [
    'label' => [
      'date' => 'Datum',
      'time' => 'Vreme',
      'dateAndTime' => 'Datum i vreme',
      'timezone' => 'Vremenska zona',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Podesi na trenutno vreme',
      'lock' => 'Zaključaj vremensku oznaku preko URL-a',
      'unlock' => 'Otključaj vremensku oznaku',
      'previousYear' => 'Prošla godina',
      'previousMonth' => 'Prethodni mesec',
      'previousDecade' => 'Prošla decenija',
      'nextMonth' => 'Sledeći mesec',
      'nextYear' => 'Sledeća godina',
      'nextDecade' => 'Sledeća decenija',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintaksa u poruci',
    'resultColumn' => 'Primer rezultata',
    'editFormats' => 'Customize formats',
    'resetFormats' => 'Reset to defaults',
    'hideFormat' => 'Hide this format',
    'showFormat' => 'Show this format',
    'unhideInProfile' => 'Unhide in profile settings',
  ],
  'faq' => [
    'title' => 'Frequently Asked Questions',
    'description' => 'This section is English-only for now, and it\'s heavily based on content from <1>our Discord server</1>. Some links might not work as expected unless you are a member.',
  ],
  'usefulLinks' => [
    'lead' => 'Ovo Vam takođe može biti korisno:',
    'server' => [
      'header' => 'Zvanični HammerTime server',
      'p' => 'Razgovarajte o websajtu, testirajte sintakse i predložite funkcije',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Generišite vremenske oznake iz Discord-a pomoću slash komandi',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Rebaneov generator <1>obojenog</1> teksta',
      'p' => 'Jednostavna aplikacija koja kreira obojene Discord poruke koristeći ANSI kodove boja',
    ],
    "subreddit" => [
      "p" => "The community hosting weekly challenges for an underrated racing game that inspired the creation of this project",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
