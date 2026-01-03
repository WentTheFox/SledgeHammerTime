<?php

return [
  'howTo' => 'Выберите дату и время, скопируйте желаемый формат из столбца :syntaxColName, и вставьте в своё сообщение в Discord. В результате вы получите динамическую метку времени, которая будет отображаться по-разному для каждого пользователя в зависимости от его часового пояса.',
  'picker' => [
    'label' => [
      'date' => 'Дата',
      'time' => 'Время',
      'dateAndTime' => 'Дата и время',
      'timezone' => 'Часовой пояс',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Смещение времени',
      'modeZoneName' => 'Название зоны',
    ],
    'button' => [
      'jumpToToday' => 'Перейти к текущему месяцу',
      'contextRangeLong' => '<0/> – <2/>',
      'contextRangeShort' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Задать текущее время',
      'lock' => 'Заблокировать отметку времени через URL',
      'unlock' => 'Разблокировать отметку времени',
      'previousYear' => 'Предыдущий год',
      'previousMonth' => 'Предыдущий месяц',
      'previousDecade' => 'Previous decade',
      'nextMonth' => 'Следующий месяц',
      'nextYear' => 'Следующий год',
      'nextDecade' => 'Next decade',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Синтаксис в чате',
    'resultColumn' => 'Пример',
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
      'p' => 'Старая версия сайта, доступная до окончания тестирования данной версии',
    ],
    'textColor' => [
      'header' => 'Генератор <1>цветного</1> текста Rebane',
      'p' => 'Простое приложение, которое создает цветные сообщения Discord, используя цветовые коды ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "Сообщество, организующее еженедельные испытания для малоизвестной гоночной игры, ставшей источником вдохновения для этого проекта",
    ],
  ],
];
