<?php

return [
  'howTo' => 'Odaberite datum, kopirajte željenu vremensku oznaku iz stupca :syntaxColName, zatim je zalijepite bilo gdje u chat poruci. Rezultat će biti dinamična vremenska oznaka koja se prikazuje različito za svakoga na temelju njegove vlastite vremenske zone.',
  'picker' => [
    'label' => [
      'date' => 'Datum',
      'time' => 'Vrijeme',
      'dateAndTime' => 'Datum i vrijeme',
      'timezone' => 'Vremenska zona',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
      'contextRangeLong' => '<0/> – <2/>',
      'contextRangeShort' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Postavite na trenutno vrijeme',
      'lock' => 'Zaključaj vremensku oznaku putem URL-a',
      'unlock' => 'Otključaj vremensku oznaku',
      'previousYear' => 'Previous year',
      'previousMonth' => 'Previous month',
      'previousDecade' => 'Previous decade',
      'nextMonth' => 'Next month',
      'nextYear' => 'Next year',
      'nextDecade' => 'Next decade',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintaksa chata',
    'resultColumn' => 'Primjer rezultata',
  ],
  'usefulLinks' => [
    'lead' => 'Ovo vam također može biti korisno:',
    'server' => [
      'header' => 'Službeni HammerTime server',
      'p' => 'Razgovarajte o web stranici, testirajte sintaksu i predložite značajke',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Generirajte vremenske oznake unutar Discorda koristeći naredbe kose crte',
    ],
    'oldSite' => [
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until this Beta goes live',
    ],
    'textColor' => [
      'header' => 'Rebaneov <1>obojeni</1> generator teksta',
      'p' => 'Jednostavna aplikacija koja stvara Discord poruke u boji koristeći ANSI kodove boja',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "The community hosting weekly challenges for an underrated racing game that inspired the creation of this project",
    ],
  ],
];
