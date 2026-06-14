<?php

return [
  'heading' => 'Analiza wejść na stronę',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'Dane są gromadzone po stronie serwera, na podstawie odpowiedzi wysyłanych do ograniczonej ilości stron. Wyświetlenia stron są odnotowywane indywidualnie, ale agregowane codziennie przez proces w tle.',
  'lastUpdated' => 'Informacje na tej stronie są buforowane przez krótki czas, aby zmniejszyć obciążenie serwera. Widoczne dane zostały ostatnio zaktualizowane <1/>.',
  'charts' => [
    'dailyTotal' => 'Dzienna łączna liczba odsłon',
    'breakdown' => 'Podział wyświetleń strony',
    'byPage' => 'Według stron',
    'byLanguage' => 'Według języka',
  ],
  'values' => [
    'unknown' => 'Nieznane',
  ],
];
