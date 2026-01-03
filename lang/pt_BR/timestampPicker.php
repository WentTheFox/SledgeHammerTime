<?php

return [
  'howTo' => 'Escolha uma data, copie o timestamp desejado da coluna da :syntaxColName, e cole em qualquer lugar em uma mensagem. O resultado será um timestamp dinâmico que mostra diferentes datas e horários para todos com base no seu próprio fuso horário.',
  'picker' => [
    'label' => [
      'date' => 'Data',
      'time' => 'Horário',
      'dateAndTime' => 'Data e hora',
      'timezone' => 'Fuso horário',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Ir para o mês atual',
      'contextRangeLong' => '<0/> – <2/>',
      'contextRangeShort' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Definir para hora atual',
      'lock' => 'Trancar timestamp via URL',
      'unlock' => 'Destrancar timestamp',
      'previousYear' => 'Ano anterior',
      'previousMonth' => 'Mês anterior',
      'previousDecade' => 'Previous decade',
      'nextMonth' => 'Próximo mês',
      'nextYear' => 'Próximo ano',
      'nextDecade' => 'Next decade',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintaxe do chat',
    'resultColumn' => 'Exemplo do resultado',
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
      'header' => 'HammerTime Old Website',
      'p' => 'O site antigo do projeto, ainda disponível até que este Beta seja lançado',
    ],
    'textColor' => [
      'header' => 'Gerador de Texto <1>Colorido</1> do Rebane',
      'p' => 'Um aplicativo simples que cria mensagens coloridas no Discord usando o código de cores ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "A comunidade apresentando desafios semanais para um jogo de corrida subestimado que inspirou a criação deste projeto",
    ],
  ],
];
