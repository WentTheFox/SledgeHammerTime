<?php

return [
  'howTo' => '날짜를 고르고, :syntaxColName 리스트에서 원하는 형식의 타임스탬프를 복사하여, 메시지에 그대로 붙여 넣으세요. 시간대에 따라, 모두에게 다르게 보이는 동적 타임스탬프가 될 것입니다.',
  'picker' => [
    'label' => [
      'date' => '날짜',
      'time' => '시간',
      'dateAndTime' => '일시',
      'timezone' => '시간대',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => '시간대 차감',
      'modeZoneName' => '시간대 이름',
    ],
    'button' => [
      'jumpToToday' => '이번 달로',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => '현재 시간으로 설정',
      'lock' => 'URL로 타임스탬프 잠그기',
      'unlock' => '타임스탬프 잠금 풀기',
      'previousYear' => '전년',
      'previousMonth' => '저번 달',
      'previousDecade' => '이전 10년',
      'nextMonth' => '다음 달',
      'nextYear' => '내년',
      'nextDecade' => '다음 10년',
    ],
    'validation' => [
      'naturalLanguageParseError' => '입력된 시간 분석 실패'
    ]
  ],
  'table' => [
    'syntaxColumn' => '메시지 형식',
    'resultColumn' => '결과 예시',
    'editFormats' => '형식 사용자 지정',
    'resetFormats' => '설정 초기화',
    'hideFormat' => '이 형식 숨기기',
    'showFormat' => '이 형식 표시',
    'unhideInProfile' => 'Unhide in profile settings',
  ],
  'faq' => [
    'title' => '자주 묻는 질문',
    'description' => '이 섹션은 현재 영어로만 제공되며, 주로 <1>Discord 서버의</1> 콘텐츠를 기반으로 합니다. 회원이 아닌 경우 일부 링크가 정상적으로 작동하지 않을 수 있습니다.',
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
      'header' => 'HammerTime 이전 사이트',
      'p' => '프로젝트의 이전 사이트 버전은 공지 전까지 이용 가능합니다',
    ],
    'textColor' => [
      'header' => 'Rebane님의 <1>컬러</1> 텍스트 생성기',
      'p' => 'ANSI 컬러 코드를 사용해서 Discord용 컬러 텍스트를 생성하는 간단한 앱',
    ],
    "subreddit" => [
      "p" => "이 프로젝트 제작에 영감을 준 저평가된 레이싱 게임들을 위한 주간 챌린지를 개최하는 커뮤니티",
    ],
    'competitors' => [
      'lead' => [
        'p1' => '타임스탬프를 생성하는 유일한 도구가 HammerTime이 아니라는 사실을 알고 계셨나요?',
        'p2' => '다른 Discord 타임스탬프 생성기를 확인하여 당신에게 가장 적합한 것을 찾을 수 있습니다:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => '간단하고 빠른 타임스탬프 생성기(3ventic)',
      ],
      'dabric' => [
        'header' => '',
        'p' => '자연어 디스코드 타임스탬프 생성기(dabric)',
      ],
      'discordtimestampCom' => [
        'p' => '현지 시간대 지원 무료 디스코드 타임스탬프 생성기(Sellframe Ltd.)',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord 타임스탬프 생성기 및 시간 변환기(DiscordTimestamp.org)',
      ],
      'sesh' => [
        'p' => 'Tunks의 Sesh 스케줄 봇 생태계 내에서 Discord 마크다운 타임스탬프 생성하기',
      ],
    ],
  ],
];
