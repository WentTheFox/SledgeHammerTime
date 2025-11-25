<?php

return [
  'title' => 'Profiel',
  'intro' => 'De profielpagina laat u toe om uw accountinformatie te beheren die specifiek betrekking heeft op de website. Als u op zoek bent naar waar u de standaardinstellingen en andere instellingen voor de Discordapp kunt wijzigen, ga naar de pagina voor <1> App instellingen <1>.',
  'information' => [
    'heading' => 'Profiel Informatie',
    'description' => "Werk uw accounts profielinformatie bij.",
    'displayName' => 'Weergavenaam',
    'hiddenFormats' => 'Verberg formaten',
    'saveSuccess' => 'Uw profiel is succesvol bijgewerkt.',
  ],
  'accounts' => [
    'heading' => 'Gekoppelde accounts',
    'description' => [
      'Met een HammerTime account kun je meerdere Discord-accounts koppelen om instellingen op één plek te beheren.',
      'Hieronder vind je een lijst van alle Discord accounts die gekoppeld zijn aan dit HammerTime account.',
    ],
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'Er zijn op het moment geen accounts verbonden',
    'linkAdditional' => [
      'heading' => 'Koppel of Bewerk Account',
      'description' => 'Door meerdere accounts met één HammerTime-account te koppelen kan u de instellingen van alle verbonden accounts op één plaats beheren.',
      'discord' => [
        'description' => 'Als je profielfoto of naam veranderd is, kun je deze ook gebruiken om die informatie bij te werken voor een al gelinkte Discord-account.',
        'authorize' => 'Discord account autoriseren',
      ],
      'crowdin' => [
        'description' => 'Als je een vertaler voor het project bent, kan je door je Crowdin-account te koppelen aanpassen hoe je naam in de \'met dank aan\'-sectie verschijnt. Als je je aansluit in de Discord server dan dient het ook als extra verificatie dat jouw discord account hoort bij jouw Crowdin account.',
        'authorize' => 'Crowdin account autoriseren',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Account verwijderen',
    'description' => 'Zodra je account wordt verwijderd, worden al je gegevens permanent verwijderd. Download voordat je je account verwijdert eerst de gegevens die je wil bewaren.',
    'deleteButton' => 'Account verwijderen',
    'confirmDialog' => [
      'header' => 'Weet je zeker dat je je account wilt verwijderen?',
      'body' => 'Zodra je account is verwijderd, worden alle gegevens permanent verwijderd.',
    ],
  ],
];
