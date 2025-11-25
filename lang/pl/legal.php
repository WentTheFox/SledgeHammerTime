<?php

return [
  'translations' => [
    'title' => 'Przetłumaczona zawartość',
    'text' => 'Ten projekt zawiera tłumaczenia wykonane przez tłumaczy-wolontariuszy i innych członków społeczności. Tłumaczenia te są udostępniane dla wygody użytkowników i nie zawsze mogą być w pełni aktualne. We wszystkich sprawach, <1>oryginalna wersja językowa</1> tej strony jest uważana za skuteczną.',
  ],
  'lastUpdated' => 'Ostatnia aktualizacja: <1/>',
  'privacy' => [
    'heading' => 'Polityka prywatności',
    'operator' => '<0/> ("us", "we", "our", or "Developer") operates the HammerTime website (the "Site"), and HammerTimeBot (the "Bot", or "App"), collectively the HammerTime Project (the "Project"). This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Project ("you", "User", or collectively "Users").',
    'notAffiliated' => 'Although the "HammerTime" name ("Project Name") is derived from the former name "Hammer & Chisel" of Discord, Inc. ("Discord")<1/> the Project is not affiliated in any way, shape, or form, with Discord, nor M.C. Hammer, whose song<3/> features this phrase prominently. The Developer holds no trademark or copyright over the Project Name.',
    'infoCollection' => [
      'heading' => 'Gromadzenie i wykorzystywanie informacji',
      'pii' => 'While using the Project we do not ask nor encourage you to provide us with any Personally Identifiable Information ("PII", "Personal Information") that can be used to identify you as an individual. PII may include, but is not limited to: your name, birth date, national identification numbers, location, phone number.',
      'auth' => 'Sign in is provided using Discord\'s OAuth 2 API ("API") which is also secured using HTTPS. During the OAuth authentication process our Site does not receive the username or password, only a token that can be used to verify the user\'s identity using this API. For performance reasons we store the basic information provided by the API (user ID, current username, display name, avatar link) locally.',
      'removal' => 'Informacje te nie są automatycznie usuwane z naszej bazy danych, jeśli dezaktywują Państwo swoje konto Discord, więc proszę się z nami skontaktować, jeśli chcą Państwo usunąć swoje dane.',
    ],
    'logData' => [
      'heading' => 'Dane dziennika',
      'browserInfo' => 'Zbieramy informacje, które Państwa przeglądarka wysyła za każdym razem, gdy odwiedzają Państwo naszą Witrynę ("Dane dziennika"). Dane dziennika mogą zawierać takie informacje, jak adres IP komputera, system operacyjny, typ przeglądarki, wersja przeglądarki, odwiedzane strony naszej Witryny, godzina i data wizyty.',
      'thirdParty' => 'This Log Data is stored only within our server and is not shared with any third party. Log Data is used for diagnostic purposes, and shared with law enforcement agencies if explicitly requested. It is kept for up to 14 days and discarded afterwards.',
      'debugging' => 'The Bot can receive interactions from Users via the Discord client, which includes slash commands and context menu commands ("Action", "Command", or collectively "Commands"). Slash commands can additionally be executed with User-supplied structured key-value pairs ("Options"). The Bot records Command executions for debugging purposes, namely: the Discord username and Snowflake identifier ("ID") of the User that executed the Command, the name of the Command (including all Options) and the ID of the Server the Command was executed in. This data is stored on the Project server for up to 30 days, and is only accessible by the Developer.',
      'noPii' => 'When executing Commands you should avoid including any Personal Information. Some information may still be retained in our Application Log, so please contact us using the methods described at the end of this document to notify us if our intervention is needed.',
    ],
    'telemetry' => [
      'heading' => 'Telemetria i statystyki',
      'statsCollection' => 'W celu oceny użytkowania bota i tym samym stymulowania decyzji rozwojowych (np. dodanie/usuwanie funkcji) można zebrać określony zbiór danych dotyczących poleceń i ich wykorzystania („Telemetry”). Informacje telemetryczne są ograniczone do jakich poleceń i opcji zostały użyte, a kiedy zostały wykorzystane, bez żadnych informacji identyfikacyjnych (dlatego nigdy nie zawiera ona identyfikatorów serwera ani identyfikatorów użytkownika, ani żadnych wartości dostarczonych przez użytkownika i jest w pełni anonimowa). Telemetria jest przechowywana na czas nieokreślony, a pochodzące z niej dane statystyczne mają być wyświetlane i udostępniane publicznie w formie zbiorczej.',
      'telemetryOptOut' => 'Korzystając z projektu, użytkownicy zgadzają się domyślnie na kolekcję Telemetry. Jeśli użytkownik chce zrezygnować z kolekcji telemetrów, może podać swoje preferencje za pomocą odpowiedniej opcji na stronie <1/>.',
    ],
    'cookies' => [
      'heading' => 'Pliki cookies',
      'intro' => 'Pliki cookie są plikami o małej ilości danych. Pliki cookie są wysyłane do Twojej przeglądarki z witryny internetowej i przechowywane na dysku twardym komputera.',
      'disable' => 'Używamy plików "cookie" do przechowywania informacji. Mogą Państwo poinstruować swoją przeglądarkę, aby odrzucała wszystkie pliki cookie lub wskazywała, kiedy plik cookie jest wysyłany. Jeśli jednak nie zaakceptują Państwo plików cookie, mogą Państwo nie być w stanie korzystać z niektórych funkcji naszej Witryny.',
      'session' => 'W przypadku zalogowanych użytkowników trwałe ciasteczko jest używane do zapamiętania statusu zalogowanego w sesjach przeglądarki przez 30 dni. Jeśli chcesz przestać być zapamiętywany, możesz wylogować się lub wyczyścić pliki cookie ustawione przez naszą witrynę.',
    ],
    'security' => [
      'heading' => 'Bezpieczeństwo',
      'noGuarantee' => 'Bezpieczeństwo Państwa danych osobowych jest dla nas ważne, ale należy pamiętać,
że żadna metoda transmisji danych przez Internet lub elektronicznego przechowywania danych, nie jest w 100% bezpieczna. Chociaż staramy się używać komercyjnie akceptowalnych środków ochrony danych osobowych, nie możemy zagwarantować ich całkowitego bezpieczeństwa.',
      'httpsCloudFlare' => 'Witryna korzysta z HTTPS przy użyciu nowoczesnych zestawów szyfrowania TLS w celu ochrony integralności i bezpiecznego transportu danych pomiędzy przeglądarką a naszą witryną. Korzystamy jednak z usługi CloudFlare Reverse Proxy, co oznacza, że część danych przesyłanych na naszą Witrynę przechodzi przez ich serwery. CloudFlare działa w ramach własnej <1>polityki prywatności</1>.',
      'breachNotify' => 'W przypadku naruszenia bezpieczeństwa wszyscy użytkownicy zostaną powiadomieni w ciągu 24 godzin od wykrycia poprzez ogłoszenie zamieszczone na tej stronie, w odpowiedziach wysłanych przez bota i za pośrednictwem ogłoszenia na serwerze obsługi Discorda.',
    ],
  ],
  'terms' => [
    'heading' => 'Warunki i zasady',
    'license' => 'Cały kod źródłowy projektu jest udostępniany w serwisie GitHub w stanie, w jakim się znajduje, bez żadnych gwarancji ani odpowiedzialności. Aby uzyskać pełne warunki licencji, proszę zapoznać się z <1>licencją MIT</1>, której kopię można znaleźć w każdym repozytorium. Przedstawione poniżej warunki mają zastosowanie do wersji Projektu hostowanej przez Dewelopera ("Instancja"), a nałożonych ograniczeń nie należy traktować jako ograniczeń w korzystaniu z kodu źródłowego Projektu.',
    'noAbuse' => 'Nie wolno konfigurować automatyzacji w celu wielokrotnego uruchamiania poleceń za pośrednictwem instancji. Ten Bot nie jest przeznaczony do użycia przez zautomatyzowane narzędzia, takie jak inne boty lub jakiekolwiek inne oprogramowanie zaprojektowane do naśladowania legalnej aktywności użytkownika. Zamiast polegać na danych wyjściowych naszego bota do celów automatyzacji, proszę zapoznać się z dokumentacją języka programowania używanego przez twojego bota, aby dowiedzieć się, jak generować i manipulować znacznikami czasu UNIX.',
    'fuckWeb3' => 'Ta instancja nie może być wykorzystywana do wspomagania procesu szkolenia generatywnych modeli sztucznej inteligencji ani do ułatwiania żadnych zdarzeń i/lub transakcji związanych z niewymienialnymi tokenami ("NFT") lub jakąkolwiek formą kryptowaluty (np. Ethereum, Bitcoin).',
    'accessRevocation' => 'Twój dostęp do instancji może zostać cofnięty z jakichkolwiek powodów (w tym bez powodów) według uznania dewelopera. Przyczyny mogą obejmować między innymi: naruszenie tych warunków, celowe nadużycie cech instancji, groźby przemocy wobec deweloperów lub innych uczestników projektu, wykorzystanie instancji do celów złośliwych.',
  ],
  'changes' => [
    'heading' => 'Zmiany i poprawki',
    'effectiveFrom' => 'Regulamin i Polityka prywatności, zwane "Dokumentami", obowiązują od daty ich ostatniej aktualizacji i pozostaną w mocy, z wyjątkiem wszelkich zmian ich postanowień w przyszłości, które wejdą w życie natychmiast po ich opublikowaniu na tej stronie.',
    'rightToChange' => 'Zastrzegamy sobie prawo do aktualizacji lub zmiany niniejszych Dokumentów w dowolnym momencie i powinni Państwo okresowo sprawdzać tę stronę. Dalsze korzystanie przez Państwa z Projektu po opublikowaniu przez nas jakichkolwiek modyfikacji Dokumentów na tej stronie będzie stanowić Państwa potwierdzenie tych modyfikacji oraz zgodę na przestrzeganie i związanie się zmodyfikowanymi Dokumentami.',
    'willNotify' => 'Jeśli wprowadzimy jakiekolwiek istotne zmiany w tych dokumentach, powiadomimy Cię poprzez umieszczenie na naszej stronie widocznego wpisu, a także opublikowanie ogłoszenia na serwerze wsparcia Discorda.',
  ],
  'contact' => [
    'heading' => 'Skontaktuj się z nami',
    'whereToContact' => 'Jeśli masz jakiekolwiek pytania dotyczące tych Dokumentów lub chcesz poprosić o usunięcie przechowywanych przez nas danych osobowych, prosimy skontaktować się z nami za pośrednictwem <1>serwera Discord Bota</1> lub korzystając z dowolnej metody wymienionej na <3>stronie internetowej Dewelopera</3>.',
  ],
];
