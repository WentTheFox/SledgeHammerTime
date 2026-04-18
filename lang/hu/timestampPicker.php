<?php

return [
  'howTo' => 'Válassz egy dátumot, másold ki a kívánt jelölőt a :syntaxColName oszlopból, majd másold be bárhova egy üzenetbe. Az eredmény egy dinamikus időbélyeg lesz, ami mindenkinek máshogy fog megjelenni a saját időzónájuktól függően.',
  'picker' => [
    'label' => [
      'date' => 'Dátum',
      'time' => 'Idő',
      'dateAndTime' => 'Dátum és idő',
      'timezone' => 'Időzóna',
      'naturalLanguageInput' => '@time bevitel',
      'modeOffset' => 'Abszolút Eltolás',
      'modeZoneName' => 'Zóna Név',
    ],
    'button' => [
      'jumpToToday' => 'Ugrás az aktuális hónapra',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Aktuális idő beállítása',
      'lock' => 'Időbélyeg rögzítése URL-el',
      'unlock' => 'Időbélyeg feloldása',
      'previousYear' => 'Előző év',
      'previousMonth' => 'Előző hónap',
      'previousDecade' => 'Előző évtized',
      'nextMonth' => 'Következő hónap',
      'nextYear' => 'Következő év',
      'nextDecade' => 'Következő évtized',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Nem értelmezhető a természetes nyelvi bevitel'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Üzenet formája',
    'resultColumn' => 'Példa megjelenés',
    'editFormats' => 'Formátumok testreszabása',
    'resetFormats' => 'Alaphelyzetbe állítás',
    'hideFormat' => 'Formátum elrejtése',
    'showFormat' => 'Formátum megjelenítése',
    'unhideInProfile' => 'Megjelenítés a profilbeállításokban',
  ],
  'faq' => [
    'title' => 'Gyakran Ismételt Kérdések',
    'description' => 'Ez a rész egyelőre csak angol nyelven érhető el, és nagyrészt <1>a Discord szerverünk</1> tartalmán alapul. Egyes linkek lehet, hogy nen működnek, csak ha tagja vagy.',
  ],
  'usefulLinks' => [
    'lead' => 'Ezeket is hasznosnak találhatod:',
    'server' => [
      'header' => 'Hivatalos HammerTime Szerver',
      'p' => 'Csevegj a weboldalról, próbáld ki a kódokat és javasolj funkciókat',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => 'Generálj időbélyegeket slash parancsok használatával',
    ],
    'oldSite' => [
      'header' => 'HammerTime Régi Weboldal',
      'p' => 'A projekt régi weboldala, amely további értesítésig még mindig elérhető',
    ],
    'textColor' => [
      'header' => 'Rebane <1>Színezett</1> Szöveg Generálója',
      'p' => 'Egy egyszerű oldal, ami ANSI színkódokkal színezett Discord üzeneteket készít',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "Egy alulértékelt autóversenyzős játék közössége, mely heti kihívások házigazdája, és a projekt létrejöttét ihlette",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => 'r.3v.fi/discord-timestamps',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => 'timestamp.dabric.xyz',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'header' => 'DiscordTimestamp.com',
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'header' => 'DiscordTimestamp.org',
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'header' => 'sesh.fyi/timestamp',
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
