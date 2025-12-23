<?php

return [
  'title' => 'Profil',
  'intro' => 'Pagina de profil vă permite să gestionați informațiile contului dvs. legate în mod specific de site-ul web. Dacă doriți să aflați unde puteți modifica setările implicite și alte setări pentru aplicația Discord, accesați pagina <1>Setări aplicație</1>.',
  'information' => [
    'heading' => 'Informații profil',
    'description' => "Actualizați informațiile din profilul contului dvs.",
    'displayName' => 'Numele afișat',
    'hiddenFormats' => 'Formate ascunse din tabelul de selectare',
    'saveSuccess' => 'Profilul dvs. a fost actualizat cu succes.',
  ],
  'accounts' => [
    'heading' => 'Conturi conectate',
    'description' => 'You can link multiple accounts to your HammerTime account to be able to manage them in one place. The basic user information displayed here is automatically updated at most once an hour when you load this page.',
    'discord' => 'Conturi Discord',
    'crowdin' => 'Conturi Crowdin',
    'noConnectedAccounts' => 'Nu aveți niciun cont conectat în acest moment',
    'linkAdditional' => [
      'heading' => 'Link Additional Accounts',
      'description' => 'Use the buttons below to connect additional accounts to your current HammerTime account.',
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
    'description' => 'Odată ce contul dvs. este șters, toate resursele și datele sale vor fi șterse definitiv. Înainte de a șterge contul, vă rugăm să descărcați toate datele sau informațiile pe care doriți să le păstrați.',
    'deleteButton' => 'Șterge contul',
    'confirmDialog' => [
      'header' => 'Ești sigur că vrei să-ți ștergi contul?',
      'body' => 'Odată ce contul dvs. este șters, toate resursele și datele sale vor fi șterse definitiv.',
    ],
  ],
];
