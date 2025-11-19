<?php

return [
  'translations' => [
    'title' => 'Conținut tradus',
    'text' => 'Acest proiect conține traduceri realizate de traducători voluntari și alți membri ai comunității. Aceste traduceri sunt furnizate pentru confortul utilizatorilor și este posibil să nu fie întotdeauna complet actualizate. În toate cazurile, <1>versiunea în limba originală</1> a acestei pagini este considerată eficientă.',
  ],
  'lastUpdated' => 'Ultima actualizare: <1/>',
  'privacy' => [
    'heading' => 'Politica de confidențialitate',
    'operator' => '<0/> („noi”, „nostru” sau „Dezvoltator”) operează site-ul web HammerTime („Site-ul”) și HammerTimeBot („Botul” sau „Aplicația”), denumite colectiv Proiectul HammerTime („Proiectul”). Această pagină vă informează despre politicile noastre privind colectarea, utilizarea și divulgarea informațiilor personale pe care le primim de la utilizatorii Proiectului („dumneavoastră”, „Utilizator” sau, în mod colectiv „Utilizatori”).',
    'notAffiliated' => 'Deși denumirea „HammerTime” („Denumirea proiectului”) provine de la fosta denumire „Hammer & Chisel” a Discord, Inc. („Discord”)<1/>, proiectul nu are nicio legătură, sub nicio formă, cu Discord sau cu M.C. Hammer, a cărui melodie<3/> conține această expresie în mod proeminent. Dezvoltatorul nu deține niciun drept de marcă sau drept de autor asupra denumirii proiectului.',
    'infoCollection' => [
      'heading' => 'Colectarea și utilizarea informațiilor',
      'pii' => 'În timpul utilizării Proiectului, nu vă solicităm și nici nu vă încurajăm să ne furnizați informații de identificare personală („PII”, „Informații personale”) care pot fi utilizate pentru a vă identifica ca persoană fizică. PII pot include, fără a se limita la: numele dumneavoastră, data nașterii, numerele naționale de identificare, locația, numărul de telefon.',
      'auth' => 'Autentificarea este furnizată utilizând API-ul OAuth 2 al Discord („API”) care este, de asemenea, securizat utilizând HTTPS. În timpul procesului de autentificare OAuth, site-ul nostru nu primește numele de utilizator sau parola, ci doar un token care poate fi utilizat pentru a verifica identitatea utilizatorului folosind acest API. Din motive de performanță, stocăm local informațiile de bază furnizate de API (ID utilizator, nume de utilizator curent, nume de afișare, link avatar).',
      'removal' => 'Aceste informații nu sunt eliminate automat din baza noastră de date dacă vă dezactivați contul Discord, așa că asigurați-vă că ne contactați dacă doriți ca datele dvs. să fie eliminate.',
    ],
    'logData' => [
      'heading' => 'Date de jurnal',
      'browserInfo' => 'Colectăm informații pe care browserul dvs. le trimite ori de câte ori vizitați site-ul nostru („Date de jurnal”). Aceste date de jurnal pot include informații precum adresa IP a computerului dumneavoastră, sistemul de operare, tipul de browser, versiunea browserului, paginile site-ului nostru pe care le vizitați, ora și data vizitei dumneavoastră.',
      'thirdParty' => 'Aceste date de jurnal sunt stocate numai în cadrul serverului nostru și nu sunt partajate cu nicio terță parte. Datele de jurnal sunt utilizate în scopuri de diagnosticare și sunt partajate cu agențiile de aplicare a legii dacă se solicită în mod explicit. Acestea sunt păstrate timp de până la 14 zile și apoi eliminate.',
      'debugging' => 'Bot-ul poate primi interacțiuni de la utilizatori prin intermediul clientului Discord, care include comenzi slash și comenzi din meniul contextual („acțiune”, „comandă” sau, în mod colectiv, „comenzi”). Comenzile Slash pot fi executate în plus cu perechi cheie-valoare structurate furnizate de utilizator („opțiuni”). Botul înregistrează execuțiile comenzilor în scopuri de depanare, și anume: numele de utilizator Discord și identificatorul Snowflake („ID”) al utilizatorului care a executat comanda, numele comenzii (inclusiv toate opțiunile) și ID-ul serverului în care a fost executată comanda. Aceste date sunt stocate pe serverul Proiectului pentru o perioadă de până la 30 de zile și sunt accesibile doar Dezvoltatorului.',
      'noPii' => 'Atunci când executați comenzi, trebuie să evitați includerea oricăror informații personale. Unele informații pot fi totuși reținute în jurnalul nostru de aplicații, așa că vă rugăm să ne contactați folosind metodele descrise la sfârșitul acestui document pentru a ne notifica dacă este necesară intervenția noastră.',
    ],
    'telemetry' => [
      'heading' => 'Telemetrie & Statistici',
      'statsCollection' => 'Pentru a evalua utilizarea robotului și, prin urmare, pentru a conduce deciziile de dezvoltare (de exemplu, adăugarea/eliminarea de caracteristici), se poate colecta un set specific de date despre comenzi și utilizarea acestora („telemetrie”). Informațiile telemetrice se limitează la comanda și opțiunile care au fost utilizate și momentul în care au fost utilizate, fără nicio informație de identificare (prin urmare, nu includ niciodată ID-uri de server sau de utilizator, nici valori furnizate de utilizator și sunt complet anonime). Telemetria este stocată pe termen nelimitat, iar statisticile derivate din aceasta sunt destinate afișării și partajării publice în formă agregată.',
      'telemetryOptOut' => 'Prin utilizarea Proiectului, Utilizatorii sunt de acord cu colectarea datelor telemetrice în mod implicit. Dacă un Utilizator dorește să renunțe la colectarea datelor telemetrice, acesta poate indica preferința sa prin opțiunea corespunzătoare de pe pagina <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookie-uri',
      'intro' => 'Modulele cookie sunt fișiere cu o cantitate mică de date. Modulele cookie sunt trimise browserului dvs. de la un site web și stocate pe hard diskul computerului dvs.',
      'disable' => 'Utilizăm „module cookie” pentru a reține informații. Puteți instrui browserul dvs. să refuze toate modulele cookie sau să indice când este trimis un modul cookie. Cu toate acestea, dacă nu acceptați cookie-urile, este posibil să nu puteți utiliza anumite părți ale site-ului nostru.',
      'session' => 'Pentru utilizatorii conectați, se utilizează un cookie persistent pentru a memora starea de conectare pe durata sesiunilor de navigare timp de 30 de zile. Dacă doriți să nu mai fiți memorat, vă puteți deconecta sau șterge cookie-urile setate de site-ul nostru.',
    ],
    'security' => [
      'heading' => 'Securitate',
      'noGuarantee' => 'Securitatea informațiilor dvs. personale este importantă pentru noi, dar rețineți că nicio metodă de transmitere pe internet sau metodă de stocare electronică nu este 100% sigură. Deși ne străduim să folosim mijloace acceptabile din punct de vedere comercial pentru a vă proteja informațiile personale, nu putem garanta securitatea lor absolută.',
      'httpsCloudFlare' => 'Site-ul utilizează HTTPS folosind suite moderne de criptare TLS pentru a proteja integritatea și transportul securizat al datelor între browser și site-ul nostru. Cu toate acestea, utilizăm serviciul Reverse Proxy al CloudFlare, ceea ce înseamnă că o parte din datele trimise către site-ul nostru trec prin serverele lor. CloudFlare operează în conformitate cu propria <1>politică de confidențialitate</1>.',
      'breachNotify' => 'În cazul unei breșe de securitate, toți utilizatorii vor fi notificați în termen de 24 de ore de la descoperire printr-un anunț postat pe acest site web, în răspunsurile postate de Bot și prin intermediul unui anunț în serverul de suport Discord al Bot.',
    ],
  ],
  'terms' => [
    'heading' => 'Termeni & Condiții',
    'license' => 'Tot codul sursă al proiectului este furnizat pe GitHub ca atare, fără nicio garanție sau răspundere. Pentru termenii compleți ai licenței, vă rugăm să consultați <1>LicențaMIT</1>, o copie a căreia poate fi găsită în fiecare depozit. Termenii descriși mai jos se aplică versiunii Proiectului găzduită de Dezvoltator („Instanța”), iar limitările impuse în cadrul acesteia nu trebuie tratate ca restricții privind utilizarea codului sursă al Proiectului.',
    'noAbuse' => 'Nu trebuie să configurați automatizări pentru a executa comenzi prin intermediul instanței în mod repetat. Acest bot nu este conceput pentru a fi utilizat de instrumente automate, cum ar fi alți boți sau orice alt software conceput pentru a imita activitatea legitimă a utilizatorului. În loc să vă bazați pe rezultatul Bot-ului nostru în scopuri de automatizare, vă rugăm să consultați documentația limbajului de programare utilizat de bot-ul dvs. cu privire la modul de generare și manipulare a marcajelor de timp UNIX.',
    'fuckWeb3' => 'Această instanță nu va fi utilizată pentru a ajuta la procesul de formare a modelelor generative de inteligență artificială și nici pentru a facilita orice evenimente și/sau tranzacții legate de jetoane non-fungibile („NFT”) sau orice formă de criptomonedă (de exemplu, Ethereum, Bitcoin).',
    'accessRevocation' => 'Accesul dumneavoastră la Instanță poate fi revocat din orice motiv (inclusiv fără motiv) la discreția Dezvoltatorului. Motivele pot include, dar nu se limitează la: încălcarea acestor termeni, abuzul intenționat de caracteristicile Instanței, amenințările cu violența la adresa Dezvoltatorului sau a oricăruia dintre colaboratorii Proiectului, utilizarea Instanței în scopuri rău intenționate.',
  ],
  'changes' => [
    'heading' => 'Modificări & Revizuiri',
    'effectiveFrom' => 'Termenii și condițiile și Politica de confidențialitate, denumite în mod colectiv „Documente”, sunt în vigoare de la data ultimei actualizări și vor rămâne în vigoare, cu excepția oricăror modificări ale dispozițiilor acestora în viitor, care vor intra în vigoare imediat după publicarea pe această pagină.',
    'rightToChange' => 'Ne rezervăm dreptul de a actualiza sau modifica aceste Documente în orice moment și trebuie să verificați periodic această pagină. Utilizarea în continuare a Proiectului de către dvs. după publicarea oricăror modificări ale Documentelor pe această pagină va constitui recunoașterea de către dvs. a modificărilor și consimțământul dvs. de a respecta și a fi legat de Documentele modificate.',
    'willNotify' => 'În cazul în care efectuăm modificări importante ale acestor documente, vă vom notifica prin plasarea unui anunț vizibil pe site-ul nostru web, precum și prin postarea unui anunț pe serverul de suport Discord al Bot.',
  ],
  'contact' => [
    'heading' => 'Contactați-ne',
    'whereToContact' => 'Dacă aveți întrebări cu privire la aceste documente sau dacă doriți să solicitați eliminarea oricăror PII pe care le stocăm, vă rugăm să ne contactați prin intermediul <1>serverului Discord al botului</1> sau utilizând oricare dintre metodele enumerate pe <3>site-ul web al dezvoltatorului</3>.',
  ],
];
