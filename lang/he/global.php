<?php

return [
  'seoDescription' => 'צרו timestamps בשביל צ\'אטים בדיסקורד',
  'changeLanguage' => 'החליפו שפה',
  "notFound" => [
    "heading" => "הדף לא נמצא",
    "content" => "אין שום דברים לראות פה.",
    "suggestions" => [
      "heading" => "חיפשתם משהו?",
      "description" => "הנה כמה עמודים שאולי יעזרו:",
      "picker" => "בוחר חותמת זמן",
      "botInfoDescription" => "מידע לגבי אפליקציית Discord ועל הפקודות הזמינות",
      "discordCta" => "נראה לכם שמשהו חסר? הצטרפו לשרת ה-Discord והודיעו לנו.",
      "discordButton" => "הצטרפו לשרת ה-Discord",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "מצב תחזוקה",
    "content" => [
      'pleaseWait' => "האפליקציה נמצא כרגע בתהליך עדכון, אנא נסה שוב בעוד מספר שניות.",
      'joinSupportServer' => "אם הבעיה נמשכת יותר מכמה דקות, אנא הצטרפו לשרת התמיכה ב-Discord והודיעו לנו על כך.",
      'contactDeveloper' => "אם הבעיה נמשכת יותר מכמה דקות, אנא פנו למפתח והודיעו לו על כך.",
    ],
    'autoReload' => 'הדף יטען מחדש באופן אוטומטי <1/>',
    'reloadButton' => 'טען מחדש באופן ידני',
    "supportServerButton" => "שרת תמיכה",
    "contactDeveloperButton" => "צור קשר עם המפתח",
  ],
  'incompleteTranslations' => 'התרגומים לא מלאים',
  'contributeTranslations' => 'עזור בתרגום',
  'timezoneBadge' => [
    'currently' => 'Observed currently',
    'atPickedDate' => 'Observed at picked time',
    'currentlyAndAtPickedDate' => 'Observed currently & at picked time',
  ],
  'copyToClipboard' => 'העתיקו ללוח',
  'copiedToClipboard' => 'הועתק ללוח!',
  'jsDisabled' => [
    'title' => 'ג\'אווהסקריפט נדרש כאן',
    'body' => "הדפדפן שלכם ככל הנראה לא תומך בג'אווהסקריפט או שהוא חוסם אותו. כמה מהדפדפנים באופן אוטומטי חוסמים ג'אווהסקריפט מטעמי אבטחה, אבל זה חשוב בשביל האתר הזה. בבקשה הפעילו את הג'אווהסקריפט ותרעננו את הדף הזה, או שתחליפו את הדפדפן שלכם באחד אחר שכן תומך.",
  ],
  'nav' => [
    'botSettings' => 'הגדרות אפליקציה',
    'profile' => 'פרופיל',
    'legal' => 'מידע משפטי',
    'analytics' => 'ניתוח',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'הגדרות הקלט',
      'naturalLanguageInput' => [
        'label' => 'שדה הזנת @time',
        'description' => 'אפשר לשנות את חותמת הזמן שנבחרה באמצעות שפה טבעית (למשל; "בעוד 5 שעות") באמצעות שדה הזנת טקסט חופשי נוסף. בדומה לתגית @time החדשה ב-Discord. נתמכות רק מספר מצומצם של שפות.',
      ],
      'customDateInput' => [
        'label' => 'הזנת תאריך מותאם אישית',
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
      'timezoneStickyHeaders' => [
        'label' => 'Timezone group headers',
        'description' => 'Show sticky group headers (e.g. America, Europe) in the timezone selector dropdown.',
      ],
      'hourCycle' => [
        'label' => 'Time format',
        'description' => 'Change how time is displayed across the app, including the custom time input and previews.',
        'options' => [
          'default' => 'Language default',
          'h12' => '12-hour',
          'h24' => '24-hour',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'First day of the week',
        'description' => 'Change which day should be considered the first day of the week in the calendar of the custom date input.',
        'options' => [
          'default' => 'Language default',
        ],
      ],
      'advancedSettings' => 'Advanced input settings',
    ],
    'timeSync' => [
      'title' => 'Time Synchronization',
      'status' => [
        'syncing' => 'השעון שלך מתחיל סנכרון עם השרת שלנו, נא לחכות.',
        'accurate' => 'שעות המערכת שלך הוא נכון.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'ההבדל בין הזמן של השרת ושלך הוא :offset.',
      ],
      'details' => 'פרטים',
      'syncButtonLabel' => 'Synchronize',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
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
