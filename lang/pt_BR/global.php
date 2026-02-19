<?php

return [
  'seoDescription' => 'Gere indicadores de timestamp para mensagens do Discord',
  'changeLanguage' => 'Mudar linguagem',
  "notFound" => [
    "heading" => "Página não encontrada",
    "content" => "Nada para ver aqui.",
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
  'incompleteTranslations' => 'As traduções estão incompletas',
  'contributeTranslations' => 'Contribuir',
  'copyToClipboard' => 'Copiar para a área de transferência',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript é necessário',
    'body' => "Seu navegador ou não suporta JavaScript, ou atualmente está desabilitado. Alguns navegadores desativam o JavaScript por padrão por razões de segurança, mas é necessário para este aplicativo. Ative e atualize a página, ou use um navegador diferente.",
  ],
  'nav' => [
    'botSettings' => 'Configurações do Bot',
    'profile' => 'Perfil',
    'legal' => 'Informações legais',
    'analytics' => 'Analytics',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Configurações de entrada',
      'naturalLanguageInput' => [
        'label' => '@time input field',
        'description' => 'Allow manipulating the selected timestamp with natural language (e.g. “in 5 hours”) via an additional free-text input. Similar to the new Discord @time tag. Only a limited number of languages are supported.',
      ],
      'customDateInput' => [
        'label' => 'Entrada de data personalizada',
        'description' => "Substitui a entrada de data padrão do navegador por uma personalizada.",
      ],
      'customTimeInput' => [
        'label' => 'Entrada de hora personalizada',
        'description' => "Substitua a entrada de hora padrão do navegador por uma personalizada. Isso é especialmente útil se o senhor tiver problemas para selecionar a hora em navegadores móveis.",
      ],
      'separateInputs' => [
        'label' => 'Entradas separadas',
        'description' => "Exibir duas entradas diferentes para data e horário em vez de uma combinação (que não é suportada em alguns navegadores)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
      'hourCycle' => [
        'label' => 'Formato do relógio',
        'description' => 'Change how hours should be displayed in the custom time input. Has no effect on the previews in the example results column.',
        'options' => [
          'default' => 'Idioma padrão',
          'h12' => '12 horas',
          'h24' => '24 horas',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'First day of the week',
        'description' => 'Change which day should be considered the first day of the week in the calendar of the custom date input.',
        'options' => [
          'default' => 'Language default',
        ],
      ],
      'advancedSettings' => 'Configurações avançadas de entrada',
    ],
    'timeSync' => [
      'title' => 'Sincronizar Hora',
      'status' => [
        'syncing' => 'O seu relógio do sistema atualmente está sincronizando com nossos servidores, por favor aguarde.',
        'accurate' => 'O relógio do sistema está atualizado.',
        'potentiallyWrong' => 'O relógio do seu sistema pode estar errado.',
        'value' => 'A diferença entre o horário local e do servidor é:',
      ],
      'details' => 'Detalhes',
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
      'title' => 'Configurações Locais',
    ],
    'credits' => [
      'title' => 'Créditos',
      'developedBy' => 'Desenvolvido por <1></1>',
      'using' => 'Usando <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => '"Laravel"',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'crono',
      'translatedBy' => 'Traduções por <1></1>',
      'openSourceSoftware' => 'Software de código aberto',
      'viewSourceCode' => 'Ver código fonte',
      'notAffiliated' => 'Esse projeto não é filiado ao Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tema Escuro',
      'light' => 'Tema Claro',
      'system' => 'Usar Tema do Sistema',
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
