<?php

return [
  'howTo' => '日付を選び、 メッセージの :syntaxColName 列文からタイムスタンプを自由にコピーし、あなたのメッセージにどこにでも貼り付ける事ができます。 みんなのタイムゾーンに基づいて表示される動的タイムスタンプになります。',
  'picker' => [
    'label' => [
      'date' => '日付',
      'time' => '時刻',
      'dateAndTime' => '日付と時刻',
      'timezone' => 'タイムゾーン',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => '協定世界時',
      'modeZoneName' => 'ゾーンネーム',
    ],
    'button' => [
      'jumpToToday' => '現在の月へ移動',
    ],
    'tooltip' => [
      'setToCurrent' => '現在時刻にする',
      'lock' => 'リンクでタイムスタンプをセーブ',
      'unlock' => 'タイムスタンプをアンロック',
      'previousYear' => '前の年',
      'previousMonth' => '前の月',
      'nextMonth' => '次の月',
      'nextYear' => '次の年',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'メッセージの構文',
    'resultColumn' => '例',
  ],
  'usefulLinks' => [
    'lead' => '関連するもの',
    'server' => [
      'header' => 'HammerTime公式サーバー',
      'p' => 'サイトについての議論・タイムスタンプのテスト・機能のリクエストができます',
    ],
    'bot' => [
      'header' => 'HammerTimeアプリ',
      'p' => 'Discord内からコマンドでタイムスタンプを生成できます',
    ],
    'oldSite' => [
      'header' => '旧Hammer Timeサイト',
      'p' => 'ベータ版が公開されるまで引き続き利用可能な、プロジェクトの旧ウェブサイト',
    ],
    'textColor' => [
      'header' => 'Rebaneの<1>色付き</1>テキストジェネレーター',
      'p' => 'ANSIカラーコードを使って、色を付けたDiscordメッセージを作るアプリ',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "このプロジェクトのきっかけとなった、過小評価されているレースゲームを対象に、週次チャレンジを開催しているコミュニティ",
    ],
  ],
];
