<?php

return [
  'title' => '个人资料',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => '个人资料信息',
    'description' => "更新您账户的个人资料信息。",
    'displayName' => '显示名称',
    'hiddenFormats' => 'Formats hidden from picker table',
    'saveSuccess' => '您个人资料的更改已保存。',
  ],
  'accounts' => [
    'heading' => '已关联账户',
    'description' => [
      'HammerTime 账户未来将支持关联多个 Discord 账户，以便在一个地方集中管理相关资源。',
      '下方是与此 HammerTime 账户关联的所有 Discord 账户列表。',
    ],
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => '您目前没有关联任何账户',
    'linkAdditional' => [
      'heading' => '关联或更新账户',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => '授权 Discord 账户',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account will eventually let you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Authorize Crowdin account',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Account Deletion',
    'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
    'deleteButton' => 'Delete Account',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
