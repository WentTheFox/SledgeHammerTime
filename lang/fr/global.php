<?php

return [
  'seoDescription' => 'Générez des indicateurs d\'horodatage pour les messages Discord',
  'changeLanguage' => 'Changer la langue',
  "notFound" => [
    "heading" => "Page non trouvée",
    "content" => "Il n'y a rien a voir ici.",
  ],
  "maintenanceMode" => [
    "heading" => "Mode Maintenance",
    "content" => [
      'pleaseWait' => "L'application est en cours de mise à jour, merci de réessayer dans quelques secondes.",
      'joinSupportServer' => "Si le problème persiste plus de quelques minutes, merci de rejoindre le serveur Discord de support et nous en informer.",
      'contactDeveloper' => "Si le problème persiste plus de quelques minutes, merci de contacter le développeur pour lui en informer.",
    ],
    "supportServerButton" => "Serveur de Support",
  ],
  'incompleteTranslations' => 'La traduction est incomplète',
  'contributeTranslations' => 'Contribuer',
  'copyToClipboard' => 'Copier dans le presse papier',
  'copiedToClipboard' => 'Copié dans le presse-papiers !',
  'jsDisabled' => [
    'title' => 'JavaScript est nécessaire',
    'body' => "Votre navigateur ne prend pas en charge JavaScript ou il est actuellement désactivé. Certains navigateurs désactivent JavaScript par défaut pour des raisons de sécurité, mais il est nécessaire pour cette application. Veuillez l'activer et rafraîchir la page, ou utiliser un autre navigateur.",
  ],
  'nav' => [
    'botSettings' => 'Paramètre de l\'application',
    'profile' => 'Profil',
    'legal' => 'Mentions légales',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Paramètres d\'entrée',
      'customDateInput' => [
        'label' => 'Saisie de la date personnalisée',
        'description' => "Remplacer l'entrée de la date par défaut du navigateur par une personnalisée.",
      ],
      'customTimeInput' => [
        'label' => 'Saisie du temps personnalisée',
        'description' => "Remplacer l'entrée du temps par défaut du navigateur par une personnalisée. Cela est particulièrement utile si vous avez du mal à sélectionner le temps sur les navigateurs sur téléphone.",
      ],
      'separateInputs' => [
        'label' => 'Saisies séparées',
        'description' => "Afficher deux entrées différentes pour la date et l'heure au lieu d'une entrée combinée (ce qui n'est pas pris en charge par certains navigateurs)",
      ],
      'flatUi' => [
        'label' => 'Interface aplanie',
        'description' => "Désactiver les effets d'ombre et de hauteur sur les entrées et les boutons",
      ],
    ],
    'timeSync' => [
      'title' => 'Synchronisation de l\'Heure',
      'status' => [
        'syncing' => 'L\'horloge de votre système est en cours de synchronisation avec nos serveurs, veuillez patienter.',
        'accurate' => 'Votre horloge système est exacte.',
        'potentiallyWrong' => 'L\'horloge de votre système est peut-être erronée.',
        'value' => 'La différence entre l\'heure locale et l\'heure du serveur est de :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Appliquer le décalage horaire du serveur aux calculs (bêta)',
        'description' => 'Si votre horloge système est décalée de plus de :offset par rapport à l\'heure du serveur (sans tenir compte des différences de fuseau horaire), certains calculs de l\'heure seront ajustés pour en tenir compte, de sorte que vos horodatages seront moins susceptibles d\'être incorrects. <1>Il s\'agit d\'une fonctionnalité expérimentale, à utiliser avec précaution !</1> La synchronisation a lieu lorsque la page est chargée pour la première fois et immédiatement après l\'activation du paramètre.',
      ],
      'details' => 'Détails',
      'autoApplyCheckbox' => 'Appliquer le décalage calculé à la bibliothèque DateTime lorsque vous appuyez manuellement sur :syncButtonLabel (ne s\'applique que si la différence est supérieure au seuil :offset)',
      'syncButtonLabel' => 'Synchroniser',
      'resetOffsetButtonLabel' => 'Réinitialiser le décalage appliqué',
      'roundTripDuration' => 'Durée de l\'aller-retour',
      't0' => 'Horodatage du client de la transmission de la requête',
      't1' => 'Horodatage du serveur de la réception de la requête',
      't2' => 'Horodatage de la réception de la réponse (server)',
      't3' => 'Horodatage de la réception de la réponse (client)',
      'dtlOffsetCell' => 'Décalage du calcul actif',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Décalage détecté (via le réseau)',
    ],
    'localSettings' => [
      'title' => 'Paramètres Locaux',
    ],
    'credits' => [
      'title' => 'Crédits',
      'developedBy' => 'Développeur <1></1>',
      'using' => 'Avec <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Traduit par <1></1>',
      'openSourceSoftware' => 'Logiciel open-source',
      'viewSourceCode' => 'Voir le code source',
      'notAffiliated' => 'Ce projet n\'est pas affilié avec Discord.',
    ],
    'themeButton' => [
      'dark' => 'Thème Sombre',
      'light' => 'Thème Clair',
      'system' => 'Utiliser le thème du système',
    ],
  ],
  'designEditor' => [
    'title' => 'Éditeur de design',
    'description' => 'Vous pouvez ajuster de nombreux aspects de l\'apparence du site en utilisant le tableau ci-dessous. Les noms de variables sont basés sur les identifiants du code et ne peuvent donc pas être traduits. Les valeurs seront réinitialisées en rafraichissant la page.',
    'designPageLink' => 'Page de design',
    'exportInfo' => 'Vous pouvez exporter vos modifications vers un fichier UserStyle, qui peut être utilisé avec une extension comme <1>Stylus</1> pour modifier l\'apparence du site de façon permanente. Notez que ces variables peuvent changer à tout moment. Vous devrez alors mettre à jour manuellement vos styles personnalisés.',
    'export' => 'Exporter en tant que UserStyle',
    'variableColumnHeader' => 'Variable CSS',
    'valueColumnHeader' => 'Valeur',
  ],
];
