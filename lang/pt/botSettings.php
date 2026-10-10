<?php

return [
  'title' => 'Configurações do Aplicativo',
  'description' => 'Abaixo você pode ver suas configurações atuais no aplicativo HammerTime para cada conta conectada.',
  'learnMore' => 'Não tem certeza do que é o aplicativo ou está curioso para saber o que ele pode fazer? Visite o link <1>Aplicativo do Discord</1> para saber mais.',
  'advancedSettings' => [
    'toggleText' => 'Configurações avançadas',
  ],
  'defaultOption' => 'Padrão',
  'fields' => [
    'timezone' => [
      'displayName' => 'Fuso Horário',
    ],
    'format' => [
      'displayName' => 'Formato',
    ],
    'formatMinimalReply' => [
      'displayName' => 'Somente a pré-visualização da resposta ao usar a opção de formato',
    ],
    'columns' => [
      'displayName' => 'Colunas',
    ],
    'ephemeral' => [
      'displayName' => 'Efêmero',
    ],
    'header' => [
      'displayName' => 'Cabeçalho',
    ],
    'boldPreview' => [
      'displayName' => 'Formatar visualização como negrito',
    ],
    'defaultAtHour' => [
      'displayName' => 'Opção predefinida «:hourOptionName» para o comando /:atCommandName',
    ],
    'defaultAtMinute' => [
      'displayName' => 'Opção predefinida «:minuteOptionName» para o comando /:atCommandName',
    ],
    'defaultAtSecond' => [
      'displayName' => 'Opção predefinida «:secondOptionName» para o comando /:atCommandName',
    ],
    'telemetry' => [
      'displayName' => 'Permitir a coleta de dados de telemetria',
      'explanation' => 'Isto é totalmente opcional e não afeta a sua capacidade de utilizar o bot. Consulte a página <1/> para obter mais detalhes.',
    ],
    'defaultAt12Hour' => [
      'displayName' => 'Opção predefinida «:hourOptionName» para o comando /:at12CommandName',
    ],
  ],
  'saveSuccess' => 'Suas configurações foram salvas com sucesso',
];
