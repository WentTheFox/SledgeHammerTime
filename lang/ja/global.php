<?php

return [
  'seoDescription' => 'Discordメッセージのタイムスタンプを生成できる',
  'changeLanguage' => '言語を変える',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "ここは何もありません",
  ],
  "maintenanceMode" => [
    "heading" => "Maintenance Mode",
    "content" => [
      'pleaseWait' => "The application is currently being updated, please try again in a few seconds.",
      'joinSupportServer' => "If the issue persists for more than a few minutes, please join the Discord support server and let us know.",
      'contactDeveloper' => "If the issue persists for more than a few minutes, please contact the developer and let them know.",
    ],
    "supportServerButton" => "Support Server",
  ],
  'incompleteTranslations' => '翻訳は未完成です',
  'contributeTranslations' => '貢献',
  'copyToClipboard' => 'クリップボードにコピー',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScriptが必要です',
    'body' => "お使いのブラウザはJavaScriptをサポートしないか、無効化されています。一部ブラウザではセキュリティ上の理由でJavaScriptをデフォルトで無効化しますが、このアプリには必要です。有効にしてページを再読み込みするか、違うブラウザを使用してください。",
  ],
  'nav' => [
    'botSettings' => 'アカウント設定',
    'profile' => 'プロフィール',
    'legal' => '法的情報',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => '入力設定',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => '分離入力',
        'description' => "日付と時刻の入力を分離させます（一部ブラウザではサポートされていません）",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
    ],
    'timeSync' => [
      'title' => '時刻更新',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => '時計は正確です。',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'ローカル時間とサーバー時間の差が :offset あります。',
      ],
      'autoTimeSync' => [
        'label' => 'サーバーのタイムオフセットを計算に適用する（ベータ版）',
        'description' => 'システム時計がサーバー時刻より :offset off 以上遅れている場合（タイムゾーン差を除く）、一部の時間計算はこの誤差を考慮して調整されるため、タイムスタンプの不正確さが軽減されます。<1>これは実験的な機能です。注意してご利用ください！</1> 同期はページ初回読み込み時、および設定有効直後に実行されます。',
      ],
      'details' => '詳細',
      'autoApplyCheckbox' => '手動で :syncButtonLabel を押下した際に、DateTime ライブラリに計算されたオフセットを適用する（差分が :offset のしきい値を超える場合にのみ適用される）',
      'syncButtonLabel' => '同期',
      'resetOffsetButtonLabel' => '適用されたオフセットをリセット',
      'roundTripDuration' => '往復の所要時間',
      't0' => 'クライアントのリクエスト送信時刻',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'dtlOffsetCell' => '有効演算オフセット',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => '検出されたオフセット（ネットワーク経由）',
    ],
    'localSettings' => [
      'title' => 'Local Settings',
    ],
    'credits' => [
      'title' => 'クレジット',
      'developedBy' => '開発: <1></1>',
      'using' => '使用: <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => '翻訳: <1></1>',
      'openSourceSoftware' => 'オープンソース',
      'viewSourceCode' => 'ソースコードを見る',
      'notAffiliated' => 'このサイトとDiscordは関係していません。',
    ],
    'themeButton' => [
      'dark' => 'ダークモード',
      'light' => 'ライトモード',
      'system' => 'システム設定カラー',
    ],
  ],
  'designEditor' => [
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'CSS Variable',
    'valueColumnHeader' => 'Value',
  ],
];
