<?php

return [
  'seoDescription' => 'Generování ukazatelů časových razítek pro zprávy chatu Discord',
  'changeLanguage' => 'Změnit jazyk',
  "notFound" => [
    "heading" => "Stránka nenalezena",
    "content" => "Není zde nic k zobrazení.",
  ],
  "maintenanceMode" => [
    "heading" => "Režim údržby",
    "content" => [
      'pleaseWait' => "Aplikace se momentálně aktualizuje, zkuste to prosím znovu za několik sekund.",
      'joinSupportServer' => "Pokud problém přetrvává déle než pár minut, připojte se prosím na Discord server podpory a dejte nám vědět.",
      'contactDeveloper' => "Pokud problém přetrvává déle než pár minut, kontaktujte prosím vývojáře a dejte jim vědět.",
    ],
    "supportServerButton" => "Server podpory",
  ],
  'incompleteTranslations' => 'Překlad není úplný',
  'contributeTranslations' => 'Přispět',
  'copyToClipboard' => 'Zkopírovat do schránky',
  'copiedToClipboard' => 'Zkopírováno do schránky!',
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
        'label' => 'Formátované vstupní pole data',
        'description' => "Nahradí výchozí vstupní pole prohlížeče formátovaným.",
      ],
      'customTimeInput' => [
        'label' => 'Formátované vstupní pole času',
        'description' => "Nahradí výchozí vstupní pole prohlížeče formátovaným. To je obzvlášť užitečné, pokud máte problém s výběrem času na mobilních prohlížečích.",
      ],
      'separateInputs' => [
        'label' => 'Samostatná vstupní pole',
        'description' => "Zobrazí dvě samostatná vstupní pole pro datum a čas namísto jednoho kombinovaného (které nemusí být podporováno v některých prohlížečích)",
      ],
      'flatUi' => [
        'label' => 'Zjednodušené rozhraní',
        'description' => "Odstraní stíny a výškové efekty u vstupních polí a tlačítek",
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
    'title' => 'Editor vzhledu',
    'description' => 'Pomocí políček v tabulce níže můžete upravit mnoho aspektů vzhledu webu. Názvy proměnných vycházejí z identifikátorů v kódu, a proto nejsou přeloženy. Hodnoty budou resetovány po obnovení stránky.',
    'designPageLink' => 'Stránka se vzhledem',
    'exportInfo' => 'Své změny můžete exportovat do souboru UserStyle, který lze použít s rozšířením, jako je <1>Stylus</1>, k trvalému přizpůsobení vzhledu aplikace. Upozorňujeme však, že tyto proměnné se mohou kdykoli změnit, což bude vyžadovat manuální aktualizaci vašich vlastních stylů.',
    'export' => 'Exportovat jako UserStyle',
    'variableColumnHeader' => 'Proměnná v CSS',
    'valueColumnHeader' => 'Hodnota',
  ],
];
