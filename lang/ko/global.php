<?php

return [
  'seoDescription' => 'Discord용 타임스탬프를 생성할 수 있습니다.',
  'changeLanguage' => '언어 변경',
  "notFound" => [
    "heading" => "페이지를 찾을 수 없습니다",
    "content" => "표시할 콘텐츠가 없습니다",
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
  'incompleteTranslations' => '번역 미완료',
  'contributeTranslations' => '기여하기',
  'copyToClipboard' => '클립보드에 복사',
  'copiedToClipboard' => '클립보드에 복사했습니다!',
  'jsDisabled' => [
    'title' => 'JavaScript가 필요합니다',
    'body' => "현재 사용하고 계시는 브라우저가 JavaScript를 지원하지 않거나, JavaScript를 끄고 있습니다. 일부 브라우저는 보안상의 이유로 기본값으로 JavaScript를 끄지만, 이 앱은 JavaScript를 사용합니다. JavaScript를 키고 페이지를 새로고침하거나, 다른 브라우저를 사용해 주세요.",
  ],
  'nav' => [
    'botSettings' => '앱 설정',
    'profile' => '프로필',
    'legal' => '법률 정보',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => '입력 설정',
      'naturalLanguageInput' => [
        'label' => '@time input field',
        'description' => 'Allow manipulating the selected timestamp with natural language (e.g. “in 5 hours”) via an additional free-text input. Similar to the new Discord @time tag. Only a limited number of languages are supported.',
      ],
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => '별개 입력',
        'description' => "한 입력창 대신, 날짜와 시간으로 나뉜 두 입력창을 표시합니다 (일부 브라우저에서 지원하지 않음)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
      'hourCycle' => [
        'label' => 'Custom time input clock type',
        'description' => 'Change how hours should be displayed in the custom time input. Has no effect on the previews in the example results column.',
        'options' => [
          'default' => 'Language default',
          'h12' => '12-hour',
          'h24' => '24-hour',
        ],
      ],
    ],
    'timeSync' => [
      'title' => '시간 동기화',
      'status' => [
        'syncing' => '당신의 시스템 시간이 우리의 서버와 동기화 중 입니다. 
잠시만 기다려 주십시오.',
        'accurate' => '당신의 시스템 시각은 정확합니다.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => '현재 지역 시간과 서버 시간 사이의 차이는 :offset입니다.',
      ],
      'autoTimeSync' => [
        'label' => '서버 시간 차감 적용 (베타)',
        'description' => '당신의 시스템 시간과 서버 시간의 차이가 :offset 보다 높다면 (시간대 제외), 자동으로 이 차이를 적용하여 시간의 오차를 줄입니다. <1>이 기능은 현재 실험 중 이므로, 주의가 필요합니다.</1> 동기화는 이 기능을 켜고 페이지를 처음 방문 시에 적용됩니다.',
      ],
      'details' => '세부',
      'autoApplyCheckbox' => '계산 된 차감을 :syncButtonLabel 를 누를 때 DateTime 라이브러리에 적용 (차이가 :offset 보다 높을 때만 적용)',
      'syncButtonLabel' => '동기화',
      'resetOffsetButtonLabel' => '설정된 차감 초기화',
      'roundTripDuration' => '왕복 시간',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'dtlOffsetCell' => '현재 적용 중인 차감',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => '감지된 차감 (네트워크)',
    ],
    'localSettings' => [
      'title' => '로컬 설정',
    ],
    'credits' => [
      'title' => '개발진',
      'developedBy' => '개발: <1></1>',
      'using' => '사용 중: <1></1>',
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
    'description' => '이 웹사이트의 디자인을 아래의 테이블을 사용하여 변경 할 수 있습니다. 변수의 이름들은 코드의 식별자이기에 번역되지 않습니다. 변경된 값은 새로 고침 시에 초기화 됩니다.',
    'designPageLink' => '디자인 페이지',
    'exportInfo' => '변경 된 값을 UserStyle 파일로 저장 할 수 있으며 <1>Stylus</1> 같은 확장 프로그램을 사용하면 디자인을 영구 변경 할 수 있습니다.
하지만 만약에 이 변수들이 언젠가 바뀐다면 사용자가 직접 변경해야 할 수 있습니다.',
    'export' => 'UserStyle 파일 저장',
    'variableColumnHeader' => 'CSS 변수',
    'valueColumnHeader' => '값',
  ],
];
