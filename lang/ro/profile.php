<?php

return [
  'title' => 'Profil',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Informații profil',
    'description' => "Actualizați informațiile de profil ale contului dvs.",
    'displayName' => 'Nume afișat',
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
      'heading' => 'Conectarea sau actualizarea contului',
      'description' => 'Prin conectarea mai multor conturi la un singur cont HammerTime, puteți gestiona toate setările conturilor conectate dintr-un singur loc.',
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
    'description' => 'Odată ce contul dvs. este șters, toate resursele și datele acestuia vor fi șterse definitiv. Înainte de a vă șterge contul, vă rugăm să descărcați orice date sau informații pe care doriți să le păstrați.',
    'deleteButton' => 'Ștergeți contul',
    'confirmDialog' => [
      'header' => 'Sunteți sigur că doriți să vă ștergeți contul?',
      'body' => 'Odată ce contul dvs. este șters, toate resursele și datele acestuia vor fi șterse definitiv.',
    ],
  ],
];
