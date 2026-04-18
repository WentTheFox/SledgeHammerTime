<?php

return [
  'howTo' => 'Виберіть дату, скопіюйте потрібну позначку часу зі стовпця :syntaxColName, а потім вставте її будь-де в повідомлення чату. Результатом буде динамічна позначка часу, яка відображається по-різному для кожного залежно від власного часового поясу.',
  'picker' => [
    'label' => [
      'date' => 'Дата',
      'time' => 'Час',
      'dateAndTime' => 'Дата і час',
      'timezone' => 'Часовий пояс',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Встановити поточний час',
      'lock' => 'Заблокувати мітку часу через URL',
      'unlock' => 'Розблокувати мітку часу',
      'previousYear' => 'Попередній рік',
      'previousMonth' => 'Попередній місяць',
      'previousDecade' => 'Попереднє десятиліття',
      'nextMonth' => 'Наступний місяць',
      'nextYear' => 'Наступний рік',
      'nextDecade' => 'Наступне десятиріччя',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Синтаксис чату',
    'resultColumn' => 'Приклад результату',
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
    'lead' => 'Вам також можуть бути корисними:',
    'server' => [
      'header' => 'Офіційний сервер HammerTime',
      'p' => 'Обговоріть сайт, перевірте синтаксис і запропонуйте функції',
    ],
    'bot' => [
      'header' => 'Програма HammerTime',
      'p' => 'Створюйте індикатори часових позначок прямо з Discord, використовуючи слеш-команди',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Генератор <1>Кольорового</1> тексту від Rebane',
      'p' => 'Проста програма, яка створює кольорові повідомлення Discord, використовуючи коди кольорів ANSI',
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
