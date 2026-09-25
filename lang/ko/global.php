<?php

return [
  'seoDescription' => 'Discord 타임스탬프 생성',
  'changeLanguage' => '언어 변경',
  "notFound" => [
    "heading" => "페이지를 찾을 수 없습니다",
    "content" => "표시할 콘텐츠가 없습니다.",
    "suggestions" => [
      "heading" => "뭔가를 찾고 계시나요?",
      "description" => "도움이 될 수 있는 페이지를 소개합니다.",
      "picker" => "타임스탬프 선택기",
      "botInfoDescription" => "Discord 봇 및 사용 가능한 명령어에 대한 정보",
      "discordCta" => "무언가 빠진 게 있다고 생각하시나요? Discord 서버에 참가하여 알려주세요.",
      "discordButton" => "Discord 서버 참가하기",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "점검 모드",
    "content" => [
      'pleaseWait' => "현재 업데이트가 진행 중입니다. 잠시 후에 다시 시도해 주세요.",
      'joinSupportServer' => "문제가 몇 분간 계속된다면, Discord 지원 서버에 참가 후 문의해 주세요.",
      'contactDeveloper' => "문제가 몇 분간 계속된다면, 개발자에게 연락하여 문제를 알려 주세요.",
    ],
    'autoReload' => '페이지가 <1/> 자동으로 새로고침됩니다.',
    'reloadButton' => '직접 새로고침',
    "supportServerButton" => "지원 서버",
    "contactDeveloperButton" => "개발자 연락",
  ],
  'incompleteTranslations' => '번역 미완료',
  'contributeTranslations' => '기여하기',
  'timezoneBadge' => [
    'currently' => '현재 기준',
    'atPickedDate' => '지정 시간 기준',
    'currentlyAndAtPickedDate' => '현재 및 지정 시간 기준',
  ],
  'copyToClipboard' => '클립보드에 복사',
  'copiedToClipboard' => '클립보드 복사 완료!',
  'jsDisabled' => [
    'title' => 'JavaScript 필요',
    'body' => "현재 사용하고 계시는 브라우저가 JavaScript를 지원하지 않거나, 비활성화되어 있습니다. 일부 브라우저는 보안상의 이유로 기본값으로 JavaScript를 비활성화하지만, 본 앱의 실행에 필요합니다. JavaScript를 활성화한 후 페이지를 새로고침하거나, 다른 브라우저를 사용해 주세요.",
  ],
  'nav' => [
    'botSettings' => '앱 설정',
    'profile' => '프로필',
    'legal' => '법률 정보',
    'analytics' => '통계',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => '입력 설정',
      'naturalLanguageInput' => [
        'label' => '@time 입력란',
        'description' => '선택한 타임스탬프를 자유 텍스트 입력을 통해 자연어(예: \'5시간 후\')로 수정할 수 있습니다. Discord의 @time 태그와 비슷합니다. 이 기능은 몇몇 언어에서만 지원합니다.',
      ],
      'customDateInput' => [
        'label' => '커스텀 날짜 입력',
        'description' => "브라우저의 날짜 입력 창을 사이트 내 커스텀 Ui로 변경합니다.",
      ],
      'customTimeInput' => [
        'label' => '커스텀 시간 입력',
        'description' => "브라우저의 시간 입력 창을 사이트 내 커스텀 UI로 변경합니다. 모바일 브라우저에서 시간 선택에 문제가 있는 경우에 유용합니다.",
      ],
      'separateInputs' => [
        'label' => '입력 분리',
        'description' => "한 입력창 대신, 날짜와 시간으로 나뉜 두 입력창을 표시합니다 (단일 입력창을 지원하지 않는 일부 브라우저를 위함)",
      ],
      'flatUi' => [
        'label' => '인터페이스 평면화',
        'description' => "입력 창과 버튼의 그림자 및 높이 효과를 비활성화합니다",
      ],
      'timezoneStickyHeaders' => [
        'label' => '시간대 그룹 헤더',
        'description' => '시간대 선택 드롭다운 메뉴에 고정 그룹 헤더(예: America, Europe)를 표시합니다.',
      ],
      'hourCycle' => [
        'label' => '시간 형식',
        'description' => '커스텀 시간 입력 및 미리보기 등을 포함하여, 앱 전체에서 시간이 표시되는 방식을 변경합니다.',
        'options' => [
          'default' => '언어 기본값',
          'h12' => '12시간제',
          'h24' => '24시간제',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => '한 주의 시작 요일',
        'description' => '커스텀 입력 창에서의 일주일의 시작 요일을 변경합니다.',
        'options' => [
          'default' => '언어 기본값',
        ],
      ],
      'advancedSettings' => '고급 입력 설정',
    ],
    'timeSync' => [
      'title' => '시간 동기화',
      'status' => [
        'syncing' => '현재 시스템 시간이 서버와 동기화 중입니다. 잠시 기다려 주세요.',
        'accurate' => '시스템 시간이 정확합니다.',
        'potentiallyWrong' => '시스템 시간이 틀렸을 수 있습니다.',
        'value' => '시스템 시간과 서버 시간의 차이가 :offset입니다.',
      ],
      'details' => '세부 사항',
      'syncButtonLabel' => '동기화',
      'roundTripDuration' => '왕복 시간',
      't0' => '요청 전송 시점의 클라이언트 타임스탬프',
      't1' => '요청 수신 시점의 서버 타임스탬프',
      't2' => '응답 전송 시점의 서버 타임스탬프',
      't3' => '응답 수신 시점의 클라이언트 타임스탬프',
      'timestampValue' => ':value초',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => '감지 오프셋 (네트워크)',
    ],
    'localSettings' => [
      'title' => '로컬 설정',
    ],
    'credits' => [
      'title' => '크레딧',
      'developedBy' => '개발: <1></1>',
      'using' => '사용 프로젝트: <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => '번역: <1></1>',
      'openSourceSoftware' => '오픈 소스 소프트웨어',
      'viewSourceCode' => '소스 코드 보기',
      'notAffiliated' => '이 프로젝트는 Discord와 관련이 없습니다.',
    ],
    'themeButton' => [
      'dark' => '다크 모드',
      'light' => '라이트 모드',
      'system' => '시스템 설정 사용',
    ],
  ],
  'designEditor' => [
    'title' => '디자인 변경',
    'description' => '본 웹사이트의 디자인을 아래 표를 사용하여 변경할 수 있습니다. 변수명은 코드 내 식별자이기에 번역되지 않습니다. 변경된 값은 새로고침 시 초기화됩니다.',
    'designPageLink' => '디자인 페이지',
    'exportInfo' => '변경 사항을 UserStyle 파일로 저장할 수 있으며, <1>Stylus</1> 등의 확장 프로그램을 사용하여 디자인을 영구적으로 변경할 수 있습니다. 단, 아래 변수들은 언제든지 변경될 수 있으며, 커스텀 스타일을 수동으로 수정해야 할 수 있습니다.',
    'export' => 'UserStyle 파일 저장',
    'variableColumnHeader' => 'CSS 변수',
    'valueColumnHeader' => '값',
  ],
];
