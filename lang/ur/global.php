<?php

return [
  'seoDescription' => 'ڈسکارڈ میسج چیٹ کے لیے ٹائم اسٹیمپ اشارے تیار کریں۔',
  'changeLanguage' => 'زبان تبدیل کریں',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "یہاں دیکھنے کے لیے کچھ نہیں ہے۔",
  ],
  'incompleteTranslations' => 'ترجمے نامکمل ہیں۔',
  'contributeTranslations' => 'تعاون کریں۔',
  'copyToClipboard' => 'کلپ بورڈ پر کاپی کریں۔',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'جاوا اسکرپٹ ضروری ہے۔',
    'body' => "آپ کا براؤزر یا تو جاوا اسکرپٹ کو سپورٹ نہیں کرتا یا یہ فی الحال غیر فعال ہے۔ کچھ براؤزرز سیکیورٹی وجوہات کی بنا پر جاوا اسکرپٹ کو بطور ڈیفالٹ غیر فعال کرتے ہیں، لیکن یہ اس ایپلیکیشن کے لیے ضروری ہے۔ براہ کرم اسے فعال کریں اور صفحہ کو ریفریش کریں، یا کوئی مختلف براؤزر استعمال کریں۔",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'ان پٹ سیٹنگ',
      'customInputs' => [
        'label' => 'اپنی مرضی کے مطابق ان پٹ',
        'description' => "Replaces the browser's default inputs with custom ones that respect your chosen website language",
      ],
      'separateInputs' => [
        'label' => 'الگ الگ ان پٹ',
        'description' => "تاریخ اور وقت کے لیے مشترکہ کی بجائے دو مختلف ان پٹ ڈسپلے کریں   (جو کچھ براؤزرز میں تعاون یافتہ نہیں ہے)",
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
      'details' => 'تفصیلات',
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
      'title' => 'کریڈٹس',
      'developedBy' => 'تیار کنندہ <1></1>',
      'using' => 'استعمال میں <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'ترجمہ بذریعہ <1></1>',
      'openSourceSoftware' => 'اوپن سورس سافٹ ویئر',
      'viewSourceCode' => 'سورس کوڈ دیکھیں',
      'notAffiliated' => 'یہ پروجیکٹ ڈسکارڈ سے وابستہ نہیں ہے۔',
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
