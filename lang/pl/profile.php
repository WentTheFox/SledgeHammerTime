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
    'description' => 'You can link multiple accounts to your HammerTime account to be able to manage them in one place. The basic user information displayed here is automatically updated at most once an hour when you load this page.',
    'discord' => 'Konta Discord',
    'crowdin' => 'Konta Crowdin',
    'noConnectedAccounts' => 'W tej chwili nie masz żadnych połączonych kont',
    'linkAdditional' => [
      'heading' => 'Link Additional Accounts',
      'description' => 'Use the buttons below to connect additional accounts to your current HammerTime account.',
      'discord' => [
        'description' => 'Jeśli zmieniono zdjęcie profilowe lub wyświetlaną nazwę, możesz również użyć tego przycisku do aktualizacji tych informacji dla każdego konta Discord, które jest już połączone.',
        'authorize' => 'Autoryzuj konto Discord',
      ],
      'crowdin' => [
        'description' => 'Jeśli jesteś tłumaczem dla projektu, połączenie konta Crowdin pozwoli Ci ostatecznie dostosować Twoją nazwę w punktach tłumaczenia, a także służy jako dodatkowy poziom weryfikacji, że te konta należą do Ciebie, jeśli dołączysz do serwera Discord projektu.',
        'authorize' => 'Autoryzuj konto Crowdin',
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
