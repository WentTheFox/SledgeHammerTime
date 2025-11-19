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
      'pii' => 'While using the Project we do not ask nor encourage you to provide us with any Personally Identifiable Information ("PII", "Personal Information") that can be used to identify you as an individual. PII may include, but is not limited to: your name, birth date, national identification numbers, location, phone number.',
      'auth' => 'Autentificarea se realizează utilizând API-ul OAuth 2 („API”) al Discord, care este, de asemenea, securizat utilizând HTTPS. În timpul procesului de autentificare OAuth, site-ul nostru nu primește numele de utilizator sau parola, ci doar un token care poate fi utilizat pentru a verifica identitatea utilizatorului utilizând acest API. Din motive de performanță, stocăm local informațiile de bază furnizate de API (ID-ul utilizatorului, numele de utilizator curent, numele afișat, linkul avatarului).',
      'removal' => 'Aceste informații nu sunt șterse automat din baza noastră de date dacă îți dezactivezi contul Discord, așa că nu uita să ne contactezi dacă dorești ca datele tale să fie șterse.',
    ],
    'logData' => [
      'heading' => 'Log Data',
      'browserInfo' => 'We collect information that your browser sends whenever you visit our Site ("Log Data"). This Log Data may include information such as your computer\'s IP address, operating system, browser type, browser version, the pages of our Site that you visit, the time and date of your visit.',
      'thirdParty' => 'This Log Data is stored only within our server and is not shared with any third party. Log Data is used for diagnostic purposes, and shared with law enforcement agencies if explicitly requested. It is kept for up to 14 days and discarded afterwards.',
      'debugging' => 'The Bot can receive interactions from Users via the Discord client, which includes slash commands and context menu commands ("Action", "Command", or collectively "Commands"). Slash commands can additionally be executed with User-supplied structured key-value pairs ("Options"). The Bot records Command executions for debugging purposes, namely: the Discord username and Snowflake identifier ("ID") of the User that executed the Command, the name of the Command (including all Options) and the ID of the Server the Command was executed in. This data is stored on the Project server for up to 30 days, and is only accessible by the Developer.',
      'noPii' => 'When executing Commands you should avoid including any Personal Information. Some information may still be retained in our Application Log, so please contact us using the methods described at the end of this document to notify us if our intervention is needed.',
    ],
    'telemetry' => [
      'heading' => 'Telemetrie & Statistici',
      'statsCollection' => 'In order to assess the Bot\'s usage and thereby drive development decisions (e.g. the addition/removal of features) a specific set of data about Commands and their usage may be collected ("Telemetry"). Telemetry information is limited to which command and options were used, and when they were used, without any identifying information (therefore it never includes server or user IDs, nor any user-supplied values, and is fully anonymous). Telemetry is stored indefinitely and statistics derived from it are intended to be displayed and shared publicly in aggregate form.',
      'telemetryOptOut' => 'Prin utilizarea Proiectului, Utilizatorii sunt de acord cu colectarea datelor telemetrice în mod implicit. Dacă un Utilizator dorește să renunțe la colectarea datelor telemetrice, acesta poate indica preferința sa prin opțiunea corespunzătoare de pe pagina <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookie-uri',
      'intro' => 'Cookies are files with small amount of data. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.',
      'disable' => 'Utilizăm „cookie-uri” pentru a stoca informații. Puteți seta browserul să refuze toate cookie-urile sau să vă avertizeze când un cookie este trimis. Cu toate acestea, dacă nu acceptați cookie-urile, este posibil să nu puteți utiliza anumite părți ale site-ului nostru.',
      'session' => 'Pentru utilizatorii conectați, se utilizează un cookie persistent pentru a memora starea de conectare pe durata sesiunilor de navigare timp de 30 de zile. Dacă doriți să nu mai fiți memorat, vă puteți deconecta sau șterge cookie-urile setate de site-ul nostru.',
    ],
    'security' => [
      'heading' => 'Securitate',
      'noGuarantee' => 'The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.',
      'httpsCloudFlare' => 'The Site makes use of HTTPS using modern TLS encryption suites to protect the integrity and secure transport of data between the browser and our Site. However, we make use of CloudFlare\'s Reverse Proxy service, meaning some portion of the data sent to our Site passes through their servers. CloudFlare operates under their own <1>privacy policy</1>.',
      'breachNotify' => 'În cazul unei breșe de securitate, toți utilizatorii vor fi notificați în termen de 24 de ore de la descoperire printr-un anunț publicat pe acest site web, în răspunsurile postate de Bot și printr-un anunț pe serverul de suport Discord al Botului.',
    ],
  ],
  'terms' => [
    'heading' => 'Termeni & Condiții',
    'license' => 'Tot codul sursă al Proiectului este furnizat pe GitHub așa cum este, fără nicio garanție sau răspundere. Pentru termenii completi ai licenței, vă rugăm să consultați <1>licența MIT</1>, o copie a acesteia putând fi găsită în fiecare depozit. Termenii prezentați mai jos se aplică versiunii Proiectului găzduite de Dezvoltator („Instanța”) iar limitările impuse în cadrul acesteia nu trebuie tratate ca restricții privind utilizarea codului sursă al Proiectului.',
    'noAbuse' => 'You must not set up automations to run Commands via the Instance repeatedly. This Bot is not meant to be used by automated tools, such as other bots, or any other software designed to mimic legitimate user activity. Instead of relying on our Bot\'s output for automation purposes, please refer to the documentation of the programming language used by your bot on how to generate and manipulate UNIX timestamps.',
    'fuckWeb3' => 'This Instance shall not be used to aid in the process of training generative AI models, nor to help facilitate any events and/or transactions related to non-fungible tokens ("NFTs") or any form of cryptocurrency (e.g. Ethereum, Bitcoin).',
    'accessRevocation' => 'Accesul dvs. la Instanță poate fi revocat din orice motiv (inclusiv fără motiv) la discreția Dezvoltatorului. Motivele pot include, dar nu se limitează la: încălcarea acestor termeni, abuzul intenționat al funcțiilor Instanței, amenințări cu violență față de Dezvoltator sau oricare dintre colaboratorii Proiectului, utilizarea Instanței în scopuri rău intenționate.',
  ],
  'changes' => [
    'heading' => 'Modificări & Revizuiri',
    'effectiveFrom' => 'The Terms & Conditions and Privacy Policy, collectively "Documents", are effective as of their last update date and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page.',
    'rightToChange' => 'We reserve the right to update or change these Documents at any time and you should check this page periodically. Your continued use of the Project after we post any modifications to the Documents on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Documents.',
    'willNotify' => 'Dacă vom aduce modificări semnificative acestor Documente, vă vom notifica prin afișarea unui anunț vizibil pe site-ul nostru web, precum și prin publicarea unui anunț pe serverul de suport Discord al Botului.',
  ],
  'contact' => [
    'heading' => 'Contactați-ne',
    'whereToContact' => 'Dacă aveți întrebări cu privire la aceste documente sau doriți să solicitați ștergerea oricăror informații personale pe care le stocăm, vă rugăm să ne contactați prin intermediul <1>serverului Discord al botului</1> sau utilizând oricare dintre metodele enumerate pe <3>site-ul web al dezvoltatorului</3>.',
  ],
];
