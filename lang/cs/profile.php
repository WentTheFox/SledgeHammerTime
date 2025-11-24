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
    'description' => [
      'Účet HammerTime vám v budoucnu umožní propojit více Discord účtů, abyste mohli spravovat jejich informace na jednom místě.',
      'Níže najdete seznam všech Discord účtů přidružených k tomuto HammerTime účtu.',
    ],
    'discord' => 'Discord účty',
    'crowdin' => 'Crowdin účty',
    'noConnectedAccounts' => 'V současné době nemáte propojené žádné účty',
    'linkAdditional' => [
      'heading' => 'Propojení a aktualizace účtu',
      'description' => 'Propojení více účtů s jedním HammerTime účtem vám umožní spravovat nastavení všech propojených účtů na jednom místě.',
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
