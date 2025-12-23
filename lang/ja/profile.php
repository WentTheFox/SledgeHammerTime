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
    'description' => 'You can link multiple accounts to your HammerTime account to be able to manage them in one place. The basic user information displayed here is automatically updated at most once an hour when you load this page.',
    'discord' => 'Discordアカウント',
    'crowdin' => 'Crowdinアカウント',
    'noConnectedAccounts' => '現在、接続されているアカウントはありません',
    'linkAdditional' => [
      'heading' => 'Link Additional Accounts',
      'description' => 'Use the buttons below to connect additional accounts to your current HammerTime account.',
      'discord' => [
        'description' => 'プロフィール画像や表示名が変更された場合、既に連携済みのDiscordアカウントについても、この方法で情報を更新できます。',
        'authorize' => 'Discordアカウントを認証する',
      ],
      'crowdin' => [
        'description' => 'プロジェクトの翻訳者である場合、Crowdinアカウントを連携することで、翻訳クレジットに表示されるお名前をカスタマイズできるようになります。また、プロジェクトのDiscordサーバーに参加される際に、これらのアカウントがご本人様のものであることを確認する追加の手段としても機能します。',
        'authorize' => 'Crowdinアカウントを認証する',
      ],
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
