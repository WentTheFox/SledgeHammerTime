<?php

return [
  'title' => 'Profil',
  'intro' => 'Auf der Profilseite kannst du deine Kontoinformationen speziell für die Website verwalten. Wenn du wissen möchten, wo du Standardwerte und andere Einstellungen für die Discord-App ändern kannst, besuche die Seite <1>App-Einstellungen</1>.',
  'information' => [
    'heading' => 'Profilinformationen',
    'description' => "Aktualisiere die Profilinformationen deines Kontos.",
    'displayName' => 'Anzeigename',
    'hiddenFormats' => 'Ausgeblendete Formate der Auswahlliste',
    'saveSuccess' => 'Dein Profil wurde erfolgreich aktualisiert.',
  ],
  'accounts' => [
    'heading' => 'Verknüpfte Konten',
    'description' => 'Du kannst mehrere Konten mit deinem HammerTime-Konto verknüpfen, um sie alle an einem Ort zu verwalten. Die grundlegenden Benutzerinformationen, die du hier siehst, werden automatisch höchstens einmal pro Stunde aktualisiert, wenn du diese Seite lädst.',
    'discord' => 'Discord Konten',
    'crowdin' => 'Crowdin-Konten',
    'noConnectedAccounts' => 'Du hast zur Zeit keine Konten verbunden',
    'linkAdditional' => [
      'heading' => 'Zusätzliche Konten verknüpfen',
      'description' => 'Nutze die Knöpfe unten, um weitere Konten mit deinem aktuellen HammerTime-Konto zu verbinden.',
      'discord' => [
        'description' => 'Wenn sich dein Profilbild oder Ihr Anzeigename geändert hat, kannst du diese Informationen auch für alle Discord-Konten aktualisieren, die bereits verknüpft sind.',
        'authorize' => 'Discord-Konto autorisieren',
      ],
      'crowdin' => [
        'description' => 'Wenn du ein Übersetzer für das Projekt bist, kannst du durch die Verknüpfung deines Crowdin-Kontos festlegen, wie dein Name in den Übersetzungscredits erscheint. Außerdem dient es als zusätzliche Verifizierungsebene, dass diese Konten dir gehören, falls du dem Discord-Server des Projekts beitrittst.',
        'authorize' => 'Crowdin-Konto autorisieren',
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
    'heading' => 'Konto-Löschung',
    'description' => 'Sobald dein Konto gelöscht wurde, werden alle seine Ressourcen und Daten dauerhaft gelöscht. Bevor du dein Konto löschst, lade bitte alle Daten oder Informationen herunter, die du behalten möchtest.',
    'deleteButton' => 'Konto löschen',
    'confirmDialog' => [
      'header' => 'Bist du dir sicher, dass du deinen Account löschen willst?',
      'body' => 'Sobald dein Konto gelöscht ist, werden alle Ressourcen und Daten dauerhaft gelöscht.',
    ],
  ],
];
