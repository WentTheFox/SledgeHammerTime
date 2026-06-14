<?php

return [
  'heading' => 'Seitenaufruf-Analysen',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'Die Erhebung der Daten findet serverseitig statt, basierend auf Rückmeldungen, die an eine begrenzte Anzahl von Webseiten gesendet werden. Die Seitenbesuche werden einzeln registriert, aber täglich von einem Hintergrundprogramm aggregiert.',
  'lastUpdated' => 'Die Informationen auf dieser Seite werden für einen kurzen Zeitraum zwischengespeichert, um die Serverlast zu reduzieren. Die Daten, die du siehst, wurden zuletzt <1/> aktualisiert.',
  'charts' => [
    'dailyTotal' => 'Tägliche Gesamtseitenaufrufe',
    'breakdown' => 'Aufteilung der Seitenaufrufe',
    'byPage' => 'Nach Seiten',
    'byLanguage' => 'Nach Sprache',
  ],
  'values' => [
    'unknown' => 'Unbekannt',
  ],
];
