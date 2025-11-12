<?php

return [
  'title' => 'Профиль',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Информация о профиле',
    'description' => "Измените информацию о вашей учетной записи.",
    'displayName' => 'Отображаемое имя',
    'saveSuccess' => 'Ваш профиль был успешно обновлен.',
  ],
  'accounts' => [
    'heading' => 'Подключенные аккаунты',
    'description' => [
      'Аккаунт HammerTime позволит в будущем связать несколько аккаунтов Discord и управлять ими в одном месте.',
      'Ниже приведён список всех аккаунтов Discord, связанных с этим аккаунтом HammerTime.',
    ],
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'У вас нет подключенных аккаунтов',
    'linkAdditional' => [
      'heading' => 'Связать или обновить учетную запись',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => 'Authorize Discord account',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account will eventually let you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Authorize Crowdin account',
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
