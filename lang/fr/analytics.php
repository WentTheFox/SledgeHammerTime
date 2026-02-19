<?php

return [
  'heading' => 'Statistiques des pages vues',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last 30 days.',
  'collectionMethod' => 'Les données sont collectées côté serveur, basé sur des réponses envoyées vers un nombre limité de pages. Les pages consultées sont enregistrées individuellement mais regroupées quotidiennement par un processus en arrière-plan.',
  'lastUpdated' => 'The information on this page is cached for a short period to reduce server load. The data you see was last updated <1/>.',
  'charts' => [
    'dailyTotal' => 'Daily Total Page Views',
    'breakdown' => 'Page Views Breakdown',
    'byPage' => 'By Pages',
    'byLanguage' => 'By Language',
  ],
  'values' => [
    'unknown' => 'Inconnu',
  ],
];
