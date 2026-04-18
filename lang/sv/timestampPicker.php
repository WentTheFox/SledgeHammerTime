<?php

return [
  'howTo' => 'Välj ett datum, kopiera det önskade formatet från kolumnen :syntaxColName, klistra sedan in det någonstans i ett meddelande. Resultatet är dynamiskt och visar olika tid och datum för varje person baserat på deras tidszon.',
  'picker' => [
    'label' => [
      'date' => 'Datum',
      'time' => 'Tid',
      'dateAndTime' => 'Datum och tid',
      'timezone' => 'Tidszon',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Återställ till aktuell tid',
      'lock' => 'Lås tidsstämpel via URL',
      'unlock' => 'Lås upp tidsstämpel',
      'previousYear' => 'Föregående år',
      'previousMonth' => 'Föregående månad',
      'previousDecade' => 'Föregående årtionde',
      'nextMonth' => 'Nästa månad',
      'nextYear' => 'Nästa år',
      'nextDecade' => 'Nästa årtionde',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Syntax',
    'resultColumn' => 'Resultat',
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
    'lead' => 'Du kanske även gillar dessa:',
    'server' => [
      'header' => 'Officiell HammerTime-server',
      'p' => 'Diskutera webbsidan, testa syntax och föreslå programfunktioner',
    ],
    'bot' => [
      'header' => 'HammerTime-app',
      'p' => 'Generera tidsstämplar direkt i Discord med hjälp av snedstreckskommandon',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Rebanes <1>färgade</1> textgenerator',
      'p' => 'En simpel app som skapar färgade Discord-meddelanden med ANSI-färgkoder',
    ],
    "subreddit" => [
      "p" => "Gemenskapen som presenterar utmaningar varje vecka för ett underskattat racing spel som inspirerade skapelsen av detta projekt",
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
