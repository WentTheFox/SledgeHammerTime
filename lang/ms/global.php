<?php

return [
  'seoDescription' => 'Jana penunjuk cap masa untuk mesej sembang Discord',
  'changeLanguage' => 'Tukar bahasa',
  "notFound" => [
    "heading" => "Halaman Tidak Dijumpai",
    "content" => "Tiada apa-apa untuk dilihat di sini.",
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
  'incompleteTranslations' => 'Terjemahan masih belum lengkap',
  'contributeTranslations' => 'Sumbang',
  'copyToClipboard' => 'Salin ke papan keratan',
  'copiedToClipboard' => 'Disalin ke papan keratan!',
  'jsDisabled' => [
    'title' => 'JavaScript diperlukan',
    'body' => "Pelayar anda sama ada tidak menyokong JavaScript ataupun ia dinyahdayakan ketika ini. Sesetengah pelayar menyahdayakan JavaScript secara lalainya atas sebab keselamatan, tetapi ia diperlukan untuk aplikasi ini. Sila mendayakannya dan segar semula halaman, atau guna pelayar yang lain.",
  ],
  'nav' => [
    'botSettings' => 'Tetapan Apl',
    'profile' => 'Profil',
    'legal' => 'Maklumat Undang-Undang',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Tetapan input',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Input berasingan',
        'description' => "Memaparkan dua input berlainan untuk tarikh dan masa menggantikan input bergabung (yang tidak disokong pada sesetengah pelayar)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
    ],
    'timeSync' => [
      'title' => 'Penyegerakan Masa',
      'status' => [
        'syncing' => 'Jam sistem anda sedang disegerakkan dengan pelayan kami, sila tunggu.',
        'accurate' => 'Jam sistem anda adalah tepat.',
        'potentiallyWrong' => 'Jam sistem anda mungkin salah.',
        'value' => 'Perbezaan antara masa tempatan dan masa pelayan ialah :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Terapkan ofset masa pelayan pada pengiraan (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => 'Butiran',
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
      'title' => 'Penghargaan',
      'developedBy' => 'Dibangunkan oleh <1></1>',
      'using' => 'Menggunakan <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Terjemahan oleh <1></1>',
      'openSourceSoftware' => 'Perisian sumber terbuka',
      'viewSourceCode' => 'Lihat kod sumber',
      'notAffiliated' => 'Projek ini tidak berkaitan dengan Discord.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Guna Tema Sistem',
    ],
  ],
  'designEditor' => [
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Eksport sebagai UserStyle',
    'variableColumnHeader' => 'Pembolehubah CSS',
    'valueColumnHeader' => 'Nilai',
  ],
];
