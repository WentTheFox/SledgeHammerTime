<?php

return [
  'seoDescription' => 'Tạo lập định dạng thời gian tự động cho các tin nhắn trên Discord',
  'changeLanguage' => 'Thay đổi ngôn ngữ',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Chẳng có gì ở đây cả.",
  ],
  'incompleteTranslations' => 'Các bản dịch chưa được hoàn thiện',
  'contributeTranslations' => 'Đóng góp',
  'copyToClipboard' => 'Sao chép vào bảng nhớ tạm',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'Cần sử dụng JavaScript',
    'body' => "Trình duyệt của bạn có thể không hỗ trợ JavaScript hoặc chức năng này đã bị tắt. Một số trình duyệt mặc định vô hiệu hóa JavaScript vì lý do bảo mật, nhưng nó cần thiết cho hoạt động của ứng dụng chúng tôi. Vui lòng bật JavaScript và tải lại trang, hoặc sử dụng một trình duyệt khác.",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Tùy chỉnh định dạng nhập vào',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Phân tách ô nhập dữ liệu',
        'description' => "Hiển thị hai ô nhập dữ liệu tách biệt cho ngày và giờ thay vì để chung một ô (việc để chung có thể không được hỗ trợ ở một số trình duyệt)",
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
      'details' => 'Chi tiết',
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
      'title' => 'Local Settings',
    ],
    'credits' => [
      'title' => 'Các sự đóng góp',
      'developedBy' => 'Được phát triển bởi <1></1>',
      'using' => 'Sử dụng <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Bản dịch bởi <1></1>',
      'openSourceSoftware' => 'Phần mềm mã nguồn mở',
      'viewSourceCode' => 'Xem mã nguồn',
      'notAffiliated' => 'Dự án này không liên kết với Discord.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
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
