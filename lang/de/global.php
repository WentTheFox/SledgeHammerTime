<?php

return [
  'seoDescription' => 'Generiere Zeitstempelindikatoren für Discord Chat-Nachrichten',
  'changeLanguage' => 'Sprache ändern',
  "notFound" => [
    "heading" => "Seite nicht gefunden",
    "content" => "Hier gibt es nichts zu sehen.",
  ],
  'incompleteTranslations' => 'Übersetzungen sind unvollständig',
  'contributeTranslations' => 'Beitragen',
  'copyToClipboard' => 'In Zwischenablage kopieren',
  'copiedToClipboard' => 'In die Zwischenablage kopiert!',
  'jsDisabled' => [
    'title' => 'JavaScript ist erforderlich',
    'body' => "Dein Browser unterstützt entweder kein JavaScript oder es ist derzeit deaktiviert. In einigen Browsern ist JavaScript aus Sicherheitsgründen standardmäßig deaktiviert, aber für diese Anwendung ist es notwendig. Bitte aktivieren es und aktualisiere die Seite, oder verwende einen anderen Browser.",
  ],
  'nav' => [
    'botSettings' => 'App-Einstellungen',
    'profile' => 'Profil',
    'legal' => 'Rechtliche Informationen',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Eingabeeinstellungen',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Use the date input of the project instead of the browser default",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Use the time input of the project instead of the browser default",
      ],
      'separateInputs' => [
        'label' => 'Getrennte Eingaben',
        'description' => "Zeige zwei verschiedene Eingaben für Datum und Uhrzeit statt eines kombinierten (was in einigen Browsern nicht unterstützt wird)",
      ],
    ],
    'timeSync' => [
      'title' => 'Zeitsynchronisation',
      'status' => [
        'syncing' => 'Deine Systemuhr wird gerade mit unseren Servern synchronisiert, bitte warten.',
        'accurate' => 'Deine Systemuhr ist korrekt.',
        'potentiallyWrong' => 'Deine Systemuhr könnte falsch eingestellt sein.',
        'value' => 'Der Unterschied zwischen der lokalen und der Serverzeit ist :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Server-Zeitversatz auf Berechnungen (Beta) anwenden',
        'description' => 'Wenn deine Systemuhr um mehr als :offset von der Serverzeit abweicht (Zeitzonenunterschiede ausgenommen), werden einige Zeitberechnungen angepasst, um dies zu berücksichtigen, so dass deine Zeitstempel weniger wahrscheinlich falsch sind. <1>Dies ist eine experimentelle Funktion, verwende sie mit Bedacht!</1> Die Synchronisierung findet statt, wenn die Seite zum ersten Mal geladen wird und unmittelbar nachdem die Einstellung aktiviert wurde.',
      ],
      'details' => 'Details',
      'autoApplyCheckbox' => 'Berechneten Offset auf die DateTime-Bibliothek anwenden, wenn :syncButtonLabel manuell gedrückt wird (gilt nur, wenn die Differenz über dem :offset Schwellenwert liegt)',
      'syncButtonLabel' => 'Synchronisieren',
      'resetOffsetButtonLabel' => 'Angewandten Offset zurücksetzen',
      'roundTripDuration' => 'Rundfahrt Dauer',
      't0' => 'Der Zeitstempel des Clients für die Übertragung der Anfrage',
      't1' => 'Der Zeitstempel des Servers für den Empfang der Anfrage',
      't2' => 'Der Zeitstempel des Clients für die Übertragung der Anfrage',
      't3' => 'Der Zeitstempel des Servers für den Empfang der Anfrage',
      'dtlOffsetCell' => 'Aktive Berechnungsverschiebung',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Erkannter Versatz (über Netzwerk)',
    ],
    'localSettings' => [
      'title' => 'Lokale Einstellungen',
    ],
    'credits' => [
      'title' => 'Mitwirkende',
      'developedBy' => 'Entwickelt von <1></1>',
      'using' => 'Mit <1></1>',
      'fontAwesomeFree' => 'Font Awesome Kostenlos',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Übersetzungen von <1></1>',
      'openSourceSoftware' => 'Open-Source Software',
      'viewSourceCode' => 'Quellcode anzeigen',
      'notAffiliated' => 'Dieses Projekt ist nicht mit Discord assoziiert.',
    ],
    'themeButton' => [
      'dark' => 'Dunkles Design',
      'light' => 'Helles Design',
      'system' => 'Benutze Systemdesign',
    ],
  ],
  'designEditor' => [
    'title' => 'Design Editor',
    'description' => 'Du kannst viele Aspekte des Erscheinungsbildes der Website mithilfe der Eingaben in der folgenden Tabelle anpassen. Die Namen der Variablen basieren auf Bezeichnungen im Code und können daher nicht übersetzt werden. Die Werte werden beim Aktualisieren der Seite zurückgesetzt.',
    'designPageLink' => 'Design Seite',
    'exportInfo' => 'Du kannst deine Änderungen in eine UserStyle-Datei exportieren, die mit einer Erweiterung wie <1>Stylus</1> verwendet werden kann, um das Aussehen der App dauerhaft anzupassen. Beachte jedoch, dass sich diese Variablen jederzeit ändern können, so dass du deine benutzerdefinierten Stile manuell aktualisieren musst.',
    'export' => 'Als UserStyle exportieren',
    'variableColumnHeader' => 'CSS-Variable',
    'valueColumnHeader' => 'Wert',
  ],
];
