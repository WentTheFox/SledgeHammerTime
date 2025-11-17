<?php

return [
  'seoDescription' => 'Discord용 타임스탬프를 생성할 수 있습니다.',
  'changeLanguage' => '언어 변경',
  "notFound" => [
    "heading" => "페이지를 찾을 수 없습니다",
    "content" => "표시할 콘텐츠가 없습니다",
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
    ],
    'timeSync' => [
      'title' => 'Time Synchronization',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'Your system clock is accurate.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'The difference between the local and server time is :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Apply server time offset to calculations (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => '세부',
      'autoApplyCheckbox' => 'Apply calculated offset to DateTime library when pressing :syncButtonLabel manually (only applies if the difference is above the :offset threshold)',
      'syncButtonLabel' => 'Synchronize',
      'resetOffsetButtonLabel' => 'Reset applied offset',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'dtlOffsetCell' => 'Active Calculation Offset',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
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
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'CSS Variable',
    'valueColumnHeader' => 'Value',
  ],
];
