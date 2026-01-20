<?php

return [
  'heading' => 'Page View Analytics',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last 30 days.',
  'collectionMethod' => 'The data is collected on the server side, based on responses sent to a limited set of pages. The page views are recorded individually but aggregated daily by a background process.',
  'lastUpdated' => 'The information on this page is cached for a short period to reduce server load. The data you see was last updated <1/>.',
  'charts' => [
    'dailyTotal' => 'Daily Total Page Views',
    'breakdown' => 'Page Views Breakdown',
    'byPage' => 'By Pages',
    'byLanguage' => 'By Language',
    'hideUnknown' => 'Hide unknown values',
  ],
  'values' => [
    'unknown' => 'Unknown',
  ],
];
