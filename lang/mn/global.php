<?php

return [
  'seoDescription' => 'Дицкорд чат мэссэжэд цагийн үзэлтүүд бүтээ',
  'changeLanguage' => 'Хэлээ өөрчил',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Энд юу ч харагдахгүй.",
  ],
  'incompleteTranslations' => 'Очуулгууд бүрэн биш',
  'contributeTranslations' => 'Хувь нэмэр оруулсан',
  'copyToClipboard' => 'Түр санах ой рүү татах',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'ЖаваСкрипт хэрэгтэй',
    'body' => "Таны бровсэр ЖаваСкриптийг бологдоггүй, эсвэл одоо унтраачихсан байгаа. Зарим бровсэрүүд ЖаваСкриптийг аюулгүй байдалийн талаар унтраачихсан байдаг, тэгэхдээ энэ аппликатионд хэрэгтэй. Өөр бровсэр ашигла, пажээ рэфрэш хий эсвэл тэрийгээ асаа, гуйж байна.",
  ],
  'nav' => [
    'botSettings' => 'App Settings',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Сэттингс хий',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Оролтуудыг тусдаа болго',
        'description' => "Өдөр ба цагийн нийлүүлсэн оролтуудийг, хоёр өөр оролтоор тавих. (зарим бровсэрд болдоггүй)",
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
      'details' => 'Details',
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
      'title' => 'Кредитс',
      'developedBy' => '<1></1> аар бүтээгджээ',
      'using' => '<1></1> ийг ашилган хийгджээ',
      'fontAwesomeFree' => 'Фонт Авсом Фрий',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Орчуулга нь <1></1> аар хийгджээ',
      'openSourceSoftware' => 'Нээлттэй эхийн програмын хангамж',
      'viewSourceCode' => 'Эх сурвалжийн кодыг харах',
      'notAffiliated' => 'Энэ прожект Дискордтай хамааралгүй.',
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
