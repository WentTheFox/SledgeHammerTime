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
  'copyToClipboard' => 'Copy to clipboard',
  'copiedToClipboard' => 'Copied to clipboard!',
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
        'description' => "Replaces the browser's default inputs with custom ones that respect your chosen website language",
      ],
      'separateInputs' => [
        'label' => 'Külön beviteli mezők',
        'description' => "Két különböző mezőt jelenít meg a dátumnak és az időnek egy összevont helyett (ami néhány böngészőben nem támogatott)",
      ],
      'legacyDateTimeLibrary' => [
        'label' => 'Use legacy datetime library',
        'description' => 'The library used by the old application to calculate timestamps is not maintained anymore, so it needed to be replaced. This option lets you return to the old library in case you encounter issues. It\'s recommended to completely reload the page after changing this setting.',
      ],
      'autoTimeSync' => [
        'label' => 'Synchronize time with server (beta)',
        'description' => 'If your system clock is over 15 minutes off compared to the server time (excluding timezone differences), all calculations will be adjusted to take this into account, so your timestamps remain accurate. Synchronization happens on each reload.',
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
      'momentJs' => 'Moment.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Fordítók: <1></1>',
      'openSourceSoftware' => 'Nyílt forráskódú szoftver',
      'viewSourceCode' => 'Forráskód megtekintése',
      'notAffiliated' => 'A projektnek semmilyen kapcsolata nincs a Discord-al.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
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
    'title' => 'Server Time Sync',
    'description' => 'This feature synchronizes your local time with the HammerTime servers. This is done automatically, completely transparent to the user, but it\'s also possible to trigger this process manually when needed.',
    'autoApplyCheckbox' => 'Apply calculated offset to DateTime library',
    'syncButtonLabel' => 'Synchronize',
    'syncResultsHeading' => 'Synchronization Results',
    't0' => 'The client\'s timestamp of the request transmission',
    't1' => 'The server\'s timestamp of the request reception',
    't2' => 'The server\'s timestamp of the response transmission',
    't3' => 'The client\'s timestamp of the response reception',
    'dtlOffsetCell' => 'Current Offset (DateTime library)',
    'timestampValue' => ':value s',
    'offsetAmount' => ':offset ms',
    'networkOffsetCell' => 'Calculated Offset (Network)',
  ],
];
