<?php

return [
  'translations' => [
    'title' => 'Vertaalde inhoud',
    'text' => 'Dit project bevat vertalingen van vrijwillige vertalers en andere leden van de community. Deze vertalingen zijn gemaakt voor gebruiksgemak en zijn mogelijk niet altijd up-to-date. De <1>originele taal</1> van deze pagina wordt altijd als geldig beschouwd.',
  ],
  'lastUpdated' => 'Laatst bijgewerkt op: <1/>',
  'privacy' => [
    'heading' => 'Privacybeleid',
    'operator' => '<0/> ("ons", "wij", "onze", of "ontwikkelaar") beheert de HammerTime website (de "site"), en HammerTimeBot (de "Bot", of "App"), gezamenlijk het HammerTime Project (het "Project"). Deze pagina informeert u over ons beleid betreffende het verzamelen, gebruiken en openbaar maken van Persoonlijke Informatie die wij ontvangen van gebruikers van het Project ("u", "Gebruiker", of gezamenlijk "Gebruikers").',
    'notAffiliated' => 'Hoewel de naam "HammerTime" ("Projectnaam") is afgeleid van de voormalige naam "Hammer & Chisel" van Discord, Inc. ("Discord") <1/> is het project op geen enkele manier verbonden met Discord, noch met M.C. Hammer, wiens lied<3/> deze zin prominent bevat. De ontwikkelaar heeft geen handelsmerk of auteursrecht van de Projectnaam.',
    'infoCollection' => [
      'heading' => 'Verzamelen en gebruiken van informatie',
      'pii' => 'Tijdens het gebruik van det Project vragen of moedigen wij u niet aan om ons enige Persoonlijk Identificeerbare Informatie ("PII", "Persoonlijke Informatie") te verstrekken die gebruikt kan worden om u als individu te identificeren. PII kan bestaan uit, maar is niet beperkt tot: uw naam, geboortedatum, nationale indentificatienummers, locatie, telefoonnummer.',
      'auth' => 'Aanmelden gebeurt met behulp van Discord\'s OAuth 2 API ("API") die ook beveiligd is met HTTPS. Tijdens het OAuth-verificatieproces ontangt onze site niet de gebruikersnaam of het wachtwoord, maar alleen een token dat kan worden gebruikt om de identiteit van de gebruiker te verifiëren met behulp van deze API. Voor prestatieredenen slaan wij de door de API verstrekte basisinformatie (gebruikers-ID, huidige gebruikersnaam, weergavenaam, avater-link) lokaal op.',
      'removal' => 'This information is not removed from our database automatically if you deactivate your Discord account, so be sure to reach out to us if you would like your data removed.',
    ],
    'logData' => [
      'heading' => 'Logdata',
      'browserInfo' => 'We collect information that your browser sends whenever you visit our Site ("Log Data"). This Log Data may include information such as your computer\'s IP address, operating system, browser type, browser version, the pages of our Site that you visit, the time and date of your visit.',
      'thirdParty' => 'This Log Data is stored only within our server and is not shared with any third party. Log Data is used for diagnostic purposes, and shared with law enforcement agencies if explicitly requested. It is kept for up to 14 days and discarded afterwards.',
      'debugging' => 'The Bot can receive interactions from Users via the Discord client, which includes slash commands and context menu commands ("Action", "Command", or collectively "Commands"). Slash commands can additionally be executed with User-supplied structured key-value pairs ("Options"). The Bot records Command executions for debugging purposes, namely: the Discord username and Snowflake identifier ("ID") of the User that executed the Command, the name of the Command (including all Options) and the ID of the Server the Command was executed in. This data is stored on the Project server for up to 30 days, and is only accessible by the Developer.',
      'noPii' => 'When executing Commands you should avoid including any Personal Information. Some information may still be retained in our Application Log, so please contact us using the methods described at the end of this document to notify us if our intervention is needed.',
    ],
    'telemetry' => [
      'heading' => 'Telemetry & Statistics',
      'statsCollection' => 'In order to assess the Bot\'s usage and thereby drive development decisions (e.g. the addition/removal of features) a specific set of data about Commands and their usage may be collected ("Telemetry"). Telemetry information is limited to which command and options were used, and when they were used, without any identifying information (therefore it never includes server or user IDs, nor any user-supplied values, and is fully anonymous). Telemetry is stored indefinitely and statistics derived from it are intended to be displayed and shared publicly in aggregate form.',
      'telemetryOptOut' => 'By using the Project, Users agree to the collection of Telemetry by default. If a User wishes to opt out of Telemetry collection, they may indicate their preference via the appropriate option on the <1/> page.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies zijn bestanden met een kleine hoeveelheid aan gegevens. Cookies worden vanaf een website naar uw browser gestuurd en opgeslagen op de harde schijf van up computer.',
      'disable' => 'We gebruiken "cookies" om informatie op te slaan. Je kan je zoekmachine aanpassen om geen cookies op te slaan of om een melding te ontvangen wanneer ze worden gebruikt. Maar als je de cookies niet accepteert, is er een mogelijkheid dat je sommige delen van de website niet kan gebruiken.',
      'session' => 'Voor ingelogde gebruikers wordt er een blijvende cookie gebruikt om de ingelogde status in browsersessies gedurende 30 dagen te onthouden. Als u niet meer wil herinnerd worden, kunt u zich afmelden of de door onze Site Ingestelde cookies wissen.',
    ],
    'security' => [
      'heading' => 'Beveiliging',
      'noGuarantee' => 'De beveiliging van uw persoonlijke informatie is belangrijk voor ons, maar onthoud dat er geen manier van overdracht via het internet of methode van elektronische opslag 100% veilig is. Terwijl we ernaar streven om commercieel aanvaardbare middelen te gebruiken om uw persoonlijke gegevens te beschermen persoonlijke informatie te beschermen, kunnen wij geen absolute veiligheid ervan garanderen.',
      'httpsCloudFlare' => 'De site maakt gebruik van HTTPS met moderne TLS-versleutelingssuites om de integriteit en veilige overdracht van gegevens tussen de browser en onze site te beschermen. We maken echter gebruik van de reverse proxy-service van CloudFlare, wat betekent dat een deel van de gegevens die naar onze site worden verzonden, via hun servers loopt. CloudFlare hanteert een eigen <1>privacybeleid</1>.',
      'breachNotify' => 'In het geval van een inbreuk op de beveiliging zullen alle gebruikers binnen de 24 uur na de ontdekking hiervan op de hoogte worden gesteld via een bericht op deze website, in antwoorden die door de bot zijn geplaatst en via een aankondiging in de Discord ondersteuningsserver van de bot.',
    ],
  ],
  'terms' => [
    'heading' => 'Voorwaarden',
    'license' => 'Alle broncodes van het project wordt aangeboden op GitHub zoals het is, zonder enige garantie of aansprakelijkheid. Voor de licentievoorwaarden, kunt u kijken naar <1>MIT licentie</1>, waarvan een kopie te vinden is in elke repository. De voorwaarden hieronder zijn van toepassing op de versie van het project gehost door de ontwikkelaar ("Instance") en de beperkingen die hierin opgeleg worden moeten niet behandeld worden als beperkingen op het gebruik van de project broncode.',
    'noAbuse' => 'U mag geen automatiseringen instellen om herhaaldelijk opdrachten uit te voeren via de Instance. Deze Bot is niet bedoeld voor gebruik door geautomatiseerde tools, zoals andere bots, of andere software die is ontworpen om legitieme gebruikersactiviteiten na te bootsen. In plaats van te vertrouwen op de uitvoer van onze Bot voor automatiseringsdoeleinden, raadpleegt u de documentatie van de programmeertaal die uw bot gebruikt over het genereren en manipuleren van UNIX-tijdstempels.',
    'fuckWeb3' => 'Deze Instantie zal niet worden gebruikt om te helpen bij het proces van het trainen van generatieve AI-modellen, noch om te helpen bij gebeurtenissen en/of transacties met betrekking tot niet-fungibele tokens ("NFT\'s") of enige vorm van cryptocurrency (bijv. Ethereum, Bitcoin).',
    'accessRevocation' => 'Uw toegang tot  de Instantie kan worden ingetrokken om welke reden dan ook (inclusief geen reden) naar goeddunken van de Ontwikkelaar. Redenen kunner zijn maar zijn niet gelimiteerd tot: schending van deze voorwaarden, opzettelijk misbruik van de functies van de Instantie, bedreigingen met geweld tegen de Ontwikkelaar of een van de Projectmedewerkers, gebruik van de Instantie voor kwaadwillige doeleinden.',
  ],
  'changes' => [
    'heading' => 'Wijzigingen & herzieningen',
    'effectiveFrom' => 'De Algemene voorwaarden en het Privacybeleid, gezmanlijk de "Documenten", zijn van kracht vanaf de datum waarop ze voor het laatst zijn bijgewerkt en blijven van kracht, behalve met betrekking tot eventuele toekomstige wijzigingen in de bepalingen, die onmiddelijk van kracht zijn nadat ze op deze pagina zijn geplaatst.',
    'rightToChange' => 'Wij behouden het recht om deze Documenten ten alle tijde bij te werken of te wijzigen en u dient deze pagina regelmatig te controleren. Als u het Project blijft gebruiken nadat wij wijzigingen aan de Documenten op deze pagina hebben geplaatst, betekent dit dat u de wijzigingen erkent en ermee instemt u er aan te houden en gebonden te zijn door de gewijzigde Documenten.',
    'willNotify' => 'Als wij verandering maken in deze Documenten, zullen wij u hiervan op de hoogte stellen door een prominente kennisgeving op onze website te plaatsen, evenals aankondiging in de Bots ondersteuningsserver.',
  ],
  'contact' => [
    'heading' => 'Contacteer ons',
    'whereToContact' => 'Als u vragen heeft over deze Documenten of wilt vragen om een van de PII die wij opslaan te verwijderen, naam dan contact met ons op via <1>de Discord server van Bot<1/> of via een de methoden die op <3>de website van de Ontwikkelaar<3/> vermeld staan.',
  ],
];
