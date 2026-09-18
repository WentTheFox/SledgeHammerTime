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
    'saveSuccess' => '당신의 프로필이 성공적으로 업데이트 되었습니다.',
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
        'description' => '이 프로젝트의 번역가라면, Crowdin 계정을 연동하면 번역 크레딧에 표시될 이름을 직접 설정할 수 있을 뿐만 아니라, 프로젝트의 Discord 서버에 가입할 경우 해당 계정이 본인의 것임을 확인하는 추가적인 수단으로도 활용됩니다.',
        'authorize' => 'Crowdin 계정 연결',
      ],
    ],
  ],
  'creditOverrides' => [
    'heading' => '번역 크레딧',
    'description' => '기여자로 등록된 각 언어의 번역 크레딧에 표시되는 내용을 사용자 지정할 수 있습니다.',
    'updateMethodLabel' => '업데이트 방법',
    'updateMethodDescription' => '다른 언어에서 내용을 복사할 경우 수동 검토가 필요하지 않습니다',
    'updateMethodCopyLabel' => '다른 언어에서 가져오기',
    'updateMethodEditLabel' => '개별 값 지정',
    'creditSourceLanguage' => '복사할 언어',
    'displayName' => '표시 이름',
    'avatarProvider' => '아바타',
    'avatarProviders' => [
        'discord' => '디스코드',
        'gravatar' => 'Gravatar',
        'crowdin' => 'Crowdin',
    ],
    'gravatarEmail' => '이메일 주소',
    'gravatarDescription' => '<1>Gravatar</1>을(를) 사용하면 이를 지원하는 여러 웹사이트에서 하나의 아바타를 사용할 수 있습니다. 귀하의 이메일 주소는 MD5 해시 형태로 저장됩니다.',
    'avatarAccount' => '계정',
    'url' => '링크',
    'visibility' => '표시 여부',
    'submit' => '심사 요청',
    'saveSuccess' => '심사 요청됨',
    'saveHideSuccess' => '표시 여부 업데이트됨',
    'copySuccess' => '크레딧 복사됨',
    'cancel' => '변경 사항 되돌리기',
    'statusPrefix' => '상태',
    'status' => [
      'approved' => '승인됨',
      'inReview' => '심사 중',
      'rejected' => '거부됨',
    ],
    'currentlyApproved' => '승인된 값 목록',
    'reApprovalWarning' => '‘표시 여부’ 이외의 항목을 변경하면 수동 검토가 필요합니다. 이 페이지에서 언제든지 검토 요청을 취소할 수 있습니다.',
    'deleteOverride' => '덮어쓰기 제거',
    'deleteOverrideConfirm' => '번역 크레딧 재정의 설정을 정말로 제거하시겠습니까? 해당 항목은 Crowdin의 기본 정보로 되돌아가게 됩니다.',
    'approvedValues' => [
      'displayName' => '이름',
      'avatarProvider' => 'Avatar provider',
      'avatarId' => 'Avatar ID',
      'url' => 'Profile URL',
      'visible' => 'Visible',
      'hidden' => 'Hidden',
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
