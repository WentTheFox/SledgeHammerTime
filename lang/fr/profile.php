<?php

return [
  'title' => 'Profil',
  'intro' => 'La page de profil vous permet de gérer les informations de votre compte spécifiquement liées au site web. Si vous souhaitez modifier les paramètres par défaut et d\'autres paramètres de l\'application Discord, consultez la page <1>Paramètres de l\'application</1>.',
  'information' => [
    'heading' => 'Information du profil',
    'description' => "Mettre à jour les informations de profil de votre compte.",
    'displayName' => 'Nom d\'affichage',
    'hiddenFormats' => 'Formats masqués dans la table de sélection',
    'saveSuccess' => 'Votre profil a été mis à jour avec succès.',
  ],
  'accounts' => [
    'heading' => 'Comptes connectés',
    'description' => [
      'Un compte HammerTime vous permettra de relier plusieurs comptes Discord afin de pouvoir gérer leurs ressources en un seul endroit à l\'avenir.',
      'Vous trouverez ci-dessous une liste de tous les comptes Discord associés à ce compte HammerTime.',
    ],
    'discord' => 'Comptes Discord',
    'crowdin' => 'Comptes Crowdin',
    'noConnectedAccounts' => 'Vous n\'avez pas de comptes connectés pour le moment',
    'linkAdditional' => [
      'heading' => 'Lier ou mettre à jour un compte',
      'description' => 'En liant plusieurs comptes à un seul compte HammerTime, vous pouvez gérer les paramètres de tous les comptes liés au même endroit.',
      'discord' => [
        'description' => 'Si votre image de profil ou votre nom d\'affichage ont changé, vous pouvez aussi utiliser ceci pour mettre à jour ces informations pour tout compte Discord déjà lié.',
        'authorize' => 'Autoriser le compte Discord',
      ],
      'crowdin' => [
        'description' => 'Si vous êtes un traducteur pour le projet, lier votre compte Crowdin vous permettra éventuellement de personnaliser l\'affichage de votre nom dans les crédits de traduction, et sert également de niveau supplémentaire de vérification que ces comptes vous appartiennent si vous rejoignez le serveur Discord du projet.',
        'authorize' => 'Lier le compte Crowdin',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Suppression de compte',
    'description' => 'Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.',
    'deleteButton' => 'Supprimer le compte',
    'confirmDialog' => [
      'header' => 'Êtes-vous sûr de vouloir supprimer votre compte ?',
      'body' => 'Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.',
    ],
  ],
];
