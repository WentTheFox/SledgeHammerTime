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
        'description' => 'Wenn du als Übersetzer für das Projekt tätig bist, kannst du durch die Verknüpfung deines Crowdin-Kontos anpassen, wie dein Name in den Übersetzungs-Credits erscheint. Ausserdem dient es als zusätzliche Verifizierung, dass diese Konten dir gehören, falls du dem Discord-Server des Projekts beitrittst.',
        'authorize' => 'Crowdin-Konto autorisieren',
      ],
    ],
  ],
  'creditOverrides' => [
    'heading' => 'Mitwirkende Übersetzer',
    'description' => 'Passe an, wie du in den Übersetzungs-Credits für jede Sprache erscheinst, in der du ein Mitwirkender bist.',
    'displayName' => 'Anzeigename',
    'avatarProvider' => 'Profilbild',
    'avatarProviders' => [
        'discord' => 'Discord',
        'gravatar' => 'Gravatar',
        'crowdin' => 'Crowdin',
    ],
    'gravatarEmail' => 'E-Mail Adresse',
    'gravatarDescription' => '<1>Gravatar</1> ermöglicht dir, einen einzigen Avatar auf mehreren Webseiten zu verwenden, die das unterstützen. Deine E-Mail-Adresse wird als MD5-Hash gespeichert.',
    'avatarAccount' => 'Konto',
    'url' => 'Link',
    'visibility' => 'Sichtbarkeit',
    'submit' => 'Zur Genehmigung einreichen',
    'saveSuccess' => 'Zur Genehmigung eingereicht',
    'saveHideSuccess' => 'Sichtbarkeit aktualisiert',
    'cancel' => 'Änderungen verwerfen',
    'statusPrefix' => 'Status',
    'status' => [
      'approved' => 'Genehmigt',
      'inReview' => 'Wird geprüft',
      'rejected' => 'Abgelehnt',
    ],
    'currentlyApproved' => 'Derzeit genehmigte Werte',
    'reApprovalWarning' => 'Wenn du was anderes als die Sichtbarkeit änderst, muss das manuell geprüft werden. Du kannst die Prüfanfrage jederzeit von dieser Seite aus stornieren.',
    'deleteOverride' => 'Überschreibung zurücksetzen',
    'deleteOverrideConfirm' => 'Are you sure you want to remove your translation credit override? Your entry will revert to the default information from Crowdin.',
    'approvedValues' => [
      'displayName' => 'Name',
      'avatarProvider' => 'Avatar Anbieter',
      'avatarId' => 'Avatar ID',
      'url' => 'Profil URL',
      'visible' => 'Sichtbar',
      'hidden' => 'Versteckt',
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
