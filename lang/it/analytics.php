<?php

return [
  'heading' => 'Analisi Visualizzazioni Pagina',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'I dati vengono raccolti lato server, in base alle risposte inviate a un insieme limitato di pagine. Le visualizzazioni delle pagine vengono registrate individualmente, ma aggregate quotidianamente da un processo in background.',
  'lastUpdated' => 'Le informazioni di questa pagina vengono memorizzate nella cache per un breve periodo per ridurre il carico del server. I dati che vedi sono stati aggiornati l\'ultima volta <1/>.',
  'charts' => [
    'dailyTotal' => 'Visualizzazioni Pagina Totali Giornaliere',
    'breakdown' => 'Ripartizione Visualizzazioni Pagina',
    'byPage' => 'Per Pagine',
    'byLanguage' => 'Per Lingua',
  ],
  'values' => [
    'unknown' => 'Sconosciuto',
  ],
];
