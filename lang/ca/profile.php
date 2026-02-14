<?php

return [
  'title' => 'Perfil',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Informacio del perfil',
    'description' => "Update your account's profile information.",
    'displayName' => 'Nom de visualització',
    'hiddenFormats' => 'Formats hidden from picker table',
    'saveSuccess' => 'Your profile has been updated successfully.',
  ],
  'accounts' => [
    'heading' => 'Connected Accounts',
    'description' => 'You can link multiple accounts to your HammerTime account to be able to manage them in one place. The basic user information displayed here is automatically updated at most once an hour when you load this page.',
    'discord' => 'Comptes de Discord',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'You do not have any accounts connected at the moment',
    'linkAdditional' => [
      'heading' => 'Link Additional Accounts',
      'description' => 'Use the buttons below to connect additional accounts to your current HammerTime account.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => 'Authorize Discord account',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account will eventually let you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Autoritzar compte Crowdin',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Supressió del compte',
    'description' => 'Un cop suprimit el vostre compte, tots els seus recursos i dades s\'eliminaran permanentment. Abans de suprimir el vostre compte, baixeu les dades o la informació que vulgueu conservar.',
    'deleteButton' => 'Suprimir compte',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
