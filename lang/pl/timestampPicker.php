<?php

return [
  'howTo' => 'Wybierz datę, skopiuj wybrany znacznik czasu z kolumny :syntaxColName, a następnie wklej go w dowolnym miejscu w wiadomości. Rezultatem będzie dynamiczny znacznik czasu, który będzie wyświetlany inaczej dla każdego, w zależności od jego własnej strefy czasowej.',
  'picker' => [
    'label' => [
      'date' => 'Data',
      'time' => 'Czas',
      'dateAndTime' => 'Data i czas',
      'timezone' => 'Strefa czasowa',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Przesunięcie bezwzględne',
      'modeZoneName' => 'Nazwa strefy',
    ],
    'button' => [
      'jumpToToday' => 'Przejdź do bieżącego miesiąca',
      'contextRange' => '<0/>-<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Ustaw bieżący czas',
      'lock' => 'Zablokuj znacznik czasu przez adres URL',
      'unlock' => 'Odblokuj znacznik czasu',
      'previousYear' => 'Poprzedni rok',
      'previousMonth' => 'Poprzedni miesiąc',
      'previousDecade' => 'Poprzednia dekada',
      'nextMonth' => 'Następny miesiąc',
      'nextYear' => 'Następny rok',
      'nextDecade' => 'Następna dekada',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Nie można przetworzyć danych języka naturalnego'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Składnia',
    'resultColumn' => 'Przykładowy wynik',
    'editFormats' => 'Dostosuj formaty',
    'resetFormats' => 'Przywróć domyślne',
    'hideFormat' => 'Ukryj ten format',
    'showFormat' => 'Pokaż ten format',
    'unhideInProfile' => 'Odkryj w ustawieniach profilu',
  ],
  'faq' => [
    'title' => 'Frequently Asked Questions',
    'description' => 'This section is English-only for now, and it\'s heavily based on content from <1>our Discord server</1>. Some links might not work as expected unless you are a member.',
  ],
  'usefulLinks' => [
    'lead' => 'Możesz również uznać to za przydatne:',
    'server' => [
      'header' => 'Oficjalny serwer HammerTime',
      'p' => 'Dyskutuj na temat strony, testuj składnię i proponuj nowe funkcje',
    ],
    'bot' => [
      'header' => 'Aplikacja HammerTime',
      'p' => 'Generuj znaczniki czasu z poziomu Discorda za pomocą poleceń typu slash',
    ],
    'oldSite' => [
      'header' => 'Stara strona HammerTime',
      'p' => 'Stara strona internetowa projektu, nadal dostępna do odwołania',
    ],
    'textColor' => [
      'header' => 'Generator <1>Kolorowego</1> Tekstu Rebane\'a',
      'p' => 'Prosta aplikacja do tworzenia kolorowych wiadomości na Discord przy użyciu kodów kolorów ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "Społeczność organizująca cotygodniowe wyzwania dla niedocenianej gry wyścigowej, która zainspirowała powstanie tego projektu",
    ],
  ],
];
