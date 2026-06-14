<?php

return [
  'heading' => 'Sivun näyttökertojen analytiikka',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'Data kerätään palvelimen puolella, perustuen rajoitettuun määrään sivuja lähetettyjä vastauksia. Sivun näyttökerrat tallennetaan erikseen, mutta kootaan päivittäin taustaprosessin toimesta.',
  'lastUpdated' => 'Tämän sivun tiedot tallennetaan välimuistiin palvelimen kuormituksen vähentämiseksi. Data joka täällä näkyy, on viimeksi päivitetty <1/>.',
  'charts' => [
    'dailyTotal' => 'Päivittäiset sivun näyttökerrat',
    'breakdown' => 'Sivun näyttökertojen jakautuminen',
    'byPage' => 'Sivujen mukaan',
    'byLanguage' => 'Kielen mukaan',
  ],
  'values' => [
    'unknown' => 'Tuntematon',
  ],
];
