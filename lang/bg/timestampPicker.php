<?php

return [
  'howTo' => 'Избери дата и копирай желаната времева марка от :syntaxColName колона, след това го постави в което и да е съобщение. Резултатът ще бъде интерактивна времева марка която се показва различно за всеки в зависимост от тяхната часова зона.',
  'picker' => [
    'label' => [
      'date' => 'Дата',
      'time' => 'Час',
      'dateAndTime' => 'Дата и час',
      'timezone' => 'Часова зона',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Задади за дадено час',
      'lock' => 'Заключи времева мярка чрез URL адрес',
      'unlock' => 'Отключи времева мярка',
      'previousYear' => 'Предишна година',
      'previousMonth' => 'Предишен месец',
      'previousDecade' => 'Предишно десетилетие',
      'nextMonth' => 'Следващ месец',
      'nextYear' => 'Next year',
      'nextDecade' => 'Next decade',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Синтаксис на чата',
    'resultColumn' => 'Образец на резултата',
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
    'lead' => 'Може да намериш тези неща полезни:',
    'server' => [
      'header' => 'Официален HammerTime Дискорд Сървър',
      'p' => 'Дискусирай уебсайта, тествай синтаксиса и предлагай функции',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Генерира времеви мерки в Discord с използването на "slash" команди',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Rebane\'s <1>Цветен</1> Текст Генератор',
      'p' => 'Прост сайт, който ти помага да създаваш цветни Дискорд съобщения използвайки ANSI код за цветове',
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
