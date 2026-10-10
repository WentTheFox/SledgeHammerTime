<?php

return [
  'howTo' => 'Escolha uma data, copie o timestamp desejado da coluna :syntaxColName , depois cole-o em qualquer lugar numa mensagem de chat. O resultado será um timestamp dinâmico que exibe de forma diferente para todos, com base no seu próprio fuso horário.',
  'picker' => [
    'label' => [
      'date' => 'Data',
      'time' => 'Tempo',
      'dateAndTime' => 'Data e horário',
      'timezone' => 'Fuso Horário',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Offset absoluto',
      'modeZoneName' => 'Nome da Área',
    ],
    'button' => [
      'jumpToToday' => 'Ir para o mês atual',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Definir para a hora atual',
      'lock' => 'Travar timestamp por URL',
      'unlock' => 'Desbloquear timestamp',
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
    'syntaxColumn' => 'Sintaxe de bate-papo',
    'resultColumn' => 'Resultado do exemplo',
    'editFormats' => 'Personalizar formatos',
    'resetFormats' => 'Redefinir as definições padrão',
    'hideFormat' => 'Ocultar este formato',
    'showFormat' => 'Mostrar este formato',
    'unhideInProfile' => 'Mostrar nas definições do perfil',
  ],
  'faq' => [
    'title' => 'Perguntas mais frequentes',
    'description' => 'Por enquanto, esta secção está disponível apenas em inglês e baseia-se em grande parte no conteúdo do <1>nosso servidor do Discord</1>. Alguns links poderão não funcionar como esperado, a menos que seja membro.',
  ],
  'usefulLinks' => [
    'lead' => 'Você também pode achar úteis esses:',
    'server' => [
      'header' => 'Servidor oficial HammerTime',
      'p' => 'Discuta o site, teste a sintaxe e sugira recursos',
    ],
    'bot' => [
      'header' => 'Aplicação HammerTime',
      'p' => 'Gerar timestamps a partir de dentro do Discord usando comandos slash',
    ],
    'oldSite' => [
      'header' => 'Versão antiga',
      'p' => 'O antigo site do projeto, que continua disponível até nova ordem',
    ],
    'textColor' => [
      'header' => 'Gerador de Texto <1>Colorido</1> de Rebane',
      'p' => 'Uma aplicação simples que cria mensagens Discord coloridas usando códigos de cor ANSI',
    ],
    "subreddit" => [
      "p" => "A comunidade que organiza desafios semanais para um jogo de corridas subestimado que inspirou a criação deste projeto",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Sabia que o HammerTime não é a única ferramenta para gerar carimbos de data e hora?',
        'p2' => 'Talvez queira dar uma vista de olhos nestes outros geradores de carimbos de data e hora para o Discord, para encontrar aquele que melhor se adequa às suas necessidades:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'Um gerador de carimbos de data e hora simples e rápido da 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Gerador de carimbos de data e hora no Discord com linguagem natural, da autoria de dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Gerador gratuito de carimbos de data e hora para o Discord, com suporte ao fuso horário local, da Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Gerador de carimbos de data/hora e conversor de hora para o Discord, da DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Criar carimbos de data e hora no formato Markdown do Discord a partir do ecossistema de ‘bots’ de agendamento Sesh, da Tunks',
      ],
    ],
  ],
];
