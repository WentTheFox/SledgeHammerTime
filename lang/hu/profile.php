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
        'description' => 'Ha fordíttója vagy a projektnek, a Crowdin-fiókod összekapcsolásával testreszabhatod, hogy a neved hogyan jelenjen meg a projekt névjegyében, és egy másodlagos igazolásként is szolgál, hogy ezek a fiókok hozzád tartoznak, ha csatlakozol a projekt Discord-szerveréhez.',
        'authorize' => 'Crowdin fiók összekapcsolása',
      ],
    ],
  ],
  'creditOverrides' => [
    'heading' => 'Fordítói névjegyek',
    'description' => 'Testreszabhatod, hogyan jelensz meg a fordítási névjegyekben minden olyan nyelv esetében, ahol közreműködtél.',
    'displayName' => 'Megjelenített Név',
    'avatarProvider' => 'Profilkép',
    'avatarProviders' => [
        'discord' => 'Discord',
        'gravatar' => 'Gravatar',
        'crowdin' => 'Crowdin',
    ],
    'gravatarEmail' => 'E-mail cím',
    'gravatarDescription' => 'A <1>Gravatar</1> lehetővé teszi, hogy egyetlen profilképet használj minden olyan weboldalon, ahol támogatott. Az e-mail címed MD5-ös hash-ként kerül elmentésre.',
    'avatarAccount' => 'Fiók',
    'url' => 'Link',
    'visibility' => 'Láthatóság',
    'submit' => 'Beküldés jóváhagyásra',
    'saveSuccess' => 'Jóváhagyásra beküldve',
    'saveHideSuccess' => 'Láhatóság frissítve',
    'cancel' => 'Változtatások visszavonása',
    'statusPrefix' => 'Állapot',
    'status' => [
      'approved' => 'Jóváhagyva',
      'inReview' => 'Ellenőrzés alatt',
      'rejected' => 'Elutasítva',
    ],
    'currentlyApproved' => 'Jelenleg jóváhagyott értékek',
    'reApprovalWarning' => 'A láthatóságon kívül bármi más megváltoztatása kézi jóváhagyást igényel. A jóváhagyási kérelmet bármikor visszavonhatod erről az oldalról.',
    'deleteOverride' => 'Felulírások eltávolítása',
    'deleteOverrideConfirm' => 'Biztos, hogy el akarod távolítani a fordítási névjegyed felülírásait? A névjegy vissza fog állni az alapértelmezett Crowdin adatokra.',
    'approvedValues' => [
      'displayName' => 'Név',
      'avatarProvider' => 'Profilkép szolgáltató',
      'avatarId' => 'Profilkép azonosító',
      'url' => 'Profil URL',
      'visible' => 'Látható',
      'hidden' => 'Rejtett',
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
