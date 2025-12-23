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
    'description' => 'You can link multiple accounts to your HammerTime account to be able to manage them in one place. The basic user information displayed here is automatically updated at most once an hour when you load this page.',
    'discord' => 'Account Discord',
    'crowdin' => 'Account Crowdin',
    'noConnectedAccounts' => 'Al momento non hai alcun account connesso',
    'linkAdditional' => [
      'heading' => 'Link Additional Accounts',
      'description' => 'Use the buttons below to connect additional accounts to your current HammerTime account.',
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
