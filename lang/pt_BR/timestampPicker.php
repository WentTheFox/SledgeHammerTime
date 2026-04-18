<?php

return [
  'howTo' => 'Escolha uma data, copie o timestamp desejado da coluna da :syntaxColName, e cole em qualquer lugar em uma mensagem. O resultado será um timestamp dinâmico que mostra diferentes datas e horários para todos com base no seu próprio fuso horário.',
  'picker' => [
    'label' => [
      'date' => 'Data',
      'time' => 'Horário',
      'dateAndTime' => 'Data e hora',
      'timezone' => 'Fuso horário',
      'naturalLanguageInput' => '@time campo',
      'modeOffset' => 'Diferença absoluta',
      'modeZoneName' => 'Nome da Zona',
    ],
    'button' => [
      'jumpToToday' => 'Ir para o mês atual',
      'contextRange' => '<0/>-<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Definir para hora atual',
      'lock' => 'Trancar timestamp via URL',
      'unlock' => 'Destrancar timestamp',
      'previousYear' => 'Ano anterior',
      'previousMonth' => 'Mês anterior',
      'previousDecade' => 'Década anterior',
      'nextMonth' => 'Próximo mês',
      'nextYear' => 'Próximo ano',
      'nextDecade' => 'Próxima década',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Não foi possível analisar a entrada em linguagem natural'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintaxe do chat',
    'resultColumn' => 'Exemplo do resultado',
    'editFormats' => 'Customize formats',
    'resetFormats' => 'Reset to defaults',
    'hideFormat' => 'Hide this format',
    'showFormat' => 'Show this format',
    'unhideInProfile' => 'Unhide in profile settings',
  ],
  'faq' => [
    'title' => 'Frequently Asked Questions',
    'description' => 'This section is English-only for now, and it\'s heavily based on content from <1>our Discord server</1>. Some links might not work as expected unless you are a member.',
  ],
  'usefulLinks' => [
    'lead' => 'Você também pode achar isto útil:',
    'server' => [
      'header' => 'Servidor Oficial do HammerTime',
      'p' => 'Discuta sobre o site, teste a sintaxe e sugira funções',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Gere timestamps dentro do Discord usando slash commands',
    ],
    'oldSite' => [
      'header' => 'Site antigo do "Hammer" "Time"',
      'p' => 'O antigo site do projeto, ainda disponível até segunda ordem',
    ],
    'textColor' => [
      'header' => 'Gerador de Texto <1>Colorido</1> do Rebane',
      'p' => 'Um aplicativo simples que cria mensagens coloridas no Discord usando o código de cores ANSI',
    ],
    "subreddit" => [
      "p" => "A comunidade apresentando desafios semanais para um jogo de corrida subestimado que inspirou a criação deste projeto",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
