<?php

return [
  'heading' => 'Oldalmegtekintési Statisztikák',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'Az adatokat a szerver gyűjti, egy korlátozott listán szereplő oldalakra küldött válaszok alapján. Az oldalmegtekintések egyenként tárolódnak, de egy háttérfolyamat napi szinten összegzi őket.',
  'lastUpdated' => 'Az oldal tartalma gyorsítótárból kerül betöltésre a szerver terhelésének csökkentése érdekében. A most látható adatok <1/> frissültek.',
  'charts' => [
    'dailyTotal' => 'Napi összes oldalmegtekintés',
    'breakdown' => 'Oldalmegtekintések lebontása',
    'byPage' => 'Oldalak szerint',
    'byLanguage' => 'Nyelvek szerint',
  ],
  'values' => [
    'unknown' => 'Ismeretlen',
  ],
];
