<?php

return [
  'howTo' => 'Odaberite datum, kopirajte željenu vremensku oznaku iz stupca :syntaxColName, zatim je zalijepite bilo gdje u chat poruci. Rezultat će biti dinamična vremenska oznaka koja se prikazuje različito za svakoga na temelju njegove vlastite vremenske zone.',
  'picker' => [
    'label' => [
      'date' => 'Datum',
      'time' => 'Vrijeme',
      'dateAndTime' => 'Datum i vrijeme',
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
      'setToCurrent' => 'Postavite na trenutno vrijeme',
      'lock' => 'Zaključaj vremensku oznaku putem URL-a',
      'unlock' => 'Otključaj vremensku oznaku',
      'previousYear' => 'Prošla godina',
      'previousMonth' => 'Prethodni mjesec',
      'previousDecade' => 'Prethodno desetljeće',
      'nextMonth' => 'Sljedeći mjesec',
      'nextYear' => 'Sljedeća godina',
      'nextDecade' => 'Sljedeće desetljeće',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintaksa chata',
    'resultColumn' => 'Primjer rezultata',
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
    'lead' => 'Ovo vam također može biti korisno:',
    'server' => [
      'header' => 'Službeni HammerTime server',
      'p' => 'Razgovarajte o web stranici, testirajte sintaksu i predložite značajke',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Generirajte vremenske oznake unutar Discorda koristeći naredbe kose crte',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Rebaneov <1>obojeni</1> generator teksta',
      'p' => 'Jednostavna aplikacija koja stvara Discord poruke u boji koristeći ANSI kodove boja',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "The community hosting weekly challenges for an underrated racing game that inspired the creation of this project",
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
