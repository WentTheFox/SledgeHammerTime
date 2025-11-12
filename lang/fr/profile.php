<?php

return [
  'title' => 'Profil',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Information du profil',
    'description' => "Mettre à jour les informations de profil de votre compte.",
    'displayName' => 'Nom d\'affichage',
    'saveSuccess' => 'Votre profil a été mis à jour avec succès.',
  ],
  'accounts' => [
    'heading' => 'Comptes connectés',
    'description' => [
      'Un compte HammerTime vous permettra de relier plusieurs comptes Discord afin de pouvoir gérer leurs ressources en un seul endroit à l\'avenir.',
      'Vous trouverez ci-dessous une liste de tous les comptes Discord associés à ce compte HammerTime.',
    ],
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'Vous n\'avez pas de comptes connectés pour le moment',
    'linkAdditional' => [
      'heading' => 'Lier ou mettre à jour un compte',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => 'Autoriser le compte Discord',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account will eventually let you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Authorize Crowdin account',
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
