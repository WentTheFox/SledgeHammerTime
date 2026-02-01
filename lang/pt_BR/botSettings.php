<?php

return [
  'title' => 'Configurações do Bot',
  'description' => 'Abaixo você consegue ver suas as configurações atuais do HammerTime App para cada conta conectada.',
  'learnMore' => 'Não sabe para que serve o aplicativo ou está curioso para saber o que ele faz? Acesse o link disponível no nosso  <1>Discord</1>  para saber mais.',
  'advancedSettings' => [
    'toggleText' => 'Configurações avançadas',
  ],
  'defaultOption' => 'Padrão',
  'fields' => [
    'timezone' => [
      'displayName' => 'Fuso horário',
    ],
    'format' => [
      'displayName' => 'Formatar',
    ],
    'formatMinimalReply' => [
      'displayName' => 'Ao utilizar opções de formatação resposta será exibida somente como pré-visualização.',
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
      'displayName' => 'Formatar pré-visualização em negrito',
    ],
    'defaultAtHour' => [
      'displayName' => 'Default ":hourOptionName" option for /:atCommandName command',
    ],
    'defaultAtMinute' => [
      'displayName' => 'Default ":minuteOptionName" option for /:atCommandName command',
    ],
    'defaultAtSecond' => [
      'displayName' => 'Default ":secondOptionName" option for /:atCommandName command',
    ],
    'telemetry' => [
      'displayName' => 'Permitir coleta de dados de Telemetria.',
      'explanation' => 'Isso é totalmente opcional e não tem nenhum efeito na capacidade de usar o "bot". Veja a página <1/> para informações.',
    ],
    'defaultAt12Hour' => [
      'displayName' => 'Default ":hourOptionName" option for /:at12CommandName command',
    ],
  ],
  'saveSuccess' => 'Suas configurações foram salvas com sucesso.',
];
