<?php

return [
  'seoDescription' => 'Генератор индикаторов времени в сообщениях Discord',
  'changeLanguage' => 'Выбрать язык',
  "notFound" => [
    "heading" => "Страница не найдена",
    "content" => "Здесь пусто.",
  ],
  'incompleteTranslations' => 'Перевод не завершен',
  'contributeTranslations' => 'Внести свой вклад',
  'copyToClipboard' => 'Copy to clipboard',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'Необходим JavaScript',
    'body' => "Ваш браузер либо не поддерживает JavaScript, либо он отключен. Некоторые браузеры отключают JavaScript по умолчанию по соображениям безопасности, но для данного приложения он необходим. Пожалуйста, включите его и обновите страницу или используйте другой браузер.",
  ],
  'nav' => [
    'botSettings' => 'Настройки приложения',
    'profile' => 'Профиль',
    'legal' => 'Юридическая информация',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Настройки ввода',
      'customInputs' => [
        'label' => 'Пользовательские вводы',
        'description' => "Replaces the browser's default inputs with custom ones that respect your chosen website language",
      ],
      'separateInputs' => [
        'label' => 'Раздельные вводы',
        'description' => "Отображать два разных ввода для даты и времени вместо комбинированного (что не поддерживается в некоторых браузерах)",
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
      'title' => 'Локальные настройки',
    ],
    'credits' => [
      'title' => 'Об авторах',
      'developedBy' => 'Разработал <1></1>',
      'using' => 'Используя <1></1>',
      'fontAwesomeFree' => 'Бесплатную лицензию Font Awesome',
      'laravel' => 'Фреймворк Laravel',
      'vueJs' => 'Библиотеку Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Перевод: <1></1>',
      'openSourceSoftware' => 'Открытое программное обеспечение',
      'viewSourceCode' => 'Исходный код',
      'notAffiliated' => 'Проект не связан с Discord.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
    ],
  ],
  'designEditor' => [
    'title' => 'Редактор дизайна',
    'description' => 'Вы можете изменить внешний вид сайта с помощью переменных, приведенных в таблице ниже. Имена переменных основаны на идентификаторах в коде и поэтому не могут быть переведены. Значения будут сброшены при обновлении страницы.',
    'designPageLink' => 'Страница дизайна',
    'exportInfo' => 'Вы можете экспортировать свои изменения в файл UserStyle, который используется в расширениях, например <1>Stylus</1>, чтобы навсегда изменить внешний вид приложения. Учтите, что эти переменные могут измениться в любой момент, и вам придётся обновлять их вручную.',
    'export' => 'Экспортировать',
    'variableColumnHeader' => 'CSS-переменная',
    'valueColumnHeader' => 'Значение',
  ],
];
