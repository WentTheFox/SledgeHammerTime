<?php

return [
  'seoDescription' => 'Generálj időpont jelölőket a Discord üzeneteidhez',
  'changeLanguage' => 'Nyelv változtatás',
  "notFound" => [
    "heading" => "Oldal Nem Található",
    "content" => "Nincs itt semmi látnivaló.",
  ],
  'incompleteTranslations' => 'A fordítások hiányosak',
  'contributeTranslations' => 'Közreműködés',
  'copyToClipboard' => 'Vágólapra másolás',
  'copiedToClipboard' => 'Vágólapra másolva!',
  'guest' => 'Látogató',
  'jsDisabled' => [
    'title' => 'JavaScript szükséges',
    'body' => "A böngésződ vagy nem támogatja a JavaScript-et vagy jelenleg ki van kapcsolva. Egyes böngészők biztonsági okokból alapértelmezetten kikapcsolják, viszont ennek az alkalmazásnak szüksége van rá. Kérlek engedélyezd és töltsd újra az oldalt, vagy használj egy másik böngészőt.",
  ],
  'nav' => [
    'botSettings' => 'App Beálítások',
    'profile' => 'Profil',
    'legal' => 'Jogi Információk',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Beviteli beállítások',
      'customInputs' => [
        'label' => 'Egyéni beviteli mezők',
        'description' => "Lecseréli a böngésző alapértelmezett beviteli mezőit sajátokra, amik követik a weboldal kiválasztott nyelvét",
      ],
      'separateInputs' => [
        'label' => 'Külön beviteli mezők',
        'description' => "Két különböző mezőt jelenít meg a dátumnak és az időnek egy összevont helyett (ami néhány böngészőben nem támogatott)",
      ],
      'autoTimeSync' => [
        'label' => 'Idő szinkronizálása a szerverrel (béta)',
        'description' => 'Ha a rendszered órája több mint 15 perccel eltér a szerver idejéhez képest (az időzónáktól függetlenül), ezzel a beállítzással imnden időszámítás figyelembe fogja venni ezt, így az időbélyegek pontosak maradnak. A szinkronizálás újratöltéskor történik.',
      ],
    ],
    'localSettings' => [
      'title' => 'Helyi Beállítások',
    ],
    'credits' => [
      'title' => 'Névjegy',
      'developedBy' => 'Fejlesztette: <1></1>',
      'using' => 'Ezek felhasználásával: <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Fordítók: <1></1>',
      'openSourceSoftware' => 'Nyílt forráskódú szoftver',
      'viewSourceCode' => 'Forráskód megtekintése',
      'notAffiliated' => 'A projektnek semmilyen kapcsolata nincs a Discord-al.',
    ],
    'themeButton' => [
      'dark' => 'Sötét Téma',
      'light' => 'Világos Téma',
      'system' => 'Rendszertéma Használata',
    ],
  ],
  'designEditor' => [
    'title' => 'Arculattervező',
    'description' => 'Az alábbi táblázatban levő beviteli mezőkkel befolyásolhatod az oldal kinézetét. A változók nevei a kódban szereplő azonostókból vannak származtatva, így nincsenek lefordítva sem. A változtatások az oldal újratöltésekor elvesznek.',
    'designPageLink' => 'Arculat Oldal',
    'exportInfo' => 'Kiexportálhatod a módosításaidat egy UserStyle fájlba, amivel a <1>Stylus</1> vagy hasonló bővítmént használva az alkalmazás kinézete maradandóan módosítható. Fontos viszont, hogy ezek a változók bármikor megváltozhatnak, ami miatt kézi frissítésre lehet szükség.',
    'export' => 'Exportálás UserStyle-ként',
    'variableColumnHeader' => 'CSS Változó',
    'valueColumnHeader' => 'Érték',
  ],
  'timeSync' => [
    'title' => 'Szerveridő Szinkronizálás',
    'description' => 'Ez a funkció szinkronizálja a helyi időt a HammerTime szerverekkel. Ez automatikusan történik, a felhasználó számára teljesen láthatatlanul, de szükség esetén manuálisan is elindítható ez a folyamat.',
    'autoApplyCheckbox' => 'Kiszámított különbség mentése a dátum-idő könyvtárban',
    'syncButtonLabel' => 'Szinkronizálás',
    'syncResultsHeading' => 'A Szinkronizálás Eredménye',
    't0' => 'Az kliens időbélyege a kérés küldésekor',
    't1' => 'Az szerver időbélyege a kérés érkezésekor',
    't2' => 'Az szerver időbélyege a válasz küldésekor',
    't3' => 'Az kliens időbélyege a válasz érkezésekor',
    'dtlOffsetCell' => 'Jelenlegi Különbség (dátum-idő könyvtár)',
    'timestampValue' => ':value mp.',
    'offsetAmount' => ':offset ezred mp.',
    'networkOffsetCell' => 'Kiszámított Különbség (Hálózat)',
  ],
];
