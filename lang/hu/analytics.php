<?php

return [
  'heading' => 'Oldalmegtekintési Statisztikák',
  'description' => 'Ez az oldal alapvető statisztikákat tartalmaz (személyazonosító részletek nélkül tárolva és megejelenítve) az alkalmazás összesített oldalmegtekintéseiről az elmúlt 30 napban.',
  'collectionMethod' => 'Az adatokat a szerver gyűjti, egy korlátozott listán szereplő oldalakra küldött válaszok alapján. Az oldalmegtekintések egyenként tárolódnak, de egy háttérfolyamat napi szinten összegzi őket.',
  'lastUpdated' => 'Az oldal tartalma gyorsítótárból kerül betöltésre a szerver terhelésének csökkentése érdekében. A most látható adatok <1/> frissültek.',
  'charts' => [
    'dailyTotal' => 'Napi összes oldalmegtekintés',
    'breakdown' => 'Oldalmegtekintések lebontása',
    'byPage' => 'Oldalak szerint',
    'byLanguage' => 'Nyelvek szerint',
    'hideUnknown' => 'Ismeretlen értékek elrejtése',
  ],
  'values' => [
    'unknown' => 'Ismeretlen',
  ],
];
