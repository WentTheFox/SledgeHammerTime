<?php

return [
  'title' => 'アプリ設定',
  'description' => 'HammerTimeアプリでは、接続済みアカウントごとの現在の設定を以下で確認できます。',
  'learnMore' => 'アプリの内容、またはどんなことができるのか気になりますか？詳細については<1>こちら</1>をご覧ください。',
  'advancedSettings' => [
    'toggleText' => '詳細設定',
  ],
  'defaultOption' => 'Default',
  'fields' => [
    'timezone' => [
      'displayName' => 'タイムゾーン',
    ],
    'format' => [
      'displayName' => '形式',
    ],
    'formatMinimalReply' => [
      'displayName' => 'Preview-only reply when using format option',
    ],
    'columns' => [
      'displayName' => 'Columns',
    ],
    'ephemeral' => [
      'displayName' => 'Ephemeral',
    ],
    'header' => [
      'displayName' => 'Header',
    ],
    'boldPreview' => [
      'displayName' => 'Format preview as bold',
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
  'saveSuccess' => 'Your settings have been saved successfully.',
];
