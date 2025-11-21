<?php

return [
  'seoDescription' => 'Generování ukazatelů časových razítek pro zprávy chatu Discord',
  'changeLanguage' => 'Změnit jazyk',
  "notFound" => [
    "heading" => "Page Not Found",
    "content" => "Není zde nic k zobrazení.",
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
  'incompleteTranslations' => 'Překlad není úplný',
  'contributeTranslations' => 'Přispět',
  'copyToClipboard' => 'Zkopírovat do schránky',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript je nezbytný',
    'body' => "Váš prohlížeč buď nepodporuje JavaScript, nebo je momentálně vypnutý. Některé prohlížeče JavaScript ve výchozím nastavení z bezpečnostních důvodů zakazují, ale pro tuto aplikaci je nezbytný. Povolte jej a obnovte stránku nebo použijte jiný prohlížeč.",
  ],
  'nav' => [
    'botSettings' => 'Nastavení aplikace',
    'profile' => 'Můj účet',
    'legal' => 'Právní informace',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Nastavení vstupu',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => 'Samostatná vstupní pole',
        'description' => "Zobrazí dvě samostatná vstupní pole pro datum a čas namísto jednoho kombinovaného (které nemusí být podporováno v některých prohlížečích)",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
    ],
    'timeSync' => [
      'title' => 'Synchronizace času',
      'status' => [
        'syncing' => 'Váš systémový čas se právě synchronizuje s našimi servery, vyčkejte prosím.',
        'accurate' => 'Váš systémový čas je přesný.',
        'potentiallyWrong' => 'Váš systémový čas může být nepřesný.',
        'value' => 'Rozdíl mezi časem na vašem počítači a časem serveru je :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Použít posun času serveru ve výpočtech (beta)',
        'description' => 'Pokud je váš systémový čas o více než :offset odlišný oproti času serveru (vyjma odchylky časových pásem), pak některé výpočty času budou upraveny tak, aby se tato odchylka zohlednila, tudíž vaše časová razítka budou méně náchylná k nepřesnostem. <1>Jedná se o experimentální funkci, používejte ji s rozvahou!</1> Synchronizace probíhá při prvním načtení stránky a okamžitě po zapnutí tohoto nastavení.',
      ],
      'details' => 'Podrobnosti',
      'autoApplyCheckbox' => 'Použít vypočtený posun v knihovně DateTime při manuálním stisknutí :syncButtonLabel (nastane pouze, pokud odchylka přesahuje :offset)',
      'syncButtonLabel' => 'Synchronizovat',
      'resetOffsetButtonLabel' => 'Obnovit použitý posun',
      'roundTripDuration' => 'Doba přenosu tam a zpět',
      't0' => 'Časové razítko klienta při odeslání požadavku',
      't1' => 'Časové razítko serveru při přijetí požadavku',
      't2' => 'Časové razítko serveru při odeslání odpovědi',
      't3' => 'Časové razítko klienta při přijetí odpovědi',
      'dtlOffsetCell' => 'Aktuálně použitý posun',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Zjištěný posun (přes síť)',
    ],
    'localSettings' => [
      'title' => 'Lokální nastavení',
    ],
    'credits' => [
      'title' => 'Zásluhy',
      'developedBy' => 'Vytvořili <1></1>',
      'using' => 'Použitím <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Přeložili <1></1>',
      'openSourceSoftware' => 'Otevřený software',
      'viewSourceCode' => 'Zobrazit zdrojový kód',
      'notAffiliated' => 'Tento projekt není nijak přidružen k společnosti Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tmavý motiv',
      'light' => 'Světlý motiv',
      'system' => 'Použít motiv systému',
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
