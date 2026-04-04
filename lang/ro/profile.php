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
    'description' => 'Puteți conecta mai multe conturi la contul dvs. HammerTime pentru a le putea gestiona dintr-un singur loc. Informațiile de bază despre utilizator afișate aici sunt actualizate automat cel mult o dată pe oră, atunci când încărcați această pagină.',
    'discord' => 'Conturi Discord',
    'crowdin' => 'Conturi Crowdin',
    'noConnectedAccounts' => 'Nu aveți niciun cont conectat în acest moment',
    'linkAdditional' => [
      'heading' => 'Conectare conturi suplimentare',
      'description' => 'Utilizați butoanele de mai jos pentru a conecta conturi suplimentare la contul dvs. HammerTime actual.',
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
    'heading' => 'Ștergerea contului',
    'description' => 'Odată ce contul dvs. este șters, toate resursele și datele sale vor fi șterse definitiv. Înainte de a șterge contul, vă rugăm să descărcați toate datele sau informațiile pe care doriți să le păstrați.',
    'deleteButton' => 'Șterge contul',
    'confirmDialog' => [
      'header' => 'Ești sigur că vrei să-ți ștergi contul?',
      'body' => 'Odată ce contul dvs. este șters, toate resursele și datele sale vor fi șterse definitiv.',
    ],
  ],
];
