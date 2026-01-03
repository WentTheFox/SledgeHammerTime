<?php

return [
  'title' => '프로필',
  'intro' => '이 프로필 페이지를 사용하여, 이 사이트에 연결된 계정 정보를 변경 할 수 있습니다. 
만약 Discord 앱의 기본 설정이나 다른 설정을 원하시면 <1>앱 설정</1> 페이지를 사용 해 주십시오.',
  'information' => [
    'heading' => '프로필 정보',
    'description' => "계정의 프로필을 업데이트 해 주십시오.",
    'displayName' => '공개 이름',
    'hiddenFormats' => '테이블에서 숨긴 포맷들',
    'saveSuccess' => 'Your profile has been updated successfully.',
  ],
  'accounts' => [
    'heading' => '연결된 계정',
    'description' => '이 페이지를 사용하여 HammerTime 계정에 다른 계정들의 연결과 관리가 가능합니다. 
변경 된 기본 정보들은 최대 한 시간에 한번씩 자동으로 업데이트 됩니다.',
    'discord' => 'Discord 계정',
    'crowdin' => 'Crowdin 계정',
    'noConnectedAccounts' => '현재 연결 된 계정이 없습니다',
    'linkAdditional' => [
      'heading' => '다른 계정 연결',
      'description' => '아래의 버튼으로 현재 HammerTime 계정에 다른 계정 들을 연결합니다.',
      'discord' => [
        'description' => '만약 Discord 계정의 프로필이나 이름이 바뀌었을 경우, 아래 버튼을 사용하여 이미 연결된 Discord 계정 정보를 업데이트 할 수 있습니다.',
        'authorize' => 'Discord 계정 연결',
      ],
      'crowdin' => [
        'description' => '이 프로젝트의 번역자라면, Crowdin 계정 연결 시 번역자 기여 창에 보이는 이름을 변경 가능합니다.
그리고 프로젝트의 Discord 서버에 가입 시, 또 하나의 확인 정보로 사용 가능합니다.',
        'authorize' => 'Crowdin 계정 연결',
      ],
    ],
  ],
  'deletion' => [
    'heading' => '계정 삭제 안내',
    'description' => '계정 삭제 후엔 모든 데이터와 리소스가 영구 삭제 됩니다. 계정 삭제 전에 필요하신 데이터와 정보들을 다운로드 해주십시오.',
    'deleteButton' => '계정 삭제',
    'confirmDialog' => [
      'header' => '정말로 계정을 삭제하시겠습니까?',
      'body' => '계정삭제 후엔 모든 데이터와 리소스가 영구 삭제 됩니다.',
    ],
  ],
];
