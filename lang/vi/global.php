<?php

return [
  'seoDescription' => 'Tạo lập định dạng thời gian tự động cho các tin nhắn trên Discord',
  'changeLanguage' => 'Thay đổi ngôn ngữ',
  "notFound" => [
    "heading" => "Không tìm thấy trang",
    "content" => "Chẳng có gì ở đây cả.",
  ],
  "maintenanceMode" => [
    "heading" => "Đang bảo trì",
    "content" => [
      'pleaseWait' => "Ứng dụng hiện đang được cập nhật, vui lòng thử lại sau vài giây.",
      'joinSupportServer' => "Nếu vấn đề vẫn tiếp diễn sau vài phút, vui lòng tham gia cộng đồng hỗ trợ trên Discord và thông báo cho chúng tôi.",
      'contactDeveloper' => "Nếu vấn đề vẫn tiếp diễn sau vài phút, vui lòng liên hệ nhà phát triển ứng dụng và thông báo cho họ biết.",
    ],
    "supportServerButton" => "Cộng đồng hỗ trợ",
  ],
  'incompleteTranslations' => 'Các bản dịch chưa được hoàn thiện',
  'contributeTranslations' => 'Đóng góp',
  'copyToClipboard' => 'Sao chép vào bảng nhớ tạm',
  'copiedToClipboard' => 'Đã sao chép vào bộ nhớ tạm thời!',
  'jsDisabled' => [
    'title' => 'Cần sử dụng JavaScript',
    'body' => "Trình duyệt của bạn có thể không hỗ trợ JavaScript hoặc chức năng này đã bị tắt. Một số trình duyệt mặc định vô hiệu hóa JavaScript vì lý do bảo mật, nhưng nó cần thiết cho hoạt động của ứng dụng chúng tôi. Vui lòng bật JavaScript và tải lại trang, hoặc sử dụng một trình duyệt khác.",
  ],
  'nav' => [
    'botSettings' => 'Cài đặt ứng dụng',
    'profile' => 'Hồ sơ cá nhân',
    'legal' => 'Thông tin pháp lý',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Tùy chỉnh định dạng nhập vào',
      'customDateInput' => [
        'label' => 'Ô nhập ngày tuỳ chỉnh',
        'description' => "Thay thế ô nhập ngày mặc định của trình duyệt bằng một ô nhập ngày tùy chỉnh.",
      ],
      'customTimeInput' => [
        'label' => 'Ô nhập thời gian tuỳ chỉnh',
        'description' => "Thay thế ô nhập thời gian mặc định của trình duyệt với một ô nhập tuỳ chỉnh. Tuỳ chọn này đặc biệt hữu ích nếu bạn gặp khó khăn trong việc chọn thời gian trên máy di động.",
      ],
      'separateInputs' => [
        'label' => 'Phân tách ô nhập dữ liệu',
        'description' => "Hiển thị hai ô nhập dữ liệu tách biệt cho ngày và giờ thay vì để chung một ô (việc để chung có thể không được hỗ trợ ở một số trình duyệt)",
      ],
      'flatUi' => [
        'label' => 'Giao diện phẳng',
        'description' => "Tắt hiệu ứng bóng và hiệu ứng nổi ở các ô nhập và nút bấm",
      ],
    ],
    'timeSync' => [
      'title' => 'Đồng bộ hoá đồng hồ',
      'status' => [
        'syncing' => 'Đồng hồ trên máy bạn đang được đồng bộ với máy chủ của chúng tôi, vui lòng đợi.',
        'accurate' => 'Đồng hồ trên máy của bạn chính xác.',
        'potentiallyWrong' => 'Đồng hồ trên máy bạn có thể không chính xác.',
        'value' => 'Đồng hồ trên máy của bạn và máy chủ đang chênh lệch :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Áp dụng múi giờ của máy chủ để tính (Giai đoạn thử nghiệm)',
        'description' => 'Nếu đồng hồ trên máy bạn chênh lệch hơn :offset so với đồng hồ trên máy chủ (không tính chênh lệch múi giờ), một số phép tính thời gian sẽ được điều chỉnh theo sự chênh lệch này, nhờ đó các định dạng thời gian của bạn sẽ ít có khả năng sai lệch. <1>Đây là tính năng thử nghiệm, xin lưu ý khi sử dụng!</1> Đồng bộ hoá diễn ra khi trang web được tải lần đầu, và ngay sau khi cài đặt này được bật.',
      ],
      'details' => 'Chi tiết',
      'autoApplyCheckbox' => 'Áp dụng độ chênh lệch đã tính vào thư viện DateTime khi người dùng nhấn nút :syncButtonLabel (chỉ áp dụng khi độ chênh lệch vượt quá ngưỡng :offset)',
      'syncButtonLabel' => 'Đồng bộ',
      'resetOffsetButtonLabel' => 'Khôi phục độ lệch đã đặt',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'Thời gian của máy khách khi gửi yêu cầu',
      't1' => 'Thời gian của máy chủ khi nhận được yêu cầu',
      't2' => 'Thời gian của máy chủ khi gửi trả phản hồi',
      't3' => 'Thời gian của máy khách khi nhận được phản hồi',
      'dtlOffsetCell' => 'Active Calculation Offset',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Độ chênh lệch tính được (qua đường mạng)',
    ],
    'localSettings' => [
      'title' => 'Tuỳ chọn của máy',
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
      'dark' => 'Giao diện Tối',
      'light' => 'Giao diện Sáng',
      'system' => 'Sử dụng giao diện máy',
    ],
  ],
  'designEditor' => [
    'title' => 'Trình tuỳ chọn giao diện',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'Biến CSS',
    'valueColumnHeader' => 'Giá trị',
  ],
];
