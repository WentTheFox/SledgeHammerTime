<?php

return [
  'seoDescription' => 'Generálj időpont jelölőket a Discord üzeneteidhez',
  'changeLanguage' => 'Nyelv változtatás',
  "notFound" => [
    "heading" => "Oldal Nem Található",
    "content" => "Nincs itt semmi látnivaló.",
  ],
  "maintenanceMode" => [
    "heading" => "Maintenance Mode",
    "content" => [
      'pleaseWait' => "The application is currently being updated, please try again in a few seconds.",
      'joinSupportServer' => "If the issue persists for more than a few minutes, please join the Discord support server and let us know.",
      'contactDeveloper' => "If the issue persists for more than a few minutes, please contact the developer and let them know.",
    ],
    "supportServerButton" => "Support Server",
  ],
  'incompleteTranslations' => 'A fordítások hiányosak',
  'contributeTranslations' => 'Közreműködés',
  'copyToClipboard' => 'Vágólapra másolás',
  'copiedToClipboard' => 'Vágólapra másolva!',
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
      'customDateInput' => [
        'label' => 'Egyéni dátum beviteli mező',
        'description' => "Lecseréli a böngésző alapértelmezett dátum beviteli mezőjét egy egyénire.",
      ],
      'customTimeInput' => [
        'label' => 'Egyéni idő beviteli mező',
        'description' => "Lecseréli a böngésző alapértelmezett idő beviteli mezőjét egy egyénire. Ez kifejezetten hasznos, ha gondot okoz az idő kiválasztása mobil böngészőkben.",
      ],
      'separateInputs' => [
        'label' => 'Külön beviteli mezők',
        'description' => "Két különböző mezőt jelenít meg a dátumnak és az időnek egy összevont helyett (ami néhány böngészőben nem támogatott)",
      ],
      'flatUi' => [
        'label' => 'Felület kilapítása',
        'description' => "Kikapcsolja az árnyék és magasság hatásokat a beviteli mezőkön és gombokon",
      ],
    ],
    'timeSync' => [
      'title' => 'Idő Szinkronizáció',
      'status' => [
        'syncing' => 'A rendszeridőt épp szinkronizáljuk a szerveridővel, kérlek várj.',
        'accurate' => 'A rendszeridőd pontos.',
        'potentiallyWrong' => 'A rendszeridőd lehet, hogy pontatlan.',
        'value' => 'A rendszer és a szerver idő közötti különbség :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Szerveridő eltolás használata időszámításhoz (béta)',
        'description' => 'Ha a rendszeridőd több, mint :offset-al eltér a szerveridőtől (időzónáktól függetlenül), egyes idő számítások módosítva lesznek, hogy ezt figyelembe vegye, és az időbélyegeid kisebb eséllyel lesznek hibásak. <1>Ez egy kísérleti funkció, óvatosan használd!</1> A szinkronizáció az első oldalbetöltéskor, illetve a beállítás bekapcsolása után közvetlenül is megtörténik.',
      ],
      'details' => 'Részletek',
      'autoApplyCheckbox' => 'Kiszámított időeltolódás alkalmazása a dátum-idő könyvtárra a :syncButtonLabel kézi megnyomásakor (csak akkor alkalmazódik, ha az eltolás több, mint :offset)',
      'syncButtonLabel' => 'Szinkronizálás',
      'resetOffsetButtonLabel' => 'Alkalmazott eltolás visszaállítása',
      'roundTripDuration' => 'Oda-vissza útidő',
      't0' => 'Az kliens időbélyege a kérés küldésekor',
      't1' => 'Az szerver időbélyege a kérés érkezésekor',
      't2' => 'Az szerver időbélyege a válasz küldésekor',
      't3' => 'Az kliens időbélyege a válasz érkezésekor',
      'dtlOffsetCell' => 'Aktív számítási eltolás',
      'timestampValue' => ':value mp.',
      'offsetAmount' => ':offset ezred mp.',
      'networkOffsetCell' => 'Érzékelt eltolás (hálózat alapján)',
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
];
