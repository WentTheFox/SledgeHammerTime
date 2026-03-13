<?php

return [
  'heading' => 'ページ閲覧の分析',
  'description' => 'このページには、過去30日間のアプリの総閲覧数に関する基本的な分析（個人を特定できる詳細情報を含まないデータの保存と表示の両方）が含まれています。',
  'collectionMethod' => 'The data is collected on the server side, based on responses sent to a limited set of pages. The page views are recorded individually but aggregated daily by a background process.',
  'lastUpdated' => 'The information on this page is cached for a short period to reduce server load. The data you see was last updated <1/>.',
  'charts' => [
    'dailyTotal' => 'Daily Total Page Views',
    'breakdown' => 'Page Views Breakdown',
    'byPage' => 'By Pages',
    'byLanguage' => 'By Language',
  ],
  'values' => [
    'unknown' => 'Unknown',
  ],
];
