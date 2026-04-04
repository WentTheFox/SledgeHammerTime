<?php

return [
  'title' => 'Profiili',
  'intro' => 'Profiili-sivulla voit hallita käyttäjäsi erityisesti sivuun liittyvia tietoja. Jos etsit missä vaihtaa oletuksia ja muita asetuksia Discord appia varten, vieraile <1>apin asetukset</1> sivulla.',
  'information' => [
    'heading' => 'Profiilin tiedot',
    'description' => "Päivitä käyttäjäsi profiilitietoja.",
    'displayName' => 'Näyttönimi',
    'hiddenFormats' => 'Muodot piiloitettu valintataulukosta',
    'saveSuccess' => 'Profiilisi on päivitetty onnistuneesti.',
  ],
  'accounts' => [
    'heading' => 'Yhdistetyt tilit',
    'description' => 'Voit yhdistää useita tilejä HammerTime tiliisi jotta voit hallita niitä yhdessä paikassa. Käyttäjän perustiedot päivittyvät automaattisesti enintään kerran tunnissa, kun lataat tämän sivun.',
    'discord' => 'Discord tilit',
    'crowdin' => 'Crowdin tilit',
    'noConnectedAccounts' => 'Sinulla ei tällä hetkellä ole yhdistettyjä tilejä',
    'linkAdditional' => [
      'heading' => 'Yhdistä lisätilejä',
      'description' => 'Käytä alla olevia nappeja yhdistääksesi lisätilejä nykyiseen HammerTime tiliisi.',
      'discord' => [
        'description' => 'Jos profiilikuvasi tai näyttönimesi on muuttunut, voit myös käyttää tätä päivittäksesi tieto mille vain Discord käyttäjälle, joka on jo linkitetty.',
        'authorize' => 'Valtuuta Discord tili',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account lets you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Valtuuta Crowdin tili',
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
    'heading' => 'Käyttäjän poistaminen',
    'description' => 'Kun tilisi poistetaan, kaikki sen resurssit ja tiedot poistetaan pysyvästi. Ennen kuin poistat tilisi, lataa tiedot mitä haluat säilyttää.',
    'deleteButton' => 'Poista käyttäjä',
    'confirmDialog' => [
      'header' => 'Oletko varma, että haluat poistaa tilisi?',
      'body' => 'Kun tilisi poistetaan, kaikki sen resurssit ja tiedot poistetaan pysyvästi.',
    ],
  ],
];
