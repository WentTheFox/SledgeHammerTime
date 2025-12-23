<?php

return [
  'title' => 'Můj účet',
  'intro' => 'Tato stránka vám umožňuje spravovat informace o vašem účtu týkající se přímo tohoto webu. Pokud hledáte, kde změnit výchozí nastavení a další nastavení pro naši aplikaci na Discordu, navštivte stránku <1>Nastavení aplikace</1>.',
  'information' => [
    'heading' => 'Informace účtu',
    'description' => "Aktualizujte informace vašeho účtu.",
    'displayName' => 'Zobrazované jméno',
    'hiddenFormats' => 'Formáty skryté z tabulky pro výběr',
    'saveSuccess' => 'Váš profil byl úspěšně aktualizován.',
  ],
  'accounts' => [
    'heading' => 'Propojené účty',
    'description' => 'Se svým účtem HammerTime můžete propojit několik účtů a všechny je spravovat na jednom místě. Základní informace o uživateli zobrazované zde se automaticky aktualizují pokaždé, když načtete tuto stránku, maximálně jednou za hodinu.',
    'discord' => 'Discord účty',
    'crowdin' => 'Crowdin účty',
    'noConnectedAccounts' => 'V současné době nemáte propojené žádné účty',
    'linkAdditional' => [
      'heading' => 'Propojení dalších účtů',
      'description' => 'Použitím tlačítek níže můžete propojit další účty se svým stávajícím účtem HammerTime.',
      'discord' => [
        'description' => 'Pokud se změnil váš avatar nebo zobrazované jméno, tuto funkci můžete rovněž použít k aktualizaci těchto informací pro jakýkoli z již propojených Discord účtů.',
        'authorize' => 'Autorizovat Discord účet',
      ],
      'crowdin' => [
        'description' => 'Pokud jste překladatelem tohoto projektu, propojení vašeho Crowdin účtu vám v budoucnu umožní upravit, jak se vaše jméno zobrazí v seznamu zásluh. Propojení zároveň slouží jako dodatečná úroveň k ověření, že tyto účty patří vám, kdybyste se připojili na Discord server tohoto projektu.',
        'authorize' => 'Autorizovat Crowdin účet',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Smazání účtu',
    'description' => 'Po smazání vašeho účtu budou všechny jeho údaje a související obsah trvale odstraněny. Před smazáním účtu si prosím stáhněte veškerá data nebo informace, které si přejete ponechat.',
    'deleteButton' => 'Smazat účet',
    'confirmDialog' => [
      'header' => 'Opravdu chcete svůj účet smazat?',
      'body' => 'Po smazání vašeho účtu budou všechny jeho údaje a související obsah trvale odstraněny.',
    ],
  ],
];
