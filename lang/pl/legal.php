<?php

return [
  'translations' => [
    'title' => 'Przetłumaczona zawartość',
    'text' => 'Ten projekt zawiera tłumaczenia wykonane przez tłumaczy-wolontariuszy i innych członków społeczności. Tłumaczenia te są udostępniane dla wygody użytkowników i nie zawsze mogą być w pełni aktualne. We wszystkich sprawach, <1>oryginalna wersja językowa</1> tej strony jest uważana za skuteczną.',
  ],
  'lastUpdated' => 'Ostatnia aktualizacja: <1/>',
  'privacy' => [
    'heading' => 'Polityka prywatności',
    'operator' => '<0/> ("my", "nas", "nasz" lub "Deweloper") obsługuje witrynę internetową HammerTime ("Witryna") i HammerTimeBot ("Bot" lub "Aplikacja"), łącznie Projekt HammerTime ("Projekt"). Niniejsza strona informuje Państwa o naszych zasadach dotyczących gromadzenia, wykorzystywania i ujawniania Danych osobowych, które otrzymujemy od użytkowników Projektu ("Państwo", "Użytkownik" lub łącznie "Użytkownicy").',
    'notAffiliated' => 'Chociaż nazwa "HammerTime" („nazwa projektu”) pochodzi z poprzedniej nazwy "Hammer & Chisel" Discorda, Inc. ("Discord")<1/> Projekt nie jest powiązany w żaden sposób, kształt ani formę, z Discord, ani M. C. Hammer, którego piosenka <3/> zawiera tę frazę. Deweloper nie posiada znaku towarowego ani praw autorskich nad nazwą projektu.',
    'infoCollection' => [
      'heading' => 'Gromadzenie i wykorzystywanie informacji',
      'pii' => 'Podczas korzystania z Projektu nie prosimy ani nie zachęcamy do podawania nam jakichkolwiek informacji umożliwiających identyfikację ("Dane osobowe"), które można wykorzystać do identyfikacji użytkownika jako osoby fizycznej. Dane osobowe mogą obejmować między innymi: imię i nazwisko, datę urodzenia, krajowe numery identyfikacyjne, lokalizację, numer telefonu.',
      'auth' => 'Logowanie odbywa się przy użyciu interfejsu API Discord OAuth 2 ("API"), który jest również zabezpieczony przy użyciu protokołu HTTPS. Podczas procesu uwierzytelniania OAuth nasza Witryna nie otrzymuje nazwy użytkownika ani hasła, a jedynie token, którego można użyć do weryfikacji tożsamości użytkownika za pomocą tego interfejsu API. Ze względów wydajnościowych przechowujemy podstawowe informacje dostarczane przez API (identyfikator użytkownika, aktualna nazwa użytkownika, nazwa wyświetlana, link do awatara) lokalnie.',
      'removal' => 'Informacje te nie są automatycznie usuwane z naszej bazy danych, jeśli dezaktywują Państwo swoje konto Discord, więc proszę się z nami skontaktować, jeśli chcą Państwo usunąć swoje dane.',
    ],
    'logData' => [
      'heading' => 'Dane dziennika',
      'browserInfo' => 'Zbieramy informacje, które Państwa przeglądarka wysyła za każdym razem, gdy odwiedzają Państwo naszą Witrynę ("Dane dziennika"). Dane dziennika mogą zawierać takie informacje, jak adres IP komputera, system operacyjny, typ przeglądarki, wersja przeglądarki, odwiedzane strony naszej Witryny, godzina i data wizyty.',
      'thirdParty' => 'Te Dane dziennika są przechowywane wyłącznie na naszym serwerze i nie są udostępniane żadnym stronom trzecim. Dane dziennika są wykorzystywane do celów diagnostycznych i udostępniane organom ścigania na wyraźne żądanie. Są one przechowywane przez okres do 14 dni, a następnie usuwane.',
      'debugging' => 'Bot może odbierać interakcje od Użytkowników za pośrednictwem klienta Discord, które obejmują komendy ukośnikowe i menu kontekstowego ("Akcja", "Polecenie", "Komenda" lub łącznie "Polecenia", "Komendy"). Komendy ukośnikowe mogą być dodatkowo wykonywane z dostarczonymi przez Użytkownika ustrukturyzowanymi parami klucz-wartość ("Opcje"). Bot rejestruje wykonania poleceń do celów debugowania, a mianowicie: nazwę użytkownika Discord i identyfikator Snowflake ("ID") użytkownika, który wykonał polecenie, nazwę polecenia (w tym wszystkie opcje) oraz identyfikator serwera, na którym polecenie zostało wykonane. Dane te są przechowywane na serwerze Projektu przez okres do 30 dni i są dostępne wyłącznie dla Dewelopera.',
      'noPii' => 'Podczas wykonywania poleceń należy unikać uwzględniania jakichkolwiek danych osobowych. Niektóre informacje mogą być nadal przechowywane w naszym dzienniku aplikacji, więc proszę skontaktować się z nami przy użyciu metod opisanych na końcu niniejszego dokumentu, aby poinformować nas, jeśli nasza interwencja jest potrzebna.',
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
