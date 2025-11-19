<?php

return [
  'seoDescription' => 'Générez des indicateurs d\'horodatage pour les messages Discord',
  'changeLanguage' => 'Changer la langue',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Il n'y a rien a voir ici.",
  ],
  "maintenanceMode" => [
    "heading" => "Maintenance Mode",
    "content" => [
      'pleaseWait' => "The application is currently being updated, please try again in a few seconds.",
      'joinSupportServer' => "If the issue persists for more than a few minutes, please join the Discord support server and let us know.",
      'contactDeveloper' => "If the issue persists for more than a few minutes, please contact the developer and let them know.",
    ],
    "supportServerButton" => "Support Server",
  ],
  'incompleteTranslations' => 'La traduction est incomplète',
  'contributeTranslations' => 'Contribuer',
  'copyToClipboard' => 'Copier dans le presse papier',
  'copiedToClipboard' => 'Copied to clipboard!',
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
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Saisies séparées',
        'description' => "Afficher deux entrées différentes pour la date et l'heure au lieu d'une entrée combinée (ce qui n'est pas pris en charge par certains navigateurs)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
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
        'label' => 'Apply server time offset to calculations (beta)',
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
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'CSS Variable',
    'valueColumnHeader' => 'Value',
  ],
];
