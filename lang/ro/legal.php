<?php

return [
  'translations' => [
    'title' => 'Conținut tradus',
    'text' => 'Acest proiect conține traduceri realizate de traducători voluntari și alți membri ai comunității. Aceste traduceri sunt furnizate pentru comoditatea utilizatorilor și este posibil să nu fie întotdeauna complet actualizate. În toate aspectele, <1>versiunea în limba originală engleză</1> a acestei pagini este considerată valabilă.',
  ],
  'lastUpdated' => 'Ultima actualizare: <1/>',
  'privacy' => [
    'heading' => 'Politica de confidențialitate',
    'operator' => '<0/> („noi”, „nostru” sau „Dezvoltator”) operează site-ul web HammerTime („Site-ul”) și HammerTimeBot („Botul” sau „Aplicația”), denumite colectiv Proiectul HammerTime („Proiectul”). Această pagină vă informează despre politicile noastre privind colectarea, utilizarea și divulgarea informațiilor personale pe care le primim de la utilizatorii Proiectului („dumneavoastră”, „Utilizator” sau, în mod colectiv „Utilizatori”).',
    'notAffiliated' => 'Deși denumirea „HammerTime” („Denumirea proiectului”) provine de la fosta denumire „Hammer & Chisel” a Discord, Inc. („Discord”)<1/>, proiectul nu are nicio legătură, sub nicio formă, cu Discord sau cu M.C. Hammer, a cărui melodie<3/> conține această expresie în mod proeminent. Dezvoltatorul nu deține niciun drept de marcă sau drept de autor asupra denumirii proiectului.',
    'infoCollection' => [
      'heading' => 'Colectarea și utilizarea informațiilor',
      'pii' => 'În timpul utilizării Proiectului, nu vă solicităm și nu vă încurajăm să ne furnizați informații de identificare personală („PII”, „Informații personale”) care pot fi utilizate pentru a vă identifica ca persoană fizică. PII pot include, fără a se limita la: numele, data nașterii, numerele de identificare naționale, locația, numărul de telefon.',
      'auth' => 'Autentificarea se realizează utilizând API-ul OAuth 2 („API”) al Discord, care este, de asemenea, securizat utilizând HTTPS. În timpul procesului de autentificare OAuth, site-ul nostru nu primește numele de utilizator sau parola, ci doar un token care poate fi utilizat pentru a verifica identitatea utilizatorului utilizând acest API. Din motive de performanță, stocăm local informațiile de bază furnizate de API (ID-ul utilizatorului, numele de utilizator curent, numele afișat, linkul avatarului).',
      'removal' => 'Aceste informații nu sunt șterse automat din baza noastră de date dacă îți dezactivezi contul Discord, așa că nu uita să ne contactezi dacă dorești ca datele tale să fie șterse.',
    ],
    'logData' => [
      'heading' => 'Date jurnal',
      'browserInfo' => 'Colectăm informațiile pe care browserul dvs. le trimite de fiecare dată când vizitați Site-ul nostru („Date de jurnal”). Aceste Date de jurnal pot include informații precum adresa IP a computerului dvs., sistemul de operare, tipul browserului, versiunea browserului, paginile Site-ului nostru pe care le vizitați, ora și data vizitei dvs.',
      'thirdParty' => 'Aceste date de jurnal sunt stocate numai pe serverul nostru și nu sunt partajate cu terți. Datele de jurnal sunt utilizate în scopuri de diagnosticare și sunt partajate cu organele de aplicare a legii, dacă se solicită în mod explicit acest lucru. Acestea sunt păstrate timp de maximum 14 zile, după care sunt șterse.',
      'debugging' => 'Botul poate primi interacțiuni de la utilizatori prin intermediul clientului Discord, care include comenzi slash și comenzi din meniul contextual („Acțiune”, „Comandă” sau, colectiv, „Comenzi”). Comenzile slash pot fi executate suplimentar cu perechi structurate de chei-valori furnizate de utilizator („Opțiuni”). Botul înregistrează execuțiile comenzilor în scopuri de depanare, și anume: numele de utilizator Discord și identificatorul Snowflake („ID”) al utilizatorului care a executat comanda, numele comenzii (inclusiv toate opțiunile) și ID-ul serverului pe care a fost executată comanda. Aceste date sunt stocate pe serverul proiectului timp de maximum 30 de zile și sunt accesibile numai dezvoltatorului.',
      'noPii' => 'Când executați comenzi, ar trebui să evitați includerea oricăror informații personale. Anumite informații pot fi păstrate în jurnalul nostru de aplicații, așa că vă rugăm să ne contactați folosind metodele descrise la sfârșitul acestui document pentru a ne anunța dacă este necesară intervenția noastră.',
    ],
    'telemetry' => [
      'heading' => 'Telemetrie & Statistici',
      'statsCollection' => 'Pentru a evalua utilizarea Botului și a lua astfel decizii de dezvoltare (de exemplu, adăugarea/eliminarea de funcții), poate fi colectat un set specific de date despre comenzi și utilizarea acestora („Telemetrie”). Informațiile telemetrice se limitează la comenzile și opțiunile utilizate și la momentul utilizării acestora, fără a include informații de identificare (prin urmare, nu includ niciodată ID-urile serverului sau ale utilizatorului, nici valorile furnizate de utilizator și sunt complet anonime). Telemetria este stocată pe termen nelimitat, iar statisticile derivate din aceasta sunt destinate afișării și partajării publice sub formă agregată.',
      'telemetryOptOut' => 'Prin utilizarea Proiectului, Utilizatorii sunt de acord cu colectarea datelor telemetrice în mod implicit. Dacă un Utilizator dorește să renunțe la colectarea datelor telemetrice, acesta poate indica preferința sa prin opțiunea corespunzătoare de pe pagina <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookie-uri',
      'intro' => 'Cookie-urile sunt fișiere cu o cantitate mică de date. Cookie-urile sunt trimise către browserul dvs. de pe un site web și stocate pe hard diskul computerului dvs.',
      'disable' => 'Utilizăm „cookie-uri” pentru a stoca informații. Puteți seta browserul să refuze toate cookie-urile sau să vă avertizeze când un cookie este trimis. Cu toate acestea, dacă nu acceptați cookie-urile, este posibil să nu puteți utiliza anumite părți ale site-ului nostru.',
      'session' => 'Pentru utilizatorii conectați, se utilizează un cookie persistent pentru a memora starea de conectare pe durata sesiunilor de navigare timp de 30 de zile. Dacă doriți să nu mai fiți memorat, vă puteți deconecta sau șterge cookie-urile setate de site-ul nostru.',
    ],
    'security' => [
      'heading' => 'Securitate',
      'noGuarantee' => 'Securitatea informațiilor dvs. personale este importantă pentru noi, dar rețineți că nicio metodă de transmitere prin Internet sau metodă de stocare electronică nu este 100% sigură. Deși ne străduim să utilizăm mijloace acceptabile din punct de vedere comercial pentru a vă proteja informațiile personale, nu putem garanta securitatea absolută a acestora.',
      'httpsCloudFlare' => 'Site-ul utilizează HTTPS cu suite moderne de criptare TLS pentru a proteja integritatea și transportul securizat al datelor între browser și site-ul nostru. Cu toate acestea, utilizăm serviciul Reverse Proxy al CloudFlare, ceea ce înseamnă că o parte din datele trimise către site-ul nostru trec prin serverele lor. CloudFlare operează în conformitate cu propria <1>politică de confidențialitate</1>.',
      'breachNotify' => 'În cazul unei breșe de securitate, toți utilizatorii vor fi notificați în termen de 24 de ore de la descoperire printr-un anunț publicat pe acest site web, în răspunsurile postate de Bot și printr-un anunț pe serverul de suport Discord al Botului.',
    ],
  ],
  'terms' => [
    'heading' => 'Termeni & Condiții',
    'license' => 'Tot codul sursă al Proiectului este furnizat pe GitHub așa cum este, fără nicio garanție sau răspundere. Pentru termenii completi ai licenței, vă rugăm să consultați <1>licența MIT</1>, o copie a acesteia putând fi găsită în fiecare depozit. Termenii prezentați mai jos se aplică versiunii Proiectului găzduite de Dezvoltator („Instanța”) iar limitările impuse în cadrul acesteia nu trebuie tratate ca restricții privind utilizarea codului sursă al Proiectului.',
    'noAbuse' => 'Nu trebuie să configurați automatizări pentru a rula comenzi prin intermediul instanței în mod repetat. Acest bot nu este destinat utilizării de către instrumente automatizate, cum ar fi alți boți sau orice alt software conceput pentru a imita activitatea legitimă a utilizatorilor. În loc să vă bazați pe rezultatele botului nostru în scopuri de automatizare, vă rugăm să consultați documentația limbajului de programare utilizat de botul dvs. pentru a afla cum să generați și să manipulați timestamp-urile UNIX.',
    'fuckWeb3' => 'Această Instanță nu va fi utilizată pentru a ajuta la procesul de instruire a modelelor de IA generative, nici pentru a facilita evenimente și/sau tranzacții legate de tokenuri nefungibile („NFT”) sau orice formă de criptomonedă (de exemplu, Ethereum, Bitcoin).',
    'accessRevocation' => 'Accesul dvs. la Instanță poate fi revocat din orice motiv (inclusiv fără motiv) la discreția Dezvoltatorului. Motivele pot include, dar nu se limitează la: încălcarea acestor termeni, abuzul intenționat al funcțiilor Instanței, amenințări cu violență față de Dezvoltator sau oricare dintre colaboratorii Proiectului, utilizarea Instanței în scopuri rău intenționate.',
  ],
  'changes' => [
    'heading' => 'Modificări & Revizuiri',
    'effectiveFrom' => 'Termenii și condițiile și Politica de confidențialitate, denumite colectiv „Documente”, intră în vigoare la data ultimei actualizări și vor rămâne în vigoare, cu excepția oricăror modificări ale prevederilor sale în viitor, care vor intra în vigoare imediat după publicarea pe această pagină.',
    'rightToChange' => 'Ne rezervăm dreptul de a actualiza sau modifica aceste Documente în orice moment, iar dumneavoastră trebuie să verificați periodic această pagină. Utilizarea în continuare a Proiectului după publicarea oricăror modificări aduse Documentelor pe această pagină va constitui recunoașterea modificărilor și consimțământul dumneavoastră de a respecta și de a fi obligat să respectați Documentele modificate.',
    'willNotify' => 'Dacă vom aduce modificări semnificative acestor Documente, vă vom notifica prin afișarea unui anunț vizibil pe site-ul nostru web, precum și prin publicarea unui anunț pe serverul de suport Discord al Botului.',
  ],
  'contact' => [
    'heading' => 'Contactați-ne',
    'whereToContact' => 'Dacă aveți întrebări cu privire la aceste documente sau doriți să solicitați ștergerea oricăror informații personale pe care le stocăm, vă rugăm să ne contactați prin intermediul <1>serverului Discord al botului</1> sau utilizând oricare dintre metodele enumerate pe <3>site-ul web al dezvoltatorului</3>.',
  ],
];
