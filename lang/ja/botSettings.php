<?php

return [
  'title' => 'アプリ設定',
  'description' => 'HammerTimeアプリでは、接続済みアカウントごとの現在の設定を以下で確認できます。',
  'learnMore' => 'アプリの内容、またはどんなことができるのか気になりますか？詳細については<1>こちら</1>をご覧ください。',
  'advancedSettings' => [
    'toggleText' => '詳細設定',
  ],
  'defaultOption' => '初期説明',
  'fields' => [
    'timezone' => [
      'displayName' => 'タイムゾーン',
    ],
    'format' => [
      'displayName' => '形式',
    ],
    'formatMinimalReply' => [
      'displayName' => 'フォーマットオプション使用時はプレビューのみでの返信',
    ],
    'columns' => [
      'displayName' => 'コラム',
    ],
    'ephemeral' => [
      'displayName' => '一時的',
    ],
    'header' => [
      'displayName' => '見出し',
    ],
    'boldPreview' => [
      'displayName' => 'プレビューを太字で表示',
    ],
    'defaultAtHour' => [
      'displayName' => '/:atCommandName コマンドの初期説明の:hourOptionName オプション',
    ],
    'defaultAtMinute' => [
      'displayName' => '/:atCommandName コマンドの初期説明の ":minuteOptionName" オプション',
    ],
    'defaultAtSecond' => [
      'displayName' => '/:atCommandName コマンドの初期説明の ":secondOptionName" オプション',
    ],
    'telemetry' => [
      'displayName' => 'テレメトリの収集を許可する',
      'explanation' => 'これは完全に任意であり、ボットの性能には影響しません。詳細は<1/>ページを参照してください。',
    ],
    'defaultAt12Hour' => [
      'displayName' => '/:at12CommandName コマンドの初期説明の ":hourOptionName" オプション',
    ],
  ],
  'saveSuccess' => '設定が正常に保存されました。',
];
