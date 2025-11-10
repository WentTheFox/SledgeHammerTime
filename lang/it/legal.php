<?php

return [
  'translations' => [
    'title' => 'Contenuto Tradotto',
    'text' => 'Questo progetto contiene traduzioni effettuate da traduttori volontari e da altri membri della comunità. Queste traduzioni sono fornite per comodità degli utenti e potrebbero non essere sempre completamente aggiornate. In ogni caso, la <1>versione in lingua originale</1> di questa pagina è considerata efficace.',
  ],
  'lastUpdated' => 'Ultimo aggiornamento: <1/>',
  'privacy' => [
    'heading' => 'Informativa sulla Riservatezza',
    'operator' => '<0/> ("noi", "noi", "nostro", o "Sviluppatore") gestisce il sito web di HammerTime (il "Site"), e HammerTimeBot (il "Bot", o "App"), collettivamente il Progetto HammerTime (il "Progetto"). Questa pagina ti informa delle nostre politiche relative alla raccolta, utilizzo e divulgazione dei Dati Personali che riceviamo dagli utenti del Progetto ("tu", "Utente" o collettivamente "Utenti").',
    'notAffiliated' => 'Sebbene il nome "HammerTime" ("Nome del Progetto") derivi dal precedente nome "Hammer & Chisel" di Discord, Inc. ("Discord")<1/>, il Progetto non è affiliato in alcun modo, forma o modo a Discord, né a M.C. Hammer, la cui canzone<3/> presenta questa frase in modo prominente. Lo Sviluppatore non detiene alcun marchio o copyright sul Nome del Progetto.',
    'infoCollection' => [
      'heading' => 'Raccolta e uso delle informazioni',
      'pii' => 'Durante l\'utilizzo del Progetto, non le chiediamo né la incoraggiamo a fornirci alcuna informazione di identificazione personale ("PII", "Informazioni personali") che possa essere utilizzata per identificarla come individuo. Le PII possono includere, a titolo esemplificativo ma non esaustivo: il suo nome, la data di nascita, i numeri di identificazione nazionale, l\'ubicazione, il numero di telefono.',
      'auth' => 'L\'accesso viene fornito utilizzando l\'API OAuth 2 di Discord ("API"), che è anche protetta tramite HTTPS. Durante il processo di autenticazione OAuth, il nostro Sito non riceve il nome utente o la password, ma solo un token che può essere utilizzato per verificare l\'identità dell\'utente utilizzando questa API. Per motivi di performance, memorizziamo le informazioni di base fornite dall\'API (ID utente, nome utente corrente, nome visualizzato, link avatar) a livello locale.',
      'removal' => 'Queste informazioni non vengono rimosse automaticamente dal nostro database se disattivi il tuo account Discord, quindi assicurati di contattarci se desideri che i tuoi dati vengano rimossi.',
    ],
    'logData' => [
      'heading' => 'Registro Dati',
      'browserInfo' => 'Raccogliamo informazioni che il vostro browser invia ogni volta che visitate il nostro sito ("Dati log"). Questi dati di registro possono includere informazioni come l\'indirizzo IP del computer, il sistema operativo, tipo di browser, versione del browser, le pagine del nostro Sito visitato, l\'ora e la data della visita.',
      'thirdParty' => 'Questi Dati di registro vengono memorizzati solo all\'interno del nostro server e non vengono condivisi con terze parti. I dati di registro vengono utilizzati per scopi diagnostici e condivisi con le forze dell\'ordine, se esplicitamente richiesto. Vengono conservati per un massimo di 14 giorni e successivamente eliminati.',
      'debugging' => 'Il Bot può ricevere interazioni dagli Utenti tramite il client Discord, che include comandi slash e comandi del menu contestuale ("Azione", "Comando" o collettivamente "Comandi"). I comandi slash possono essere eseguiti anche con coppie chiave-valore strutturate fornite dall\'Utente ("Opzioni"). Il Bot registra le esecuzioni dei Comandi a scopo di debug, vale a dire: il nome utente Discord e l\'identificatore Snowflake ("ID") dell\'Utente che ha eseguito il Comando, il nome del Comando (comprese tutte le Opzioni) e l\'ID del Server in cui è stato eseguito il Comando. Questi dati sono conservati sul server del Progetto per un massimo di 30 giorni e sono accessibili solo allo Sviluppatore.',
      'noPii' => 'Quando esegui i comandi dovresti evitare di includere le informazioni personali. Alcune informazioni potrebbero essere conservate nel nostro Registro Applicazioni, quindi vi preghiamo di contattarci utilizzando i metodi descritti alla fine del presente documento per informarci se il nostro intervento è necessario.',
    ],
    'telemetry' => [
      'heading' => 'Telemetria & Statistiche',
      'statsCollection' => 'Al fine di valutare l\'utilizzo del Bot e quindi guidare le decisioni di sviluppo (ad esempio, l\'aggiunta/eliminazione di funzioni), può essere raccolta una serie specifica di dati sui comandi e sul loro utilizzo ("Telemetria"). Le informazioni di telemetria si limitano a quali comandi e opzioni sono stati utilizzati e quando sono stati utilizzati, senza alcuna informazione identificativa (pertanto non includono mai ID del server o dell\'utente, né valori forniti dall\'utente, e sono completamente anonimi). La telemetria viene archiviata a tempo indeterminato e le statistiche che ne derivano sono destinate ad essere visualizzate e condivise pubblicamente in forma aggregata.',
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
