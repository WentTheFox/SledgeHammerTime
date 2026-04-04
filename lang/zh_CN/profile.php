<?php

return [
  'title' => '个人资料',
  'intro' => '个人资料页面允许您管理专门与本网站相关的账户信息。如果您正在寻找在哪里更改 Discord 应用的默认值和其他设置，请访问 <1>App Settings</1> 页面。',
  'information' => [
    'heading' => '个人资料信息',
    'description' => "更新您账户的个人资料信息。",
    'displayName' => '显示名称',
    'hiddenFormats' => '从选择器表格中隐藏的格式',
    'saveSuccess' => '您个人资料的更改已保存。',
  ],
  'accounts' => [
    'heading' => '已关联账户',
    'description' => '您可以将多个账户关联到您的 HammerTime 账户，以便在一个地方进行管理。此处显示的基本用户信息在您加载此页面时最多每小时自动更新一次。',
    'discord' => 'Discord 账号',
    'crowdin' => 'Crowdin 账户',
    'noConnectedAccounts' => '您目前没有关联任何账户',
    'linkAdditional' => [
      'heading' => '关联更多账户',
      'description' => '使用下方按钮将更多账户关联到您当前的 HammerTime 账户。',
      'discord' => [
        'description' => '如果您的头像或显示名称发生了变化，您也可以通过此操作来更新已关联的 Discord 账户的相关信息。',
        'authorize' => '授权 Discord 账户',
      ],
      'crowdin' => [
        'description' => '如果您是该项目的翻译者，关联您的 Crowdin 账户最终将允许您自定义姓名在翻译贡献名单中的显示方式，同时在您加入该项目的 Discord 服务器时，这还可以作为额外的身份验证，证明这些账户属于您。',
        'authorize' => '授权 Crowdin 账户',
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
    'heading' => '删除帐户',
    'description' => '账户一旦删除，其所有资源和数据都将被永久删除。在删除账户之前，请下载您希望保留的任何数据或信息。',
    'deleteButton' => '删除帐户',
    'confirmDialog' => [
      'header' => '确定要删除您的账号吗？',
      'body' => '一旦您的账户被删除，其所有资源和数据都将被永久删除。',
    ],
  ],
];
