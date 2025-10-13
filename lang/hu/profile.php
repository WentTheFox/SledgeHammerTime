<?php

return [
  'title' => 'Profil',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Profilinformációk',
    'description' => "Frissítsd a fiókod profilinformációit.",
    'displayName' => 'Megjelenített Név',
    'saveSuccess' => 'A profilod sikeresen frissítésre került.',
  ],
  'accounts' => [
    'heading' => 'Connected Accounts',
    'description' => [
      'A HammerTime account is going to let you link multiple Discord accounts to be able to manage their resources in one place in the future.',
      'Below you can find a list of all Discord accounts associated with this HammerTime account.',
    ],
    'discord' => 'Discord Fiókok',
    'crowdin' => 'Crowdin Fiókok',
    'noConnectedAccounts' => 'Jelenleg nincs összekapcsolt fiókod',
    'linkAdditional' => [
      'heading' => 'Fiók Összekapcsolása vagy Frissítése',
      'description' => 'Több fiók egyetlen HammerTime fiókhoz való összekapcsolásával egy helyen kezelheted az összes összekapcsolt fiók beállításait.',
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
