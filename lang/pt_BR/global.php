<?php

return [
  'seoDescription' => 'Gere indicadores de timestamp para mensagens do Discord',
  'changeLanguage' => 'Mudar linguagem',
  "notFound" => [
    "heading" => "Página não encontrada",
    "content" => "Nada para ver aqui.",
    "suggestions" => [
      "heading" => "Looking for something?",
      "description" => "Here are some pages that might help:",
      "picker" => "Timestamp Picker",
      "botInfoDescription" => "Information about the Discord app and available commands",
      "discordCta" => "Think something is missing? Join the Discord server and let us know.",
      "discordButton" => "Join the Discord Server",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Modo de Manutenção",
    "content" => [
      'pleaseWait' => "O aplicativo está sendo atualizado. Tente novamente em alguns segundos.",
      'joinSupportServer' => "Se o problema persistir por mais de alguns minutos, por favor entre no servidor do Discord e nos informe.",
      'contactDeveloper' => "Se o problema persistir por mais de alguns minutos, entre em contato com o desenvolvedor e informe-o.",
    ],
    'autoReload' => 'The page will reload automatically <1/>',
    'reloadButton' => 'Reload manually',
    "supportServerButton" => "Servidor de Suporte",
  ],
  'incompleteTranslations' => 'As traduções estão incompletas',
  'contributeTranslations' => 'Contribuir',
  'timezoneBadge' => [
    'currently' => 'Observed currently',
    'atPickedDate' => 'Observed at picked time',
    'currentlyAndAtPickedDate' => 'Observed currently & at picked time',
  ],
  'copyToClipboard' => 'Copiar para a área de transferência',
  'copiedToClipboard' => 'Copiado para a área de transferência!',
  'jsDisabled' => [
    'title' => 'JavaScript é necessário',
    'body' => "Seu navegador ou não suporta JavaScript, ou atualmente está desabilitado. Alguns navegadores desativam o JavaScript por padrão por razões de segurança, mas é necessário para este aplicativo. Ative e atualize a página, ou use um navegador diferente.",
  ],
  'nav' => [
    'botSettings' => 'Configurações do Bot',
    'profile' => 'Perfil',
    'legal' => 'Informações legais',
    'analytics' => 'Analíticas',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Configurações de entrada',
      'naturalLanguageInput' => [
        'label' => '@time Campo de Texto',
        'description' => 'Permite manipular o horário selecionado com linguagem natural (por exemplo, "em 5 horas") através de um campo de texto livre adicional. Semelhante à nova tag @time do Discord. Apenas um número limitado de idiomas é suportado.',
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
        'label' => 'Reduzir Interface',
        'description' => "Desativar os efeitos de sombra e altura em entradas e botões",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Timezone group headers',
        'description' => 'Show sticky group headers (e.g. America, Europe) in the timezone selector dropdown.',
      ],
      'hourCycle' => [
        'label' => 'Formato do relógio',
        'description' => 'Altera a forma como as horas devem ser exibidas no campo de entrada de hora personalizado. Não afeta as pré-visualizações na coluna de resultados de exemplo.',
        'options' => [
          'default' => 'Idioma padrão',
          'h12' => '12 horas',
          'h24' => '24 horas',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'Primeiro dia da semana',
        'description' => 'Altera qual dia deve ser considerado o primeiro dia da semana no calendário de data personalizada.',
        'options' => [
          'default' => 'Linguagem padrão',
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
      'syncButtonLabel' => 'Sincronizar',
      'roundTripDuration' => 'Duração Ida e Volta',
      't0' => 'O timestamp do cliente no pedido de transmissão',
      't1' => 'O timestamp do servidor no pedido de recepção',
      't2' => 'O timestamp do servidor na transmissão de resposta',
      't3' => 'O timestamp do servidor na recepção de resposta',
      'timestampValue' => ':valor s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Deslocamento Detectado (via Rede)',
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
    'title' => 'Editor de Design',
    'description' => 'Você pode ajustar muitos aspectos da aparência do site usando as entradas na tabela abaixo. Os nomes de variáveis são baseados em identificadores no código e, portanto, não podem ser traduzidos. Os valores serão redefinidos quando a página for atualizada.',
    'designPageLink' => 'Página de Design',
    'exportInfo' => 'Você pode exportar suas alterações para um arquivo UserStyle que pode ser usado com uma extensão como <1>Stylus</1> para personalizar a aparência do aplicativo permanentemente. Note, no entanto, que essas variáveis podem mudar a qualquer momento, exigindo que você atualize manualmente seus estilos personalizados.',
    'export' => 'Exportar como UserStyle',
    'variableColumnHeader' => 'Variável CSS',
    'valueColumnHeader' => 'Valor',
  ],
];
