<?php

return [
  'howTo' => 'Lựa chọn một thời điểm, sao chép định dạng thời gian theo nhu cầu từ cột :syntaxColName, và gắn định dạng này vào bất cứ đâu trong tin nhắn. Kết quả thu được sẽ là một con dấu thời gian tự động cập nhật dựa trên múi giờ của từng người dùng.',
  'picker' => [
    'label' => [
      'date' => 'Ngày tháng năm',
      'time' => 'Giờ phút giây',
      'dateAndTime' => 'Ngày giờ',
      'timezone' => 'Múi giờ',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
      'contextRangeLong' => '<0/> – <2/>',
      'contextRangeShort' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Đặt về thời điểm hiện tại',
      'lock' => 'Cố định thời gian sử dụng đường dẫn URL',
      'unlock' => 'Bỏ cố định thời gian',
      'previousYear' => 'Previous year',
      'previousMonth' => 'Previous month',
      'previousDecade' => 'Previous decade',
      'nextMonth' => 'Next month',
      'nextYear' => 'Next year',
      'nextDecade' => 'Next decade',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Định dạng tin nhắn',
    'resultColumn' => 'Kết quả ví dụ',
  ],
  'usefulLinks' => [
    'lead' => 'Những đường dẫn dưới đây có thể có ích đối với bạn:',
    'server' => [
      'header' => 'Server chính thức của HammerTime',
      'p' => 'Thảo luận về trang web, thử nghiệm định dạng và góp ý thêm các tính năng mới',
    ],
    'bot' => [
      'header' => 'Ứng dụng HammerTime',
      'p' => 'Tạo lập định dạng thời gian tự động ngay trong Discord bằng các câu lệnh sử dụng gạch chéo',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until this Beta goes live',
    ],
    'textColor' => [
      'header' => 'Trình tạo lập Tin nhắn <1>Sắc màu</1> của Rebane',
      'p' => 'Một ứng dụng đơn giản để tạo ra những tin nhắn đầy màu sắc trên Discord sử dụng mã màu ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "Cộng đồng tổ chức các thử thách hàng tuần cho một trò chơi đua xe ít được biết đến, trò chơi này đã truyền cảm hứng cho việc tạo ra dự án này",
    ],
  ],
];
