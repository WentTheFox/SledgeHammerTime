<?php

return [
  'title' => 'Профиль',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Информация о профиле',
    'description' => "Измените информацию о вашей учетной записи.",
    'displayName' => 'Отображаемое имя',
    'hiddenFormats' => 'Formats hidden from picker table',
    'saveSuccess' => 'Ваш профиль был успешно обновлен.',
  ],
  'accounts' => [
    'heading' => 'Подключенные аккаунты',
    'description' => [
      'Аккаунт HammerTime позволит в будущем связать несколько аккаунтов Discord и управлять ими в одном месте.',
      'Ниже приведён список всех аккаунтов Discord, связанных с этим аккаунтом HammerTime.',
    ],
    'discord' => 'Аккаунты Discord',
    'crowdin' => 'Аккаунты Crowdin',
    'noConnectedAccounts' => 'У вас нет подключенных аккаунтов',
    'linkAdditional' => [
      'heading' => 'Связать или обновить учетную запись',
      'description' => 'Привязывая несколько аккаунтов к одному аккаунту HammerTime, вы можете управлять настройками всех подключенных аккаунтов в одном месте.',
      'discord' => [
        'description' => 'Если ваша фотография профиля или отображаемое имя были изменены, вы также можете использовать привязку аккаунта для обновления этой информации для любой учетной записи Discord, которая уже связана.',
        'authorize' => 'Авторизовать аккаунт Discord',
      ],
      'crowdin' => [
        'description' => 'Привязывая ваш аккаунт Crowdin, вы сможете настроить ваше отображение в списке переводчиков, а также это послужит дополнительным уровнем верификации того, что эти учетные записи принадлежат вам, если вы присоединитесь к Discord серверу проекта.',
        'authorize' => 'Авторизовать аккаунт Crowdin',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Удаление аккаунта',
    'description' => 'После удаления вашей учётной записи все связанные с ней данные и ресурсы будут удалены без возможности восстановления. Перед удалением, пожалуйста, сохраните всё, что хотите оставить.',
    'deleteButton' => 'Удалить аккаунт',
    'confirmDialog' => [
      'header' => 'Вы уверены, что хотите удалить свой аккаунт?',
      'body' => 'После удаления вашего аккаунта, все данные будут удалены навсегда.',
    ],
  ],
];
