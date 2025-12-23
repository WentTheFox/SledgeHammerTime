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
