<?php

return [
  'heading' => 'Análise de visualizações de páginas',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'Os dados são recolhidos do lado do servidor, com base nas respostas enviadas a um conjunto limitado de páginas. As visualizações de páginas são registadas individualmente, mas agregadas diariamente por um processo em segundo plano.',
  'lastUpdated' => 'A informação nesta página é armazenada em cache durante um curto período de tempo, a fim de reduzir a carga do servidor. Os dados que vê foram atualizados pela última vez em <1/>.',
  'charts' => [
    'dailyTotal' => 'Total diário de visualizações de páginas',
    'breakdown' => 'Page Views Breakdown',
    'byPage' => 'Por páginas',
    'byLanguage' => 'Por idioma',
  ],
  'values' => [
    'unknown' => 'Desconhecido',
  ],
];
