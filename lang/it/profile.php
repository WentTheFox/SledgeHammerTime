<?php

return [
  'title' => 'Profile',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Profile Information',
    'description' => "Update your account's profile information.",
    'displayName' => 'Display Name',
    'saveSuccess' => 'Your profile has been updated successfully.',
  ],
  'accounts' => [
    'heading' => 'Connected Accounts',
    'description' => [
      'A HammerTime account is going to let you link multiple Discord accounts to be able to manage their resources in one place in the future.',
      'Below you can find a list of all Discord accounts associated with this HammerTime account.',
    ],
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'You do not have any accounts connected at the moment',
    'linkAdditional' => [
      'heading' => 'Link or Update Account',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => 'Authorize Discord account',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account will eventually let you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Authorize Crowdin account',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Account Deletion',
    'description' => 'Una volta eliminato il tuo account, tutte le sue risorse e i relativi dati verranno eliminati definitivamente. Prima di eliminarlo, scarica tutti i dati o le informazioni che desideri conservare.',
    'deleteButton' => 'Elimina Account',
    'confirmDialog' => [
      'header' => 'Sei sicuro di voler eliminare il tuo account?',
      'body' => 'Una volta cancellato il suo account, tutte le sue risorse e i suoi dati saranno eliminati in modo permanente.',
    ],
  ],
];
