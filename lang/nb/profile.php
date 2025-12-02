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
    'description' => [
      'A HammerTime account is going to let you link multiple Discord accounts to be able to manage their resources in one place in the future.',
      'Below you can find a list of all Discord accounts associated with this HammerTime account.',
    ],
    'discord' => 'Discord kontoer',
    'crowdin' => 'Crowdin kontoer',
    'noConnectedAccounts' => 'You do not have any accounts connected at the moment',
    'linkAdditional' => [
      'heading' => 'Koble eller oppdater konto',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
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
