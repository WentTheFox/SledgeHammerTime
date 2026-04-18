<?php

return [
  'howTo' => 'Выберите дату и время, скопируйте желаемый формат из столбца :syntaxColName, и вставьте в своё сообщение в Discord. В результате вы получите динамическую метку времени, которая будет отображаться по-разному для каждого пользователя в зависимости от его часового пояса.',
  'picker' => [
    'label' => [
      'date' => 'Дата',
      'time' => 'Время',
      'dateAndTime' => 'Дата и время',
      'timezone' => 'Часовой пояс',
      'naturalLanguageInput' => 'Ввод @time',
      'modeOffset' => 'Смещение времени',
      'modeZoneName' => 'Название зоны',
    ],
    'button' => [
      'jumpToToday' => 'Перейти к текущему месяцу',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Задать текущее время',
      'lock' => 'Заблокировать отметку времени через URL',
      'unlock' => 'Разблокировать отметку времени',
      'previousYear' => 'Предыдущий год',
      'previousMonth' => 'Предыдущий месяц',
      'previousDecade' => 'Предыдущее десятилетие',
      'nextMonth' => 'Следующий месяц',
      'nextYear' => 'Следующий год',
      'nextDecade' => 'Следующее десятилетие',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Не удалось распознать ввод естественного языка'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Синтаксис в чате',
    'resultColumn' => 'Пример',
    'editFormats' => 'Изменяемые шрифты',
    'resetFormats' => 'Сбросить до настроек по умолчанию',
    'hideFormat' => 'Скрыть этот формат',
    'showFormat' => 'Показывать этот формат',
    'unhideInProfile' => 'Показывать в настройках профиля',
  ],
  'faq' => [
    'title' => 'Часто Задаваемые Вопросы (FAQ)',
    'description' => 'Этот раздел доступен только на английском языке, и он сильно основан на содержании <1>нашего Discord сервера</1>. Некоторые ссылки могут не работать, если вы не являетесь участником.',
  ],
  'usefulLinks' => [
    'lead' => 'Возможно вы заинтересуетесь этим:',
    'server' => [
      'header' => 'Официальный сервер HammerTime',
      'p' => 'Обсуждайте сайт, проверяйте синтаксис и предлагайте функции',
    ],
    'bot' => [
      'header' => 'Приложение HammerTime',
      'p' => 'Создавайте временные метки в Discord с помощью слэш-команд',
    ],
    'oldSite' => [
      'header' => 'Старая версия HammerTime',
      'p' => 'Старая версия сайта, всё ещё доступна до последующего уведомления',
    ],
    'textColor' => [
      'header' => 'Генератор <1>цветного</1> текста Rebane',
      'p' => 'Простое приложение, которое создает цветные сообщения Discord, используя цветовые коды ANSI',
    ],
    "subreddit" => [
      "p" => "Сообщество, организующее еженедельные испытания для малоизвестной гоночной игры, ставшей источником вдохновения для этого проекта",
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
