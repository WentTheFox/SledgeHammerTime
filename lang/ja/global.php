<?php

return [
  'seoDescription' => 'Discordメッセージのタイムスタンプを生成できる',
  'changeLanguage' => '言語を変える',
  "notFound" => [
    "heading" => "ページが見つかりませんでした",
    "content" => "ここは何もありません",
  ],
  "maintenanceMode" => [
    "heading" => "メンテナンスモード",
    "content" => [
      'pleaseWait' => "アプリケーションは現在更新中です。しばらくしてからもう一度お試しください。",
      'joinSupportServer' => "問題が数分以上続く場合は、Discordサポートサーバーに参加してご連絡ください。",
      'contactDeveloper' => "問題が数分以上続く場合は、開発者に連絡し、その旨をお知らせください。",
    ],
    "supportServerButton" => "サポートサーバー",
  ],
  'incompleteTranslations' => '翻訳は未完成です',
  'contributeTranslations' => '貢献',
  'copyToClipboard' => 'クリップボードにコピー',
  'copiedToClipboard' => 'クリップボードにコピーしました！',
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
      'naturalLanguageInput' => [
        'label' => '@time input field',
        'description' => 'Allow manipulating the selected timestamp with natural language (e.g. “in 5 hours”) via an additional free-text input. Similar to the new Discord @time tag. Only a limited number of languages are supported.',
      ],
      'customDateInput' => [
        'label' => 'カスタム日付入力',
        'description' => "ブラウザの既定の日付入力フィールドをカスタム入力フィールドに置き換える。",
      ],
      'customTimeInput' => [
        'label' => 'カスタム時刻入力',
        'description' => "ブラウザのデフォルトの時間入力フィールドをカスタム入力フィールドに置き換えます。特にモバイルブラウザで時間を選択しづらい場合に便利です。",
      ],
      'separateInputs' => [
        'label' => '分離入力',
        'description' => "日付と時刻の入力を分離させます（一部ブラウザではサポートされていません）",
      ],
      'flatUi' => [
        'label' => 'インターフェースをフラット化する',
        'description' => "入力項目とボタンで影と高さの立体エフェクトを無効にする",
      ],
    ],
    'timeSync' => [
      'title' => '時刻更新',
      'status' => [
        'syncing' => 'システム時計が現在、当社のサーバーと同期中です。しばらくお待ちください。',
        'accurate' => '時計は正確です。',
        'potentiallyWrong' => 'システム時計が正確でない可能性があります。',
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
      't1' => 'リクエスト受信時のサーバーのタイムスタンプ',
      't2' => 'サーバーの応答送信時刻',
      't3' => 'クライアントの応答受信時刻',
      'dtlOffsetCell' => '有効演算オフセット',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => '検出されたオフセット（ネットワーク経由）',
    ],
    'localSettings' => [
      'title' => '局所設定',
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
      'chrono' => 'chrono',
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
    'title' => 'デザイン編集',
    'description' => '以下の表の入力項目を使用して、ウェブサイトの表示に関する多くの要素を調整できます。変数名はコード内の識別子に基づいているため、翻訳できません。ページを更新すると値がリセットされます。',
    'designPageLink' => 'デザインページ',
    'exportInfo' => '変更内容をUserStyleファイルにエクスポートできます。このファイルは<1>Stylus</1>などの拡張機能で使用でき、アプリの外観を恒久的にカスタマイズできます。ただし、これらの変数は随時変更される可能性があるため、カスタムスタイルを手動で更新する必要が生じる点に注意してください。',
    'export' => 'ユーザースタイルとして書き出す',
    'variableColumnHeader' => 'CSS 変数',
    'valueColumnHeader' => '評価',
  ],
];
