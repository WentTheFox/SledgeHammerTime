<?php

return [
  'seoDescription' => 'Generați indicatori de timp pentru mesajele de chat Discord',
  'changeLanguage' => 'Schimbă limba',
  "notFound" => [
    "heading" => "Pagina nu a fost găsită",
    "content" => "Nimic de văzut aici.",
  ],
  "maintenanceMode" => [
    "heading" => "Mod de Mentenanță",
    "content" => [
      'pleaseWait' => "Aplicația este în curs de actualizare, vă rugăm să încercați din nou în câteva secunde.",
      'joinSupportServer' => "Dacă problema persistă mai mult de câteva minute, te rugăm să intri pe serverul de suport Discord și să ne anunți.",
      'contactDeveloper' => "Dacă problema persistă mai mult de câteva minute, vă rugăm să contactați dezvoltatorul și să îl informați.",
    ],
    "supportServerButton" => "Server de suport",
  ],
  'incompleteTranslations' => 'Traducerile sunt incomplete',
  'contributeTranslations' => 'Contribuie',
  'copyToClipboard' => 'Copiați în clipboard',
  'copiedToClipboard' => 'Copiat în clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript este necesar',
    'body' => "Browserul dvs. fie nu acceptă JavaScript, fie este dezactivat în prezent. Unele browsere dezactivează JavaScript în mod implicit din motive de securitate, dar este necesar pentru această aplicație. Vă rugăm să îl activați și să reîncărcați pagina sau să folosiți un alt browser.",
  ],
  'nav' => [
    'botSettings' => 'Setări aplicație',
    'profile' => 'Profil',
    'legal' => 'Informații legale',
    'analytics' => 'Analytics',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Setări de intrare',
      'naturalLanguageInput' => [
        'label' => '@time input field',
        'description' => 'Allow manipulating the selected timestamp with natural language (e.g. “in 5 hours”) via an additional free-text input. Similar to the new Discord @time tag. Only a limited number of languages are supported.',
      ],
      'customDateInput' => [
        'label' => 'Introducere dată personalizată',
        'description' => "Înlocuiți câmpul de introducere a datei implicită din browser cu unul personalizat.",
      ],
      'customTimeInput' => [
        'label' => 'Introducere personalizată a timpului',
        'description' => "Înlocuiți introducerea orei implicită a browserului cu una personalizată. Acest lucru este util mai ales dacă aveți probleme cu selectarea orei pe browserele mobile.",
      ],
      'separateInputs' => [
        'label' => 'Intrări separate',
        'description' => "Afișarea a două intrări diferite pentru dată și oră în loc de una combinată (care nu este acceptată în unele browsere)",
      ],
      'flatUi' => [
        'label' => 'Interfață plată',
        'description' => "Dezactivează efectele de umbră și înălțime pe intrări și butoane",
      ],
      'hourCycle' => [
        'label' => 'Custom time input clock type',
        'description' => 'Change how hours should be displayed in the custom time input. Has no effect on the previews in the example results column.',
        'options' => [
          'default' => 'Language default',
          'h12' => '12-hour',
          'h24' => '24-hour',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'First day of the week',
        'description' => 'Change which day should be considered the first day of the week in the calendar of the custom date input.',
        'options' => [
          'default' => 'Language default',
        ],
      ],
      'advancedSettings' => 'Advanced input settings',
    ],
    'timeSync' => [
      'title' => 'Sincronizarea timpului',
      'status' => [
        'syncing' => 'Ceasul sistemului dvs. este sincronizat în prezent cu serverele noastre, vă rugăm să așteptați.',
        'accurate' => 'Ceasul sistemului dvs. este precis.',
        'potentiallyWrong' => 'Ceasul sistemului dvs. ar putea fi greșit.',
        'value' => 'Diferența dintre ora locală și ora serverului este :offset.',
      ],
      'details' => 'Detalii',
      'syncButtonLabel' => 'Sincronizează',
      'roundTripDuration' => 'Durata călătoriei dus-întors',
      't0' => 'Data și ora transmiterii cererii de către client',
      't1' => 'Data și ora înregistrate de server la primirea cererii',
      't2' => 'Data și ora transmiterii răspunsului de către server',
      't3' => 'Data și ora recepționării răspunsului de către client',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Decalaj detectat (prin rețea)',
    ],
    'localSettings' => [
      'title' => 'Setări locale',
    ],
    'credits' => [
      'title' => 'Credite',
      'developedBy' => 'Dezvoltat de <1></1>',
      'using' => 'Folosind <1></1>',
      'fontAwesomeFree' => 'Font Awesome Gratuit',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'data-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Tradus de <1></1>',
      'openSourceSoftware' => 'Software cu sursă deschisă',
      'viewSourceCode' => 'Vezi codul sursă',
      'notAffiliated' => 'Acest proiect nu este afiliat cu Discord.',
    ],
    'themeButton' => [
      'dark' => 'Temă întunecată',
      'light' => 'Temă luminată',
      'system' => 'Utilizați tema sistemului',
    ],
  ],
  'designEditor' => [
    'title' => 'Editor de design',
    'description' => 'Puteți ajusta multe aspecte ale aspectului site-ului utilizând intrările din tabelul de mai jos. Numele variabilelor se bazează pe identificatorii din cod și, prin urmare, nu pot fi traduse. Valorile vor fi resetate la actualizarea paginii.',
    'designPageLink' => 'Pagina de design',
    'exportInfo' => 'Puteți exporta modificările într-un fișier UserStyle, care poate fi utilizat cu o extensie precum <1>Stylus</1> pentru a personaliza permanent aspectul aplicației. Rețineți, totuși, că aceste variabile se pot modifica în orice moment, fiind necesar să vă actualizați manual stilurile personalizate.',
    'export' => 'Exportați ca UserStyle',
    'variableColumnHeader' => 'Variabilă CSS',
    'valueColumnHeader' => 'Valoare',
  ],
];
