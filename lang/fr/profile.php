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
    'description' => 'Vous pouvez associer plusieurs comptes à votre compte HammerTime afin de pouvoir les gérer au même endroit. Les informations utilisateur basiques affichées ici sont mises à jour automatiquement, au maximum une fois par heure, lorsque vous chargez cette page.',
    'discord' => 'Comptes Discord',
    'crowdin' => 'Comptes Crowdin',
    'noConnectedAccounts' => 'Vous n\'avez pas de comptes connectés pour le moment',
    'linkAdditional' => [
      'heading' => 'Associer d\'autres comptes',
      'description' => 'Utilisez les boutons ci-dessous pour connecter d\'autres comptes à votre compte HammerTime actuel.',
      'discord' => [
        'description' => 'Si votre image de profil ou votre nom d\'affichage ont changé, vous pouvez aussi utiliser ceci pour mettre à jour ces informations pour tout compte Discord déjà lié.',
        'authorize' => 'Autoriser le compte Discord',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account lets you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Lier le compte Crowdin',
      ],
    ],
  ],
  'creditOverrides' => [
    'heading' => 'Translation Credits',
    'description' => 'Customize how you appear in the translation credits for each language where you are a contributor.',
    'displayName' => 'Display Name',
    'avatarProvider' => 'Avatar',
    'avatarProviders' => [
        'discord' => 'Discord',
        'gravatar' => 'Gravatar',
        'crowdin' => 'Crowdin',
    ],
    'gravatarEmail' => 'Email address',
    'gravatarDescription' => '<1>Gravatar</1> allows you to use a single avatar across multiple websites that support it. Your e-mail address will be saved as an MD5 hash.',
    'avatarAccount' => 'Account',
    'url' => 'Link',
    'visibility' => 'Visibility',
    'submit' => 'Submit for approval',
    'saveSuccess' => 'Submitted for approval',
    'saveHideSuccess' => 'Visibility updated',
    'cancel' => 'Cancel changes',
    'statusPrefix' => 'Status',
    'status' => [
      'approved' => 'Approved',
      'inReview' => 'In review',
      'rejected' => 'Rejected',
    ],
    'currentlyApproved' => 'Currently approved values',
    'reApprovalWarning' => 'Changing anything besides visibility will require a manual review. You can cancel the review request at any time from this page.',
    'deleteOverride' => 'Remove override',
    'deleteOverrideConfirm' => 'Are you sure you want to remove your translation credit override? Your entry will revert to the default information from Crowdin.',
    'approvedValues' => [
      'displayName' => 'Name',
      'avatarProvider' => 'Avatar provider',
      'avatarId' => 'Avatar ID',
      'url' => 'Profile URL',
      'visible' => 'Visible',
      'hidden' => 'Hidden',
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
