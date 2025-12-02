<?php

return [
  'title' => 'Profil',
  'intro' => 'Strona profilowa pozwala na zarządzanie informacjami o koncie powiązanymi ze stroną internetową. Jeśli szukasz gdzie zmienić ustawienia domyślne i inne ustawienia aplikacji Discord, odwiedź stronę <1>Ustawienia aplikacji</1> . ',
  'information' => [
    'heading' => 'Informacje profilowe',
    'description' => "Zaktualizuj informacje profilowe swojego konta.",
    'displayName' => 'Wyświetlana nazwa',
    'hiddenFormats' => 'Formaty ukryte z tabeli wyboru',
    'saveSuccess' => 'Twój profil został pomyślnie zaktualizowany.',
  ],
  'accounts' => [
    'heading' => 'Połączone konta',
    'description' => [
      'Konto HammerTime pozwoli Ci połączyć wiele kont Discord, aby w przyszłości móc zarządzać ich zasobami w jednym miejscu.',
      'Poniżej znajduje się lista wszystkich kont Discorda powiązanych z tym kontem HammerTime.',
    ],
    'discord' => 'Konta Discord',
    'crowdin' => 'Konta Crowdin',
    'noConnectedAccounts' => 'W tej chwili nie masz żadnych połączonych kont',
    'linkAdditional' => [
      'heading' => 'Połącz lub zaktualizuj konto',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => 'Autoryzuj konto Discord',
      ],
      'crowdin' => [
        'description' => 'Jeśli jesteś tłumaczem dla projektu, połączenie konta Crowdin pozwoli Ci ostatecznie dostosować Twoją nazwę w punktach tłumaczenia, a także służy jako dodatkowy poziom weryfikacji, że te konta należą do Ciebie, jeśli dołączysz do serwera Discord projektu.',
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
