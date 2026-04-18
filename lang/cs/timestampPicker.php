<?php

return [
  'howTo' => 'Vyberte datum, zkopírujte požadované časové razítko ze sloupce :syntaxColName a vložte ho kamkoli do zprávy v chatu. Výsledkem bude dynamické časové razítko, které se každému zobrazí podle jeho časového pásma.',
  'picker' => [
    'label' => [
      'date' => 'Datum',
      'time' => 'Čas',
      'dateAndTime' => 'Datum a čas',
      'timezone' => 'Časové pásmo',
      'naturalLanguageInput' => 'Vstup pro @time',
      'modeOffset' => 'Absolutní posun',
      'modeZoneName' => 'Časové pásmo',
    ],
    'button' => [
      'jumpToToday' => 'Přejít na aktuální měsíc',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Nastavit na aktuální čas',
      'lock' => 'Uzamknout časové razítko pomocí URL',
      'unlock' => 'Odemknout časové razítko',
      'previousYear' => 'Předchozí rok',
      'previousMonth' => 'Předchozí měsíc',
      'previousDecade' => 'Předchozí desetiletí',
      'nextMonth' => 'Následující měsíc',
      'nextYear' => 'Následující rok',
      'nextDecade' => 'Příští desetiletí',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Nepodařilo se zpracovat vstup v přirozené řeči'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Zápis v chatu',
    'resultColumn' => 'Ukázkový výstup',
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
    'lead' => 'Užitečné pro vás mohou být také tyto:',
    'server' => [
      'header' => 'Oficální server HammerTime',
      'p' => 'Diskutujte o webu, otestujte si zápis a navrhujte funkce',
    ],
    'bot' => [
      'header' => 'Aplikace HammerTime',
      'p' => 'Generujte časová razítka přímo na Discordu pomocí lomítkových příkazů',
    ],
    'oldSite' => [
      'header' => 'Starý web HammerTime',
      'p' => 'Původní web projektu, který je stále dostupný až do odvolání',
    ],
    'textColor' => [
      'header' => 'Generátor <1>barevného</1> textu od vývojáře Rebane',
      'p' => 'Jednoduchá aplikace, která vytváří barevné zprávy Discord pomocí barevných kódů ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "Komunita pořádající týdenní výzvy pro nedoceněnou závodní hru, která inspirovala vznik tohoto projektu",
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
