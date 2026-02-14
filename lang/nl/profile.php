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
    'description' => 'Je kunt meerdere accounts koppelen aan je HammerTime account om ze allemaal op één plek te kunnen beheren. De hier getoonde gebruikersinformatie wordt bij het laden van deze pagina hoogstens één keer per uur automatisch bijgewerkt.',
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'Er zijn op het moment geen accounts verbonden',
    'linkAdditional' => [
      'heading' => 'Extra accounts koppelen',
      'description' => 'Gebruik de onderstaande knoppen om extra accounts aan je huidige HammerTime-account te koppelen.',
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
