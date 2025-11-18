<?php

return [
  'title' => 'Profiel',
  'intro' => 'De profielpagina laat u toe om uw accountinformatie te beheren die specifiek betrekking heeft op de website. Als u op zoek bent naar waar u de standaardinstellingen en andere instellingen voor de Discordapp kunt wijzigen, ga naar de pagina voor <1> App instellingen <1>.',
  'information' => [
    'heading' => 'Profiel Informatie',
    'description' => "Werk uw accounts profielinformatie bij.",
    'displayName' => 'Weergavenaam',
    'saveSuccess' => 'Uw profiel is succesvol bijgewerkt.',
  ],
  'accounts' => [
    'heading' => 'Gekoppelde accounts',
    'description' => [
      'A HammerTime account is going to let you link multiple Discord accounts to be able to manage their resources in one place in the future.',
      'Below you can find a list of all Discord accounts associated with this HammerTime account.',
    ],
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'You do not have any accounts connected at the moment',
    'linkAdditional' => [
      'heading' => 'Koppel of Bewerk Account',
      'description' => 'Door meerdere accounts met één HammerTime-account te koppelen kan u de instellingen van alle verbonden accounts op één plaats beheren.',
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
    'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
    'deleteButton' => 'Account verwijderen',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
