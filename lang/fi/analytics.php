<?php

return [
  'heading' => 'Sivun näyttökertojen analytiikka',
  'description' => 'Tämä sivu kokoaa perusanalytiikkaa (sekä tallennettu että näytetty ilman henkilökohtaisesti tunnistettavia tietoja) eli sivun katselukertojen kokonaismäärän viimeisen :days päivän aikana.',
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
