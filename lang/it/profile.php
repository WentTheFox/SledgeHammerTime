<?php

return [
  'title' => 'Profilo',
  'intro' => 'La pagina del profilo consente di gestire le informazioni del tuo account in modo specifico relative al sito web. Se stai cercando dove modificare le impostazioni predefinite e altre impostazioni per l\'app Discord, visita la pagina <1>Impostazioni app</1>.',
  'information' => [
    'heading' => 'Informazioni sul profilo',
    'description' => "Aggiorna le informazioni del profilo del tuo account.",
    'displayName' => 'Nome Visualizzato',
    'hiddenFormats' => 'Formati nascosti dalla tabella del selettore',
    'saveSuccess' => 'Il tuo profilo è stato aggiornato correttamente.',
  ],
  'accounts' => [
    'heading' => 'Account Connessi',
    'description' => 'Puoi collegare più account al tuo account HammerTime per poterli gestire in un unico posto. Le informazioni basilari sull\'utente visualizzate qui vengono aggiornate automaticamente al massimo una volta all\'ora durante il caricamento di questa pagina.',
    'discord' => 'Account Discord',
    'crowdin' => 'Account Crowdin',
    'noConnectedAccounts' => 'Al momento non hai alcun account connesso',
    'linkAdditional' => [
      'heading' => 'Collega Account Aggiuntivi',
      'description' => 'Utilizzi i pulsanti sottostanti per collegare altri account al tuo account HammerTime attuale.',
      'discord' => [
        'description' => 'Se l\'immagine del profilo o il nome visualizzato sono cambiati, è anche possibile utilizzare questo per aggiornare tali informazioni per qualsiasi account Discord già collegato.',
        'authorize' => 'Autorizza account Discord',
      ],
      'crowdin' => [
        'description' => 'Se sei un traduttore per il progetto, collegare il tuo account Crowdin ti permetterà di personalizzare come appare il tuo nome nei crediti di traduzione, e serve anche come un ulteriore livello di verifica che questi account appartengono a voi nel caso in cui si unisce al server Discord del progetto.',
        'authorize' => 'Autorizza account Crowdin',
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
    'submit' => 'Submit for approval',
    'saveSuccess' => 'Submitted for approval',
    'saveHideSuccess' => 'Visibility updated',
    'cancel' => 'Cancel changes',
    'statusPrefix' => 'Status',
    'status' => [
      'approved' => 'Approved',
      'inReview' => 'In review',
      'rejected' => 'Rejected',
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
    'heading' => 'Eliminazione Account',
    'description' => 'Una volta eliminato il tuo account, tutte le sue risorse e i relativi dati verranno eliminati definitivamente. Prima di eliminarlo, scarica tutti i dati o le informazioni che desideri conservare.',
    'deleteButton' => 'Elimina Account',
    'confirmDialog' => [
      'header' => 'Sei sicuro di voler eliminare il tuo account?',
      'body' => 'Una volta cancellato il suo account, tutte le sue risorse e i suoi dati saranno eliminati in modo permanente.',
    ],
  ],
];
