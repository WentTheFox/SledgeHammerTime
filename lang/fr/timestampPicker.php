<?php

return [
  'howTo' => 'Choisissez une date, copiez l\'horodatage désiré de la colonne :syntaxColName puis collez-le où vous le souhaitez dans votre message. Le résultat sera un horodatage dynamique qui s\'affichera différemment pour les gens suivant leur fuseau horaire.',
  'picker' => [
    'label' => [
      'date' => 'Date',
      'time' => 'Heure',
      'dateAndTime' => 'Date et heure',
      'timezone' => 'Fuseau horaire',
      'naturalLanguageInput' => 'Champ @time',
      'modeOffset' => 'Décalage absolu',
      'modeZoneName' => 'Nom du fuseau horaire',
    ],
    'button' => [
      'jumpToToday' => 'Aller au mois en cours',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Régler a l\'heure actuelle',
      'lock' => 'Bloquer l\'horodatage via l\'URL',
      'unlock' => 'Débloquer l\'horodatage',
      'previousYear' => 'Année précédente',
      'previousMonth' => 'Mois précédent',
      'previousDecade' => 'Décennie précédente',
      'nextMonth' => 'Mois suivant',
      'nextYear' => 'Année suivante',
      'nextDecade' => 'Décennie suivante',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Impossible d\'analyser les données en langage naturel'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Syntaxe du chat',
    'resultColumn' => 'Exemple du résultat',
  ],
  'usefulLinks' => [
    'lead' => 'Cela pourrait vous être utile :',
    'server' => [
      'header' => 'Le serveur officiel de HammerTime',
      'p' => 'Discutez du site, testez la syntaxe et suggérez de nouvelles fonctionnalités',
    ],
    'bot' => [
      'header' => 'App HammerTime',
      'p' => 'Générer des horodatages à l\'aide de commandes slash depuis Discord',
    ],
    'oldSite' => [
      'header' => 'Ancien site web de HammerTime',
      'p' => 'L\'ancien site du projet, toujours accessible sauf changement',
    ],
    'textColor' => [
      'header' => 'Le générateur de texte <1>coloré</1> de Rebane',
      'p' => 'Une app simple qui crée des messages Discord colorés grâce aux codes couleur ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "La communauté organisant des défis hebdomadaires pour un jeu de course méconnu qui a inspiré la création de ce projet",
    ],
  ],
];
