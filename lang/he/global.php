<?php

return [
  'seoDescription' => 'צרו timestamps בשביל צ\'אטים בדיסקורד',
  'changeLanguage' => 'החליפו שפה',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "אין שום דברים לראות פה.",
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
  'incompleteTranslations' => 'התרגומים לא מלאים',
  'contributeTranslations' => 'עזור בתרגום',
  'copyToClipboard' => 'העתיקו ללוח',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'ג\'אווהסקריפט נדרש כאן',
    'body' => "הדפדפן שלכם ככל הנראה לא תומך בג'אווהסקריפט או שהוא חוסם אותו. כמה מהדפדפנים באופן אוטומטי חוסמים ג'אווהסקריפט מטעמי אבטחה, אבל זה חשוב בשביל האתר הזה. בבקשה הפעילו את הג'אווהסקריפט ותרעננו את הדף הזה, או שתחליפו את הדפדפן שלכם באחד אחר שכן תומך.",
  ],
  'nav' => [
    'botSettings' => 'הגדרות אפליקציה',
    'profile' => 'Profile',
    'legal' => 'מידע משפטי',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'הגדרות הקלט',
      'naturalLanguageInput' => [
        'label' => '@time input field',
        'description' => 'Allow manipulating the selected timestamp with natural language (e.g. “in 5 hours”) via an additional free-text input. Similar to the new Discord @time tag. Only a limited number of languages are supported.',
      ],
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'קלט נפרד',
        'description' => "הצגה של שני קלטים שונים של תאריך וזמן במקום שילוב של שניהם (אפשרות שלא נתמכת בכמה מהדפדפנים)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
    ],
    'timeSync' => [
      'title' => 'Time Synchronization',
      'status' => [
        'syncing' => 'השעון שלך מתחיל סנכרון עם השרת שלנו, נא לחכות.',
        'accurate' => 'שעות המערכת שלך הוא נכון.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'ההבדל בין הזמן של השרת ושלך הוא :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Apply server time offset to calculations (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => 'פרטים',
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
      'title' => 'קרדיטים',
      'developedBy' => 'פותח על ידי <1></1>',
      'using' => 'משתמש ב: <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'תורגם על ידי: <1></1>',
      'openSourceSoftware' => 'תוכנת קוד-פתוח',
      'viewSourceCode' => 'צפו בקוד האתר',
      'notAffiliated' => 'הפרויקט הזה הוא לא בשיתוף עם דיסקורד.',
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
