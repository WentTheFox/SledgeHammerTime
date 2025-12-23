<?php

return [
  'title' => 'Profil',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Profil Informasjon',
    'description' => "Oppdater din konto profil informasjon.",
    'displayName' => 'Visningnavn',
    'hiddenFormats' => 'Formats hidden from picker table',
    'saveSuccess' => 'Ditt profil har blitt oppdatert.',
  ],
  'accounts' => [
    'heading' => 'Koblet kontoer',
    'description' => 'You can link multiple accounts to your HammerTime account to be able to manage them in one place. The basic user information displayed here is automatically updated at most once an hour when you load this page.',
    'discord' => 'Discord kontoer',
    'crowdin' => 'Crowdin kontoer',
    'noConnectedAccounts' => 'You do not have any accounts connected at the moment',
    'linkAdditional' => [
      'heading' => 'Link Additional Accounts',
      'description' => 'Use the buttons below to connect additional accounts to your current HammerTime account.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => 'Autorisere Discord konto',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account will eventually let you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Autorisere Crowdin konto',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Account Deletion',
    'description' => 'Når kontoen din er slettet, alt av sine ressurser og data vil bli permanent slettet. Før du sletter din konto, vennligst last ned data eller informasjon du ønsker å beholde.',
    'deleteButton' => 'Slett konto',
    'confirmDialog' => [
      'header' => 'Er du sikkert at du vil slette din konto?',
      'body' => 'Når kontoen din er slettet, alt av sine ressurser og data vil bli permanent slettet.',
    ],
  ],
];
