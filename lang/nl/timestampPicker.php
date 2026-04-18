<?php

return [
  'howTo' => 'Kies een datum, kopieer de gewenste tijdsaanduiding van de :syntaxColName kolom en plak deze dan ergens in een chatbericht. Het resultaat zal een dynamische tijdsaanduiding zijn die voor iedereen anders wordt weergegeven, gebaseerd op hun eigen tijdzone.',
  'picker' => [
    'label' => [
      'date' => 'Datum',
      'time' => 'Tijd',
      'dateAndTime' => 'Datum en tijd',
      'timezone' => 'Tijdzone',
      'naturalLanguageInput' => '@time invoer',
      'modeOffset' => 'Absoluut tijdsverschil',
      'modeZoneName' => 'Tijdzone Naam',
    ],
    'button' => [
      'jumpToToday' => 'Ga naar huidige maand',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Zet naar huidige tijd',
      'lock' => 'Tijdsaanduiding vergrendelen via de URL',
      'unlock' => 'Tijdsaanduiding ontgrendelen',
      'previousYear' => 'Vorig jaar',
      'previousMonth' => 'Vorige maand',
      'previousDecade' => 'Vorige decennium',
      'nextMonth' => 'Volgende maand',
      'nextYear' => 'Volgend jaar',
      'nextDecade' => 'Volgende decennium',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Natuurlijke taalinvoer kon niet worden verwerkt'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Chat syntaxis',
    'resultColumn' => 'Voorbeeld resultaat',
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
    'lead' => 'Dit is mogelijk ook handig:',
    'server' => [
      'header' => 'Officiële HammerTime server',
      'p' => 'Bespreek de website, test de syntaxis en stel nieuwe functies voor',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Genereer tijdstempels in Discord door middel van slash-opdrachten',
    ],
    'oldSite' => [
      'header' => 'HammerTime Oude Website',
      'p' => 'De oude website van dit project. Beschikbaar tot anders wordt vermeld',
    ],
    'textColor' => [
      'header' => 'Rebane\'s <1>gekleurde</1> tekst generator',
      'p' => 'Een eenvoudige app die gekleurde Discord-berichten maakt met behulp van ANSI-kleurcodes',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "De community die wekelijkse uitdagingen organiseert voor een ondergewaardeerde race-game die de inspiratie vormde voor dit project",
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
