<?php

return [
  'title' => 'Profil',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Informacje profilowe',
    'description' => "Zaktualizuj informacje profilowe swojego konta.",
    'displayName' => 'Wyświetlana nazwa',
    'hiddenFormats' => 'Formats hidden from picker table',
    'saveSuccess' => 'Twój profil został pomyślnie zaktualizowany.',
  ],
  'accounts' => [
    'heading' => 'Połączone konta',
    'description' => [
      'Konto HammerTime pozwoli Ci połączyć wiele kont Discord, aby w przyszłości móc zarządzać ich zasobami w jednym miejscu.',
      'Poniżej znajduje się lista wszystkich kont Discorda powiązanych z tym kontem HammerTime.',
    ],
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'W tej chwili nie masz żadnych połączonych kont',
    'linkAdditional' => [
      'heading' => 'Połącz lub zaktualizuj konto',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => 'Autoryzuj konto Discord',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account will eventually let you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Authorize Crowdin account',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Usunięcie konta',
    'description' => 'Po usunięciu Twojego konta, wszystkie jego zasoby i dane zostaną trwale usunięte. Przed usunięciem konta pobierz wszelkie dane lub informacje, które chcesz zachować.',
    'deleteButton' => 'Usuń konto',
    'confirmDialog' => [
      'header' => 'Na pewno chcesz usunąć swoje konto?',
      'body' => 'Po usunięciu Twojego konta, wszystkie jego zasoby i dane zostaną trwale usunięte.',
    ],
  ],
];
