<?php

return [
  'howTo' => 'اختر تاريخ، وانسخ الختم الزمني الذي تريده من صف :syntaxColName، ثم الصقه في أي مكان في رسالة شات. ستكون النتيجة هي ختم زمني يتغير بشكل تلقائي حسب توقيت كل مستخدم.',
  'picker' => [
    'label' => [
      'date' => 'تاريخ',
      'time' => 'الوقت',
      'dateAndTime' => 'التاريخ و الوقت',
      'timezone' => 'المنطقة الزمنية',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'اسم المنطقة',
    ],
    'button' => [
      'jumpToToday' => 'الانتقال إلى الشهر الحالي',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'تعيين إلى الوقت الحالي',
      'lock' => 'منع تعديل الختم الزمني عن طريق الـ url',
      'unlock' => 'تفعيل تعديل الختم الزمني',
      'previousYear' => 'السنة الماضية',
      'previousMonth' => 'الشهر الماضي',
      'previousDecade' => 'Previous decade',
      'nextMonth' => 'الشهر القادم',
      'nextYear' => 'السنة القادمة',
      'nextDecade' => 'Next decade',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'صيغة الدردشة',
    'resultColumn' => 'مثال على النتيجة',
  ],
  'usefulLinks' => [
    'lead' => 'قد تعجبك هذه الخدمات أيضا:',
    'server' => [
      'header' => 'سيرفر HammerTime الرسمي',
      'p' => 'ناقش الموقع وجرب الصيغة وقدِّم اقتراحات',
    ],
    'bot' => [
      'header' => 'تطبيق HammerTime',
      'p' => 'قم بعمل أختام زمنية من داخل ديسكورد باستخدام أوامر السلاش (slash commands)',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until this Beta goes live',
    ],
    'textColor' => [
      'header' => 'صانع الكلام <1>الملوّن</1> لريبان',
      'p' => 'تطبيق بسيط يقوم بعمل رسائل ملونة لديسكورد عن طريق رموز ألوان ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "The community hosting weekly challenges for an underrated racing game that inspired the creation of this project",
    ],
  ],
];
