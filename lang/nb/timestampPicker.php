<?php

return [
  'howTo' => 'Velg en dato, kopier ønsket tidsstempel fra :syntaxColName kolonnen, og lim den inn hvor som helst i en chat-melding. Resultatet vil være et dynamisk tidsstempel som viser forskjellig for alle basert på egen tidssone.',
  'picker' => [
    'label' => [
      'date' => 'Dato',
      'time' => 'Tidspunkt',
      'dateAndTime' => 'Dato og klokkeslett',
      'timezone' => 'Tidssone',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Sett til nåværende tid',
      'lock' => 'Lås tidsstempel via nettadresse',
      'unlock' => 'Lås opp tidsstempel',
      'previousYear' => 'Forrige år',
      'previousMonth' => 'Forrige måned',
      'previousDecade' => 'Forrige tiår',
      'nextMonth' => 'Neste måned',
      'nextYear' => 'Neste år',
      'nextDecade' => 'Neste tiår',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Chat syntaks',
    'resultColumn' => 'Eksempel resultat',
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
    'lead' => 'Du kan også finne dette nyttig:',
    'server' => [
      'header' => 'Offisiell HammerTime Server',
      'p' => 'Diskuter nettstedet, test syntaksen og foreslå nye funksjoner',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Generer tidsstempler fra Discord ved hjelp av slash-kommandoer',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Rebane\'s generator for <1>farget</1> tekst',
      'p' => 'En enkel app som skaper fargede Discord-meldinger ved hjelp av ANSI-fargekoder',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "Fellesskapet som arrangerer ukentlige utfordringer for et undervurdert racingspill som inspirerte opprettelsen av dette prosjektet",
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
