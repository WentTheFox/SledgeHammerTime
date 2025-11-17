<?php

return [
  'seoDescription' => 'डिस्कॉर्ड चैट संदेशों के लिए टाइमस्टैम्प संकेतक उत्पन्न करें।',
  'changeLanguage' => 'भाषा बदलें',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "यहाँ देखने के लिए कुछ नहीं है।",
  ],
  'incompleteTranslations' => 'अनुवाद अधूरे हैं',
  'contributeTranslations' => 'योगदान दें',
  'copyToClipboard' => 'क्लिपबोर्ड पर कॉपी करें',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'जावास्क्रिप्ट आवश्यक है',
    'body' => "आपका ब्राउज़र या तो जावास्क्रिप्ट का समर्थन नहीं करता है या यह वर्तमान में अक्षम है। कुछ ब्राउज़र सुरक्षा कारणों से डिफ़ॉल्ट रूप से जावास्क्रिप्ट को अक्षम कर देते हैं, लेकिन इस एप्लिकेशन के लिए यह आवश्यक है। कृपया इसे सक्षम करें और पृष्ठ को ताज़ा करें, या किसी भिन्न ब्राउज़र का उपयोग करें।",
  ],
  'nav' => [
    'botSettings' => 'ऐप सेटिंग्स',
    'profile' => 'Profile',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'इनपुट सेटिंग',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Use the date input of the project instead of the browser default",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Use the time input of the project instead of the browser default",
      ],
      'separateInputs' => [
        'label' => 'अलग इनपुट',
        'description' => "दिनांक और समय के लिए संयुक्त इनपुट के बजाय दो अलग-अलग इनपुट प्रदर्शित करें (जो कुछ ब्राउज़रों में समर्थित नहीं है)",
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
      'details' => 'विवरण',
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
      'title' => 'क्रेडिटस',
      'developedBy' => 'विकसितकर्ता <1></1>',
      'using' => 'उपयोगिता <1> </1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => '<1></1> द्वारा अनुवाद',
      'openSourceSoftware' => 'खुला स्त्रोत सॉफ़्टवेयर',
      'viewSourceCode' => 'स्रोत कोड देखें',
      'notAffiliated' => 'यह प्रोजेक्ट डिस्कॉर्ड से संबंधित नहीं है',
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
