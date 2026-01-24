<?php

return [
  'heading' => 'Analiza wejść na stronę',
  'description' => 'Ta strona zawiera podstawowe dane analityczne (zarówno przechowywane, jak i wyświetlane bez żadnych danych umożliwiających identyfikację użytkownika) dotyczące łącznej liczby odsłon w aplikacji w ciągu ostatnich 30 dni.',
  'collectionMethod' => 'The data is collected on the server side, based on responses sent to a limited set of pages. The page views are recorded individually but aggregated daily by a background process.',
  'lastUpdated' => 'Informacje na tej stronie są buforowane przez krótki czas, aby zmniejszyć obciążenie serwera. Widoczne dane zostały ostatnio zaktualizowane <1/>.',
  'charts' => [
    'dailyTotal' => 'Dzienna łączna liczba odsłon',
    'breakdown' => 'Page Views Breakdown',
    'byPage' => 'Według stron',
    'byLanguage' => 'Według języka',
    'hideUnknown' => 'Ukryj nieznane wartości',
  ],
  'values' => [
    'unknown' => 'Nieznane',
  ],
];
