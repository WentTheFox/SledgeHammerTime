<?php

return [
  'title' => 'Profil',
  'intro' => 'Pagina de profil vă permite să gestionați informațiile contului dvs. legate în mod specific de site-ul web. Dacă doriți să aflați unde puteți modifica setările implicite și alte setări pentru aplicația Discord, accesați pagina <1>Setări aplicație</1>.',
  'information' => [
    'heading' => 'Informații profil',
    'description' => "Update your account's profile information.",
    'displayName' => 'Display Name',
    'hiddenFormats' => 'Formate ascunse din tabelul de selectare',
    'saveSuccess' => 'Profilul dvs. a fost actualizat cu succes.',
  ],
  'accounts' => [
    'heading' => 'Conturi conectate',
    'description' => [
      'Un cont HammerTime vă va permite să legați mai multe conturi Discord pentru a putea gestiona resursele într-un singur loc în viitor.',
      'Mai jos puteți găsi o listă a tuturor conturilor Discord asociate cu acest cont HammerTime.',
    ],
    'discord' => 'Conturi Discord',
    'crowdin' => 'Conturi Crowdin',
    'noConnectedAccounts' => 'Nu aveți niciun cont conectat în acest moment',
    'linkAdditional' => [
      'heading' => 'Link or Update Account',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
      'discord' => [
        'description' => 'Dacă fotografia de profil sau numele afișat s-au schimbat, poți utiliza această opțiune pentru a actualiza informațiile pentru orice cont Discord care este deja conectat.',
        'authorize' => 'Autorizați contul Discord',
      ],
      'crowdin' => [
        'description' => 'Dacă sunteți traducător pentru proiect, conectarea contului dvs. Crowdin vă va permite în cele din urmă să personalizați modul în care numele dvs. apare în creditele de traducere și servește, de asemenea, ca un nivel suplimentar de verificare a faptului că aceste conturi vă aparțin, în cazul în care vă alăturați serverului Discord al proiectului.',
        'authorize' => 'Autorizați contul Crowdin',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Ștergerea contului',
    'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
    'deleteButton' => 'Delete Account',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
