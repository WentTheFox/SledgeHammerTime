<?php

return [
  'seoDescription' => 'Genera marcas de tiempo para mensajes de chat de Discord',
  'changeLanguage' => 'Cambiar Idioma',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "No hay resultados para mostrar.",
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
  'incompleteTranslations' => 'Las traducciones están incompletas',
  'contributeTranslations' => 'Contribuye',
  'copyToClipboard' => 'Copiar al portapapeles',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript es necesario',
    'body' => "Su navegador no soporta JavaScript o está actualmente deshabilitado. Algunos navegadores deshabilitan JavaScript por defecto por razones de seguridad, pero es necesario para esta aplicación. Por favor, actívelo y actualice la página o utilice un navegador diferente.",
  ],
  'nav' => [
    'botSettings' => 'Ajustes de aplicación',
    'profile' => 'Perfil',
    'legal' => 'Legal Information',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Ajustes de entrada',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Entradas separadas',
        'description' => "Muestra dos entradas diferentes para la fecha y la hora en lugar de una combinada (que no es compatible con algunos navegadores)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
    ],
    'timeSync' => [
      'title' => 'Sincronización de hora',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'El reloj del sistema es preciso.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'The difference between the local and server time is :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Apply server time offset to calculations (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => 'Detalles',
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
      'title' => 'Créditos',
      'developedBy' => 'Desarrollado por <1></1>',
      'using' => 'Utilizando <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Traducciones por <1></1>',
      'openSourceSoftware' => 'Software de código abierto',
      'viewSourceCode' => 'Ver código fuente',
      'notAffiliated' => 'Este proyecto no está afiliado con Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tema oscuro',
      'light' => 'Tema claro',
      'system' => 'Usar tema del sistema',
    ],
  ],
  'designEditor' => [
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'CSS Variable',
    'valueColumnHeader' => 'Valor',
  ],
];
