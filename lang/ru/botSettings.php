<?php

return [
  'title' => 'Настройки приложения',
  'description' => 'Ниже вы можете увидеть ваши текущие настройки в проложении HammerTime для каждого подключённого аккаунта.',
  'learnMore' => 'Не знаете, что такое приложение или интересуетесь, что оно может делать? Посетите <1>Приложения Discord</1>, чтобы узнать больше.',
  'advancedSettings' => [
    'toggleText' => 'Расширенные настройки',
  ],
  'defaultOption' => 'Default',
  'fields' => [
    'timezone' => [
      'displayName' => 'Часовой пояс',
    ],
    'format' => [
      'displayName' => 'Формат',
    ],
    'formatMinimalReply' => [
      'displayName' => 'Preview-only reply when using format option',
    ],
    'columns' => [
      'displayName' => 'Столбики',
    ],
    'ephemeral' => [
      'displayName' => 'Кратковременный',
    ],
    'header' => [
      'displayName' => 'Заголовок',
    ],
    'boldPreview' => [
      'displayName' => 'Просмотр форматирования в виде жирного текста',
    ],
    'defaultAtHour' => [
      'displayName' => 'Default ":hourOptionName" option for /:atCommandName command',
    ],
    'defaultAtMinute' => [
      'displayName' => 'Default ":minuteOptionName" option for /:atCommandName command',
    ],
    'defaultAtSecond' => [
      'displayName' => 'Default ":secondOptionName" option for /:atCommandName command',
    ],
    'telemetry' => [
      'displayName' => 'Allow Telemetry collection',
      'explanation' => 'This is entirely optional and has no effect your ability to use the bot. See the <1/> page for details.',
    ],
    'defaultAt12Hour' => [
      'displayName' => 'Default ":hourOptionName" option for /:at12CommandName command',
    ],
  ],
  'saveSuccess' => 'Ваши настройки успешно сохранены.',
];
