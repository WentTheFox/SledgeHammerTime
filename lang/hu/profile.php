<?php

return [
  'title' => 'Profil',
  'intro' => 'A profil oldal lehetővé teszi a wbeoldallal kapcsolatos fiók inkormációid kezelését. Ha azt keresed, hogy hol tudod a Discord app alapértelmezett értékeit vagy más beállításait módosítani, látgass el az <1>App Beálítások</1> oldalra.',
  'information' => [
    'heading' => 'Profilinformációk',
    'description' => "Frissítsd a fiókod profilinformációit.",
    'displayName' => 'Megjelenített Név',
    'hiddenFormats' => 'Táblázatból elrejtett formátumok',
    'saveSuccess' => 'A profilod sikeresen frissítésre került.',
  ],
  'accounts' => [
    'heading' => 'Connected Accounts',
    'description' => 'Több fiókot is összekapcsolhatsz a HammerTime fiókoddal, hogy egy helyen tudd kezelni őket. Az itt megejelenített alapvető felhasználói adatok automatikusan frissülnek legfeljebb óránként amikor betöltöd ezt az oldalt.',
    'discord' => 'Discord Fiókok',
    'crowdin' => 'Crowdin Fiókok',
    'noConnectedAccounts' => 'Jelenleg nincs összekapcsolt fiókod',
    'linkAdditional' => [
      'heading' => 'További Fiókok Összekapcsolása',
      'description' => 'Az alábbi gombok segítségével további fiókokat kapcsolhatsz össze a jelenlegi HammerTime fiókoddal.',
      'discord' => [
        'description' => 'Ha a profilképed vagy a megjelenített neved megváltozott, akkor bármelyik korábban összekapcsolt Discord fiókodnál frissítheted is ezt az információt.',
        'authorize' => 'Discord fiók összekapcsolása',
      ],
      'crowdin' => [
        'description' => 'Ha fordíttója vagy a projektnek, a Crowdin-fiókod összekapcsolásával a későbbiekben majd testreszabhatod, hogy a neved hogyan jelenjen meg a projekt névjegyében, és egy másodlagos igazolásként is szolgál, hogy ezek a fiókok hozzád tartoznak, ha csatlakozol a projekt Discord-szerveréhez.',
        'authorize' => 'Crowdin fiók összekapcsolása',
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
    'hide' => 'Hide from credits',
    'submit' => 'Submit for approval',
    'saveSuccess' => 'Submitted for approval',
    'saveHideSuccess' => 'Visibility updated',
    'cancel' => 'Cancel changes',
    'statusPrefix' => 'Status',
    'status' => [
      'approved' => 'Approved',
      'inReview' => 'In review',
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
    'heading' => 'Account Deletion',
    'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
    'deleteButton' => 'Delete Account',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
