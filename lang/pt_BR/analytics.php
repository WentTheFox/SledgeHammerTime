<?php

return [
  'heading' => 'Visualizar Estatísticas',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'Os dados são coletados no servidor, baseando-se em respostas enviadas para uma quantia limitada de páginas. O número de visualizações é gravado individualmente, mas reunido diariamente por processos em segundo plano.',
  'lastUpdated' => 'As informações nessa página são armazenadas em memória transitória por um curto período para reduzir a carga do servidor. Os dados visualizados foram atualizados pela última vez<1/>.',
  'charts' => [
    'dailyTotal' => 'Visualizações Diárias Totais',
    'breakdown' => 'Detalhes de Visualizações da Página',
    'byPage' => 'Por páginas',
    'byLanguage' => 'Por idioma',
  ],
  'values' => [
    'unknown' => 'Desconhecido',
  ],
];
