<?php

return [
  'title' => 'プロフィール',
  'intro' => 'プロフィールページでは、当ウェブサイトに関連するアカウント情報を管理できます。Discordアプリのデフォルト設定やその他の設定を変更する場所をお探しの場合は、<1>アプリ設定</1>ページをご覧ください。',
  'information' => [
    'heading' => 'プロフィール情報',
    'description' => "プロフィール情報を変更する。",
    'displayName' => '表示名',
    'hiddenFormats' => '選択テーブルから非表示のフォーマット',
    'saveSuccess' => 'プロフィールが正常に更新されました。',
  ],
  'accounts' => [
    'heading' => 'アカウント連携',
    'description' => '複数のアカウントをHammerTimeアカウントに連携させ、一箇所で管理できます。ここに表示される基本ユーザー情報は、このページを読み込む際に最大1時間に1回自動更新されます。',
    'discord' => 'Discordアカウント',
    'crowdin' => 'Crowdinアカウント',
    'noConnectedAccounts' => '現在、接続されているアカウントはありません',
    'linkAdditional' => [
      'heading' => '追加アカウントをリンクする',
      'description' => '以下のボタンを使用して、現在のHammerTimeアカウントに追加のアカウントを接続してください。',
      'discord' => [
        'description' => 'プロフィール画像や表示名が変更された場合、既に連携済みのDiscordアカウントについても、この方法で情報を更新できます。',
        'authorize' => 'Discordアカウントを認証する',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account lets you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Crowdinアカウントを認証する',
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
    'heading' => 'アカウント削除',
    'description' => 'アカウントを削除すると、そのアカウントに関連するすべてのリソースとデータが完全に削除されます。アカウントを削除する前に、保存したいデータや情報は必ずダウンロードしてください。',
    'deleteButton' => 'アカウントを削除する',
    'confirmDialog' => [
      'header' => 'アカウントを削除してもよろしいですか？',
      'body' => 'アカウントが削除されると、そのアカウントに関連するすべてのリソースとデータは永久に削除されます。',
    ],
  ],
];
