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
      'contextRangeLong' => '<0/> – <2/>',
      'contextRangeShort' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Встановити поточний час',
      'lock' => 'Заблокувати мітку часу через URL',
      'unlock' => 'Розблокувати мітку часу',
      'previousYear' => 'Previous year',
      'previousMonth' => 'Previous month',
      'previousDecade' => 'Previous decade',
      'nextMonth' => 'Next month',
      'nextYear' => 'Next year',
      'nextDecade' => 'Next decade',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Синтаксис чату',
    'resultColumn' => 'Приклад результату',
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
      'p' => 'The old website of the project, still available until this Beta goes live',
    ],
    'textColor' => [
      'header' => 'Генератор <1>Кольорового</1> тексту від Rebane',
      'p' => 'Проста програма, яка створює кольорові повідомлення Discord, використовуючи коди кольорів ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "The community hosting weekly challenges for an underrated racing game that inspired the creation of this project",
    ],
  ],
];
