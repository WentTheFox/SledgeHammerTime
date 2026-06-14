<?php

return [
  'heading' => 'Statistiques des pages vues',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'Les données sont collectées côté serveur, basé sur des réponses envoyées vers un nombre limité de pages. Les pages consultées sont enregistrées individuellement mais regroupées quotidiennement par un processus en arrière-plan.',
  'lastUpdated' => 'Les informations contenues dans cette page sont mises en cache pour une courte période afin de réduire la charge du serveur. Les données que vous voyez ont été mises à jour pour la dernière fois <1/>.',
  'charts' => [
    'dailyTotal' => 'Nombre total de pages vues quotidien',
    'breakdown' => 'Répartition des pages vues',
    'byPage' => 'Par page',
    'byLanguage' => 'Par langue',
  ],
  'values' => [
    'unknown' => 'Inconnu',
  ],
];
