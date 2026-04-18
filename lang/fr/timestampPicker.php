<?php

return [
  'howTo' => 'Choisissez une date, copiez l\'horodatage désiré de la colonne :syntaxColName puis collez-le où vous le souhaitez dans votre message. Le résultat sera un horodatage dynamique qui s\'affichera différemment pour les gens suivant leur fuseau horaire.',
  'picker' => [
    'label' => [
      'date' => 'Date',
      'time' => 'Heure',
      'dateAndTime' => 'Date et heure',
      'timezone' => 'Fuseau horaire',
      'naturalLanguageInput' => 'Saisie @time',
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
    'editFormats' => 'Personnaliser les formats',
    'resetFormats' => 'Rétablir les valeurs par défaut',
    'hideFormat' => 'Masquer ce format',
    'showFormat' => 'Afficher ce format',
    'unhideInProfile' => 'Démasquer dans les paramètres du profil',
  ],
  'faq' => [
    'title' => 'Foire aux questions',
    'description' => 'Cette section est exclusivement en anglais pour le moment, et elle est fortement basée sur le contenu de <1>notre serveur Discord</1>. Certains liens peuvent ne pas fonctionner correctement si vous n\'êtes pas membre.',
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
      "p" => "La communauté organisant des défis hebdomadaires pour un jeu de course méconnu qui a inspiré la création de ce projet",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
