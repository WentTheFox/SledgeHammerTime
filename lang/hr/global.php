<?php

return [
  'seoDescription' => 'Generirajte indikatore vremenske oznake za Discord chat poruke',
  'changeLanguage' => 'Promjeni jezik',
  "notFound" => [
    "heading" => "Stranica nije pronađena",
    "content" => "Ovdje se nema što vidjeti.",
    "suggestions" => [
      "heading" => "Tražiš nešto?",
      "description" => "Evo par stranica koje bi mogle pomoći:",
      "picker" => "Birač vremenskih oznaka",
      "botInfoDescription" => "Informacije o aplikaciji na Discord-u i dostupnim naredbama",
      "discordCta" => "Misliš da nešto fali? Pridruži se Discord serveru i javi nam.",
      "discordButton" => "Pridruži se Discord serveru",
    ],
  ],
  "maintenanceMode" => [
    "heading" => "Način održavanja",
    "content" => [
      'pleaseWait' => "Aplikacija se trenutno ažurira, molimo pokušajte ponovno za nekoliko sekundi.",
      'joinSupportServer' => "Ako problem traje dulje od nekoliko minuta, pridruži se Discord serveru te nam javi problem.",
      'contactDeveloper' => "Ako problem traje dulje od par minuta, molimo kontaktiraj programera te ga obavijesti o problemu.",
    ],
    'autoReload' => 'Stranica će se automatski ažurirati <1/>',
    'reloadButton' => 'Ažuriraj ručno',
    "supportServerButton" => "Podrška",
  ],
  'incompleteTranslations' => 'Prijevodi su nepotpuni',
  'contributeTranslations' => 'Doprinos',
  'timezoneBadge' => [
    'currently' => 'Trenutno aktivna',
    'atPickedDate' => 'Biti će aktivna u odabrano vrijeme',
    'currentlyAndAtPickedDate' => 'Trenutno aktivna te će biti aktivna u odabrano vrijeme',
  ],
  'copyToClipboard' => 'Kopirajte u međuspremnik',
  'copiedToClipboard' => 'Spremljeno u međuspremnik!',
  'jsDisabled' => [
    'title' => 'JavaScript je neophodan',
    'body' => "Vaš preglednik ili ne podržava JavaScript ili je trenutno onemogućen. Neki preglednici onemogućuju JavaScript prema zadanim postavkama iz sigurnosnih razloga, ali to je neophodno za ovu aplikaciju. Omogućite ga i osvježite stranicu ili upotrijebite drugi preglednik.",
  ],
  'nav' => [
    'botSettings' => 'Postavke aplikacije',
    'profile' => 'Profil',
    'legal' => 'Pravne Informacije',
    'analytics' => 'Analitika',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Postavke unosa',
      'naturalLanguageInput' => [
        'label' => '@time polje za unos',
        'description' => 'Omogućuje uređivanje odabrane vremenske oznake prirodnim jezikom (npr. „za 5 sati“) putem dodatnog polja za unos teksta. Slično novoj Discordovoj oznaci @time. Podržan je samo ograničen broj jezika.',
      ],
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Zamijeni zadani unos datuma u pregledniku prilagođenim.",
      ],
      'customTimeInput' => [
        'label' => 'Prilagođeni unos vremena',
        'description' => "Zamijenite zadani unos vremena u pregledniku prilagođenim. Posebno korisno ako imate problema s odabirom vremena na mobilnim preglednicima.",
      ],
      'separateInputs' => [
        'label' => 'Odvojeni ulazi',
        'description' => "Prikaži dva različita unosa za datum i vrijeme umjesto kombiniranog (što nije podržano u nekim preglednicima)",
      ],
      'flatUi' => [
        'label' => 'Pojednostavi sučelje',
        'description' => "Onemogućite efekte sjene i visine na poljima za unos i gumbima",
      ],
      'timezoneStickyHeaders' => [
        'label' => 'Naslovi grupa vremenskih zona',
        'description' => 'Prikaži naslove grupa (npr. Amerika, Europa) u padajućem izborniku za odabir vremenske zone.',
      ],
      'hourCycle' => [
        'label' => 'Oblik vremena',
        'description' => 'Promijenite kako je vrijeme prikazano u cijeloj aplikaciji, uključujući prilagođeni unos vremena i pretpreglede.',
        'options' => [
          'default' => 'Zadani jezik',
          'h12' => '12-satni',
          'h24' => '24-satni',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'Prvi dan u tjednu',
        'description' => 'Promijenite koji bi dan trebao biti smatran kao prvim danom tjedna u kalendaru prilagođenog unosa datuma.',
        'options' => [
          'default' => 'Zadani jezik',
        ],
      ],
      'advancedSettings' => 'Napredne postavke unosa',
    ],
    'timeSync' => [
      'title' => 'Sinkronizacija vremena',
      'status' => [
        'syncing' => 'Vaš sat sustava se trenutačno sinkronizira s našim serverima, molimo pričekajte.',
        'accurate' => 'Vaš sat sustava je točan.',
        'potentiallyWrong' => 'Vaš sat sustava možda nije ispravan.',
        'value' => 'Razlika između lokalnog i serverskog vremena je :offset.',
      ],
      'details' => 'pojedinosti',
      'syncButtonLabel' => 'Sinkroniziraj',
      'roundTripDuration' => 'Trajanje povratnog putovanja',
      't0' => 'Vrijeme slanja zahtjeva klijenta',
      't1' => 'Vremenska oznaka servera pri primitku zahtjeva',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
    ],
    'localSettings' => [
      'title' => 'Local Settings',
    ],
    'credits' => [
      'title' => 'Zasluge',
      'developedBy' => 'Developed by <1></1>',
      'using' => 'Using <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Prijevodi <1></1>',
      'openSourceSoftware' => 'Softver otvorenog koda',
      'viewSourceCode' => 'Pogledaj izvorni kod',
      'notAffiliated' => 'Ovaj projekt nije povezan s Discordom.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
    ],
  ],
  'designEditor' => [
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'CSS Variable',
    'valueColumnHeader' => 'Value',
  ],
];
