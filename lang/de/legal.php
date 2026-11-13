<?php

return [
  'translations' => [
    'title' => 'Übersetzter Inhalt',
    'text' => 'Dieses Projekt enthält Übersetzungen von freiwilligen Übersetzern und anderen Mitgliedern der Community. Diese Übersetzungen dienen der Bequemlichkeit der Benutzer und sind möglicherweise nicht immer ganz aktuell. In allen Angelegenheiten gilt die <1>ursprüngliche Sprachversion</1> dieser Seite als gültig.',
  ],
  'lastUpdated' => 'Zuletzt aktualisiert: <1/>',
  'privacy' => [
    'heading' => 'Datenschutzerklärung',
    'operator' => '<0/> ("wir", "wir", "unser" oder "Entwickler") betreibt die HammerTime Website (die "Seite") und HammerTimeBot (der "Bot" oder "App"), zusammen das HammerTime Projekt (das "Projekt"). Diese Seite informiert dich über unsere Richtlinien bezüglich der Erfassung, Verwendung und Weitergabe von persönlichen Daten, die wir von Nutzern des Projekts ("Sie", "Nutzer" oder zusammenfassend "Nutzer") erhalten.',
    'notAffiliated' => 'Obwohl der Name "HammerTime" ("Projektname") von dem früheren Namen "Hammer & Chisel" von Discord, Inc. ("Discord")<1/> abgeleitet ist, ist das Projekt weder in irgendeiner Weise mit Discord noch mit Hammer & Chisel Hammer verbunden, in dessen Anwendung<3/> diese Phrase prominent vorkommt. Der Entwickler besitzt keine Marken- oder Urheberrechte an dem Projektnamen.',
    'infoCollection' => [
      'heading' => 'Datenerhebung und Verwendung',
      'pii' => 'Während der Nutzung des Projekts bitten wir dich nicht, uns personenbezogene Daten ("PII", "Persönliche Daten") mitzuteilen, die dazu verwendet werden können, dich als Einzelperson zu identifizieren. Zu den PII können unter anderem gehören: Dein Name, dein Geburtsdatum, deine nationalen Identifikationsnummern, dein Wohnort und deine Telefonnummer.',
      'auth' => 'Die Anmeldung erfolgt über die OAuth 2 API ("API") von Discord, die ebenfalls über HTTPS gesichert ist. Während des OAuth-Authentifizierungsprozesses erhält unsere Website weder den Benutzernamen noch das Passwort, sondern nur ein Token, mit dem die Identität des Benutzers über diese API überprüft werden kann. Aus Leistungsgründen speichern wir die von der API bereitgestellten Basisinformationen (Benutzer-ID, aktueller Benutzername, Anzeigename, Avatar-Link) lokal.',
      'removal' => 'Diese Informationen werden nicht automatisch aus unserer Datenbank entfernt, wenn du dein Discord-Konto deaktivieren. Wende dich also an uns, wenn du deine Daten entfernen lassen möchten.',
    ],
    'logData' => [
      'heading' => 'Log-Daten',
      'browserInfo' => 'Wir sammeln Informationen, die deine Browser sendet, wenn du unsere Website besuchst ("Protokolldaten"). Diese Protokolldaten können Informationen wie die IP-Adresse deins Computers, das Betriebssystem, den Browsertyp, die Browserversion, die von dir besuchten Seiten unserer Website, die Uhrzeit und das Datum deines Besuchs enthalten.',
      'thirdParty' => 'Diese Protokolldaten werden nur auf unserem Server gespeichert und nicht an Dritte weitergegeben. Die Protokolldaten werden zu Diagnosezwecken verwendet und auf ausdrücklichen Wunsch an Strafverfolgungsbehörden weitergegeben. Sie werden bis zu 14 Tage lang aufbewahrt und danach vernichtet.',
      'debugging' => 'Der Bot kann Interaktionen von Benutzern über den Discord Client empfangen, der Slash Befehle und Kontextmenübefehle enthält ("Aktion", "Befehl" oder kollektiv "Befehle"). Slash-Befehle können zusätzlich mit vom Benutzer gelieferten strukturierten Schlüsselpaaren ausgeführt werden ("Optionen"). Der Bot protokolliert Befehlsausführung für Debugging-Zwecke, nämlich: der Discord Benutzername und Snowflake Identifier ("ID") des Benutzers, der den Befehl ausgeführt hat, der Name des Befehls (inklusive aller Optionen) und der ID des Servers, in dem der Befehl ausgeführt wurde. Diese Daten werden für bis zu 30 Tage auf dem Projektserver gespeichert und sind nur für den Entwickler zugänglich.',
      'noPii' => 'Bei der Ausführung von Befehlen solltest du keine persönlichen Informationen angeben. Einige Informationen können noch in unserem Anwendungsprotokoll gespeichert werden, Bitte kontaktiere uns mit den am Ende dieses Dokuments beschriebenen Methoden, um uns zu benachrichtigen, falls unsere Intervention erforderlich ist.',
    ],
    'performance' => [
      'heading' => 'Performance Monitoring',
      'intro' => 'To find errors and slow pages we record performance traces: short records of how a request to the Site was handled.',
      'serverTraces' => 'A trace of a request to the Site contains the address of the page requested (including its query string), the browser type (user agent), timings, the structure of the database queries involved (which can include identifiers of records) and whether the request was made by a logged in user (but not which one). The values of query parameters that look like credentials (such as codes, tokens and keys) are replaced before storage, and IP addresses are not included in traces.',
      'legalBasis' => 'We do this based on our legitimate interest in keeping the Site working and fast (<1>GDPR Article 6(1)(f)</1>).',
      'reporting' => 'When a request fails, the reference (trace ID) of its trace is shown in a message, so that you can include it when reporting the problem.',
      'retention' => 'Traces are kept for 14 days and then discarded automatically. They are stored only on our own server, can only be read by the Developer and are not shared with any third party. As individual traces cannot be deleted before they expire, a request to remove them is fulfilled by their expiry.',
    ],
    'optOut' => [
      'heading' => 'Opt Out of Performance Monitoring',
      'intro' => 'You can opt out of performance monitoring at any time using the form below. While you are opted out, no performance traces of your visits are recorded on our server.',
      'cookie' => 'Your choice is remembered in a cookie on your device. Its expiry is renewed each time you open a page of the Site while you are opted out, and clearing your cookies removes your choice.',
      'cookieLongest' => 'The cookie stays on this device for the longest time your browser allows.',
      'cookieExpiry' => 'The cookie stays on this device for the longest time your browser allows, which currently means it expires <1/>.',
      'label' => 'Do not record performance traces of my visits',
      'statusOptedOut' => 'You are currently opted out on this device.',
      'statusNotOptedOut' => 'You are currently not opted out on this device.',
      'saved' => 'Your choice was saved.',
    ],
    'telemetry' => [
      'heading' => 'Telemetrie & Statistik',
      'statsCollection' => 'Um die Nutzung des Bots zu beurteilen und damit Entwicklungsentscheidungen (z. B. das Hinzufügen/Entfernen von Features) können bestimmte Daten über Befehle und deren Nutzung gesammelt werden ("Telemetrie"). Telemetrieinformationen sind beschränkt auf welche Befehle und Optionen verwendet wurden und wann sie verwendet wurden ohne Identifikationsinformationen (daher enthält sie weder Server- oder Benutzer-IDs noch von Nutzern bereitgestellte Werte und ist vollständig anonymisiert). Die Telemetrie wird auf unbestimmte Zeit gespeichert und die daraus abgeleiteten Statistiken sollen insgesamt angezeigt und öffentlich zugänglich gemacht werden.',
      'telemetryOptOut' => 'Durch die Nutzung des Projekts erklärst du dich mit der Sammlung von Telemetrie standardmäßig einverstanden. Wenn ein Benutzer aus der Telemetrie-Sammlung aussteigen möchte, kann er seine Präferenz über die entsprechende Option auf der <1/> Seite angeben.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies sind Dateien mit kleinen Datenmengen. Cookies werden von einer Website an deine Browser gesendet und auf der Festplatte deines Computers gespeichert.',
      'disable' => 'Wir verwenden "Cookies", um Informationen aufzubewahren. Du kannst deinen Browser so einstellen, dass alle Cookies abgelehnt werden oder dass er anzeigt, wenn ein Cookie gesendet wird. Wenn du jedoch keine Cookies akzeptierst, kannst du möglicherweise einige Teile unserer Website nicht nutzen.',
      'optOut' => 'If you opt out of performance monitoring, a cookie remembering your choice is stored on your device for the longest time your browser allows, as its expiry is renewed each time you open a page of the Site.',
      'session' => 'Für angemeldete Benutzer wird ein dauerhafter Cookie verwendet, um den Anmeldestatus über Browser-Sitzungen hinweg für 30 Tage zu speichern. Wenn du nicht mehr daran erinnert werden möchten, kannst du dich entweder abmelden oder die von unserer Website gesetzten Cookies löschen.',
    ],
    'rights' => [
      'heading' => 'Your Rights',
      'intro' => 'You have the right to ask us for a copy of the personal data we hold about you, to have it corrected or erased, to restrict its processing and to receive it in a portable format. To use these rights, contact us using the methods described at the end of this document.',
      'complaint' => 'You also have the right to lodge a complaint with a data protection supervisory authority, for example in the country where you live or work. The <1>European Data Protection Board</1> lists the authorities of the EU member states.',
    ],
    'objection' => [
      'heading' => 'Right to Object',
      'text' => 'Where we process your personal data based on our legitimate interests, which includes performance monitoring, you have the right to object at any time on grounds relating to your particular situation. You can do so by opting out of performance monitoring (see above), or by contacting us.',
    ],
    'security' => [
      'heading' => 'Sicherheit',
      'noGuarantee' => 'Die Sicherheit Ihrer persönlichen Daten ist uns wichtig, aber denke daran, dass keine Methode der Übertragung über das Internet, oder Verfahren zur elektronischen Speicherung, 100 % sicher ist. Während wir uns bemühen, kommerziell akzeptable Mittel einzusetzen, um deine persönlichen Daten zu schützen, können wir absolute Sicherheit nicht garantieren.',
      'httpsCloudFlare' => 'Die Website verwendet HTTPS mit modernen TLS-Verschlüsselungssuiten, um die Integrität und den sicheren Transport von Daten zwischen dem Browser und unserer Website zu schützen. Wir nutzen jedoch den Reverse-Proxy-Service von CloudFlare, d. h. ein Teil der an unsere Website gesendeten Daten wird über deren Server geleitet. CloudFlare arbeitet mit einer eigenen <1>Datenschutzrichtlinie</1>.',
      'breachNotify' => 'Im Falle eines Sicherheitsverstoßes werden alle Benutzer innerhalb von 24 Stunden nach der Entdeckung durch einen Hinweis auf dieser Website, in Antworten des Bots und durch eine Ankündigung auf dem Discord-Supportserver des Bots benachrichtigt.',
    ],
  ],
  'terms' => [
    'heading' => 'Allgemeine Geschäftsbedingungen',
    'license' => 'Der gesamte Quellcode des Projekts wird auf GitHub im Ist-Zustand und ohne jegliche Garantie oder Haftung bereitgestellt. Die vollständigen Lizenzbedingungen findest du in der <1>MIT-Lizenz</1>, von der du in jedem Repository eine Kopie finden kannst. Die nachstehenden Bedingungen gelten für die Version des Projekts, die vom Entwickler gehostet wird ("Instanz"), und die darin enthaltenen Einschränkungen sind nicht als Beschränkungen für die Nutzung des Projekt-Quellcodes zu verstehen.',
    'noAbuse' => 'Du darfst keine Automatisierungen einrichten, um Befehle wiederholt über die Instanz auszuführen. Dieser Bot ist nicht dafür gedacht, von automatisierten Tools wie anderen Bots oder anderer Software verwendet zu werden, die legitime Benutzeraktivitäten imitieren soll. Anstatt sich für Automatisierungszwecke auf die Ausgabe unseres Bots zu verlassen, sies bitte in der Dokumentation der von deinem Bot verwendeten Programmiersprache nach, wie du UNIX-Zeitstempel erzeugen und manipulieren können.',
    'fuckWeb3' => 'Diese Instanz darf weder für das Training generativer KI-Modelle noch zur Erleichterung von Ereignissen und/oder Transaktionen im Zusammenhang mit nicht-fungiblen Token ("NFTs") oder einer Form von Kryptowährung (z. B. Ethereum, Bitcoin) verwendet werden.',
    'accessRevocation' => 'Dein Zugang zur Instanz kann nach dem Ermessen des Entwicklers aus beliebigen Gründen (auch ohne Grund) entzogen werden. Gründe können unter anderem sein: Verstoß gegen diese Bedingungen, vorsätzlicher Missbrauch der Funktionen der Instanz, Androhung von Gewalt gegen den Entwickler oder einen der Mitwirkenden des Projekts, Nutzung der Instanz für böswillige Zwecke.',
  ],
  'changes' => [
    'heading' => 'Änderungen & Revisionen',
    'effectiveFrom' => 'Die Allgemeinen Geschäftsbedingungen und die Datenschutzrichtlinie, zusammenfassend "Dokumente" genannt, gelten ab dem Datum ihrer letzten Aktualisierung und bleiben in Kraft, außer im Hinblick auf zukünftige Änderungen ihrer Bestimmungen, die unmittelbar nach ihrer Veröffentlichung auf dieser Seite in Kraft treten werden.',
    'rightToChange' => 'Wir behalten uns das Recht vor, diese Dokumente jederzeit zu aktualisieren oder zu ändern, und du solltest diese Seite in regelmäßigen Abständen überprüfen. Wenn du das Projekt weiterhin nutzt, nachdem wir Änderungen an den Dokumenten auf dieser Seite veröffentlicht haben, erkennen du die Änderungen an und erklärst dich damit einverstanden, die geänderten Dokumente einzuhalten und an sie gebunden zu sein.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, which is shown for up to two weeks after the update (unless you dismiss it earlier), as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Kontaktiere uns',
    'whereToContact' => 'Wenn du Fragen zu diesen Dokumenten hast oder nach dem Entfernen deiner privaten Daten fragen möchtest, welche wir speichern, kontaktiere uns bitte über <1>den Discord Server des Bots</1> oder verwende eine der auf der <3>Entwicklerwebsite aufgelisteten Methoden</3>.',
  ],
];
