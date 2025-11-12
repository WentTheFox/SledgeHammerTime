<?php

return [
  'howTo' => 'Pick a date, copy the desired timestamp from the :syntaxColName column, then paste it anywhere in a chat message. The result will be a dynamic timestamp that displays differently for everyone based on their own timezone.',
  'picker' => [
    'label' => [
      'date' => '날짜',
      'time' => '시간',
      'dateAndTime' => '일시',
      'timezone' => '시간대',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
    ],
    'tooltip' => [
      'setToCurrent' => '현재 시간으로 설정',
      'lock' => 'URL로 타임스탬프 잠그기',
      'unlock' => '타임스탬프 잠금 풀기',
      'previousYear' => 'Previous year',
      'previousMonth' => 'Previous month',
      'nextMonth' => 'Next month',
      'nextYear' => 'Next year',
    ],
  ],
  'table' => [
    'syntaxColumn' => '메시지 형식',
    'resultColumn' => '결과 예시',
  ],
  'usefulLinks' => [
    'lead' => '유용할 수도 있는 링크들',
    'server' => [
      'header' => '공식 HammerTime 서버',
      'p' => '웹사이트에 대한 토론, 타임스탬프의 테스트, 기능의 요청을 하실 수 있습니다.',
    ],
    'bot' => [
      'header' => 'HammerTime 앱',
      'p' => '슬래시 명령어를 사용하여 Discord 내에서 타임스탬프를 생성하세요.',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until this Beta goes live',
    ],
    'textColor' => [
      'header' => 'Rebane님의 <1>컬러</1> 텍스트 생성기',
      'p' => 'ANSI 컬러 코드를 사용해서 Discord용 컬러 텍스트를 생성하는 간단한 앱',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "이 프로젝트 제작에 영감을 준 저평가된 레이싱 게임들을 위한 주간 챌린지를 개최하는 커뮤니티",
    ],
  ],
];
