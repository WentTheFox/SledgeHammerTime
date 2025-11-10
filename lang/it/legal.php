<?php

return [
  'translations' => [
    'title' => 'Translated Content',
    'text' => 'This project contains translations by volunteer translators and other members of the community. These translations are provided for users\' convenience, and may not always be fully up-to-date. In all matters, the <1>original language version</1> of this page is considered effective.',
  ],
  'lastUpdated' => 'Last updated: <1/>',
  'privacy' => [
    'heading' => 'Privacy Policy',
    'operator' => '<0/> ("us", "we", "our", or "Developer") operates the HammerTime website (the "Site"), and HammerTimeBot (the "Bot", or "App"), collectively the HammerTime Project (the "Project"). This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Project ("you", "User", or collectively "Users").',
    'notAffiliated' => 'Although the "HammerTime" name ("Project Name") is derived from the former name "Hammer & Chisel" of Discord, Inc. ("Discord")<1/> the Project is not affiliated in any way, shape, or form, with Discord, nor M.C. Hammer, whose song<3/> features this phrase prominently. The Developer holds no trademark or copyright over the Project Name.',
    'infoCollection' => [
      'heading' => 'Information Collection And Use',
      'pii' => 'While using the Project we do not ask nor encourage you to provide us with any Personally Identifiable Information ("PII", "Personal Information") that can be used to identify you as an individual. PII may include, but is not limited to: your name, birth date, national identification numbers, location, phone number.',
      'auth' => 'Sign in is provided using Discord\'s OAuth 2 API ("API") which is also secured using HTTPS. During the OAuth authentication process our Site does not receive the username or password, only a token that can be used to verify the user\'s identity using this API. For performance reasons we store the basic information provided by the API (user ID, current username, display name, avatar link) locally.',
      'removal' => 'This information is not removed from our database automatically if you deactivate your Discord account, so be sure to reach out to us if you would like your data removed.',
    ],
    'logData' => [
      'heading' => 'Log Data',
      'browserInfo' => 'We collect information that your browser sends whenever you visit our Site ("Log Data"). This Log Data may include information such as your computer\'s IP address, operating system, browser type, browser version, the pages of our Site that you visit, the time and date of your visit.',
      'thirdParty' => 'This Log Data is stored only within our server and is not shared with any third party. Log Data is used for diagnostic purposes, and shared with law enforcement agencies if explicitly requested. It is kept for up to 14 days and discarded afterwards.',
      'debugging' => 'The Bot can receive interactions from Users via the Discord client, which includes slash commands and context menu commands ("Action", "Command", or collectively "Commands"). Slash commands can additionally be executed with User-supplied structured key-value pairs ("Options"). The Bot records Command executions for debugging purposes, namely: the Discord username and Snowflake identifier ("ID") of the User that executed the Command, the name of the Command (including all Options) and the ID of the Server the Command was executed in. This data is stored on the Project server for up to 30 days, and is only accessible by the Developer.',
      'noPii' => 'When executing Commands you should avoid including any Personal Information. Some information may still be retained in our Application Log, so please contact us using the methods described at the end of this document to notify us if our intervention is needed.',
    ],
    'telemetry' => [
      'heading' => 'Telemetry & Statistics',
      'statsCollection' => 'In order to assess the Bot\'s usage and thereby drive development decisions (e.g. the addition/removal of features) a specific set of data about Commands and their usage may be collected ("Telemetry"). Telemetry information is limited to which command and options were used, and when they were used, without any identifying information (therefore it never includes server or user IDs, nor any user-supplied values, and is fully anonymous). Telemetry is stored indefinitely and statistics derived from it are intended to be displayed and shared publicly in aggregate form.',
      'telemetryOptOut' => 'Utilizzando il Progetto, gli Utenti accettano la raccolta della Telemetria per impostazione predefinita. Se un Utente desidera rinunciare alla raccolta della Telemetria, può indicare la sua preferenza tramite l\'opzione appropriata nella pagina <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookie',
      'intro' => 'I cookie sono file con una piccola quantità di dati. I cookie vengono inviati al browser da un sito web e memorizzati sul disco rigido del computer.',
      'disable' => 'Utilizziamo i "cookie" per conservare le informazioni. Puou indicare al tuo browser di rifiutare tutti i cookie o di segnalare l\'invio di un cookie. Tuttavia, se non accetti i cookie, potresti non essere in grado di utilizzare alcune parti del nostro Sito.',
      'session' => 'Per gli utenti che hanno effettuato l\'accesso, viene utilizzato un cookie persistente per ricordare lo stato di accesso attraverso le sessioni del browser per 30 giorni. Se desideri non essere più ricordato, puoi uscire o cancellare i cookie impostati dal nostro Sito.',
    ],
    'security' => [
      'heading' => 'Sicurezza',
      'noGuarantee' => 'La sicurezza delle informazioni personali è importante per noi, ma ricorda che nessun metodo di trasmissione su internet, o metodo di archiviazione elettronica è sicuro al 100%. Mentre ci sforziamo di utilizzare mezzi commercialmente accettabili per proteggere le informazioni personali, non possiamo garantirne l\'assoluta sicurezza.',
      'httpsCloudFlare' => 'Il Sito utilizza il protocollo HTTPS con le moderne suite di crittografia TLS per proteggere l\'integrità e il trasporto sicuro dei dati tra il browser e il nostro Sito. Tuttavia, utilizziamo il servizio Reverse Proxy di CloudFlare, il che significa che una parte dei dati inviati al nostro Sito passa attraverso i loro server. CloudFlare opera in base alla propria <1>politica sulla privacy</1>.',
      'breachNotify' => 'In caso di violazione della sicurezza, tutti gli utenti saranno avvisati entro 24 ore dalla scoperta tramite un avviso pubblicato su questo sito web, nelle risposte pubblicate dal Bot e tramite un annuncio nel server di supporto Discord del Bot.',
    ],
  ],
  'terms' => [
    'heading' => 'Termini & Condizioni',
    'license' => 'Tutto il codice sorgente del progetto è fornito su GitHub così com\'è, senza alcuna garanzia o responsabilità. Per i termini di licenza completi, vedere la licenza <1>MIT</1>, una copia della quale può essere trovata in ogni repository. I termini descritti di seguito si applicano alla versione del Progetto ospitata dallo Sviluppatore ("Istanza") e le limitazioni imposte all\'interno non devono essere considerati come restrizioni all\'uso del codice sorgente del progetto.',
    'noAbuse' => 'Non è necessario impostare automazioni per eseguire comandi tramite Istanza ripetutamente. Questo Bot non è destinato ad essere utilizzato da strumenti automatizzati, come altri bot, o qualsiasi altro software progettato per imitare l\'attività legittima dell\'utente. Invece di fare affidamento sull\'output del nostro Bot per scopi di automazione, fare riferimento alla documentazione del linguaggio di programmazione utilizzato dal bot su come generare e manipolare timestamp UNIX.',
    'fuckWeb3' => 'La presente istanza non deve essere utilizzata per favorire il processo di formazione dei modelli di IA generativa, né per facilitare eventuali eventi e/o transazioni relativi a token non fungibili ("NFTs") o qualsiasi forma di criptovaluta (e.. Ethereum, Bitcoin).',
    'accessRevocation' => 'L\'accesso all\'istanza può essere revocato per qualsiasi motivo (incluso nessun motivo) a discrezione dello Sviluppatore. Le ragioni possono includere, ma non si limitano a: violazione di questi termini, abuso intenzionale delle caratteristiche dell\'Istanza, minacce di violenza nei confronti dello Sviluppatore o di uno qualsiasi dei collaboratori del Progetto, l\'uso dell\'Istanza per scopi dannosi.',
  ],
  'changes' => [
    'heading' => 'Modifiche & Revisioni',
    'effectiveFrom' => 'I Termini e le Condizioni e l\'Informativa sulla privacy, collettivamente "Documenti", sono in vigore alla data del loro ultimo aggiornamento e rimarranno in vigore, salvo per quanto riguarda eventuali modifiche future delle sue disposizioni, che saranno in vigore immediatamente dopo la pubblicazione su questa pagina.',
    'rightToChange' => 'Ci riserviamo il diritto di aggiornare o modificare questi Documenti in qualsiasi momento e lei dovrebbe controllare periodicamente questa pagina. L\'uso continuato del Progetto da parte dell\'utente dopo la pubblicazione di eventuali modifiche ai Documenti su questa pagina costituirà il riconoscimento delle modifiche e il consenso a rispettare ed essere vincolati dai Documenti modificati.',
    'willNotify' => 'Se apportiamo modifiche sostanziali a questi Documenti, la informeremo inserendo un avviso in evidenza sul nostro sito web, nonché pubblicando un annuncio nel server di supporto Discord del Bot.',
  ],
  'contact' => [
    'heading' => 'Contattaci',
    'whereToContact' => 'Se hai domande su questi Documenti o desideri richiedere la rimozione di qualsiasi PII che memorizziamo, ci contatti tramite <1>il server Discord del Bot</1> o utilizzando uno dei metodi elencati sul <3>sito web dello sviluppatore</3>.',
  ],
];
