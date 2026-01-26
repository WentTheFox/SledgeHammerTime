<?php

return [
  'heading' => 'Análisis de Vista de Página',
  'description' => 'Esta página contiene analíticas básicas (almacenadas y mostradas sin ningún dato personal identificable) para el total agregado de vistas a la página agregadas en la aplicación durante los últimos 30 días.',
  'collectionMethod' => 'Los datos se recopilan en el lado del servidor, basándose en las respuestas enviadas a un conjunto limitado de páginas. Las vistas de las páginas se registran individualmente, pero se agregan diariamente por un proceso en segundo plano.',
  'lastUpdated' => 'La información en esta página se almacena en caché durante un corto período de tiempo para reducir la carga del servidor. Los datos que ves fueron actualizados por última vez <1/>.',
  'charts' => [
    'dailyTotal' => 'Total de páginas vistas diariamente',
    'breakdown' => 'Desglose de vistas a la página',
    'byPage' => 'Por Páginas',
    'byLanguage' => 'Por Idioma',
  ],
  'values' => [
    'unknown' => 'Desconocido',
  ],
];
