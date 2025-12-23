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
