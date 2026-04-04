<?php

return [
  'title' => 'Профиль',
  'intro' => 'На странице профиля Вы можете управлять информацией о своем аккаунте, связанной с сайтом. Если Вы ищете, где изменить настройки по умолчанию и другие параметры для приложения Discord, посетите страницу <1>Настройки приложения</1>.',
  'information' => [
    'heading' => 'Информация о профиле',
    'description' => "Измените информацию о вашей учетной записи.",
    'displayName' => 'Отображаемое имя',
    'hiddenFormats' => 'Скрытые форматы в таблице выбора',
    'saveSuccess' => 'Ваш профиль был успешно обновлен.',
  ],
  'accounts' => [
    'heading' => 'Подключенные аккаунты',
    'description' => 'Вы можете связать несколько учетных записей с вашей учетной записью HammerTime, чтобы управлять ими в одном месте. Основная информация о пользователе, отображаемая здесь, автоматически обновляется не чаще одного раза в час при загрузке этой страницы.',
    'discord' => 'Аккаунты Discord',
    'crowdin' => 'Аккаунты Crowdin',
    'noConnectedAccounts' => 'У вас нет подключенных аккаунтов',
    'linkAdditional' => [
      'heading' => 'Подключить дополнительные аккаунты',
      'description' => 'Используйте кнопки ниже, чтобы подключить дополнительные учетные записи к вашей текущей учетной записи HammerTime.',
      'discord' => [
        'description' => 'Если ваша фотография профиля или отображаемое имя были изменены, вы также можете использовать привязку аккаунта для обновления этой информации для любой учетной записи Discord, которая уже связана.',
        'authorize' => 'Авторизовать аккаунт Discord',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account lets you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Авторизовать аккаунт Crowdin',
      ],
    ],
  ],
  'creditOverrides' => [
    'heading' => 'Translation Credits',
    'description' => 'Customize how you appear in the translation credits for each language where you are a contributor.',
    'displayName' => 'Display Name',
    'avatarProvider' => 'Avatar',
    'avatarProviders' => [
        'discord' => 'Discord',
        'gravatar' => 'Gravatar',
        'crowdin' => 'Crowdin',
    ],
    'gravatarEmail' => 'Email address',
    'gravatarDescription' => '<1>Gravatar</1> allows you to use a single avatar across multiple websites that support it. Your e-mail address will be saved as an MD5 hash.',
    'avatarAccount' => 'Account',
    'url' => 'Link',
    'visibility' => 'Visibility',
    'submit' => 'Submit for approval',
    'saveSuccess' => 'Submitted for approval',
    'saveHideSuccess' => 'Visibility updated',
    'cancel' => 'Cancel changes',
    'statusPrefix' => 'Status',
    'status' => [
      'approved' => 'Approved',
      'inReview' => 'In review',
      'rejected' => 'Rejected',
    ],
    'currentlyApproved' => 'Currently approved values',
    'reApprovalWarning' => 'Changing anything besides visibility will require a manual review. You can cancel the review request at any time from this page.',
    'deleteOverride' => 'Remove override',
    'deleteOverrideConfirm' => 'Are you sure you want to remove your translation credit override? Your entry will revert to the default information from Crowdin.',
    'approvedValues' => [
      'displayName' => 'Name',
      'avatarProvider' => 'Avatar provider',
      'avatarId' => 'Avatar ID',
      'url' => 'Profile URL',
      'visible' => 'Visible',
      'hidden' => 'Hidden',
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
