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
      'removal' => 'Deze gegevens worden niet automatisch uit onze database verwijderd wanneer u uw Discord-account deactiveert; neem daarom contact met ons op als u wilt dat uw gegevens worden verwijderd.',
    ],
    'logData' => [
      'heading' => 'Logdata',
      'browserInfo' => 'Wij verzamelen informatie die uw browser verstuurt telkens wanneer u onze website bezoekt (loggegevens). Deze loggegevens kunnen onder meer bestaan uit informatie zoals het IP-adres van up computer, het besturingssysteem, het type browser, de borwserversie, de pagina\'s van onze website die u bezoekt en de tijd en datum van uw bezoek.',
      'thirdParty' => 'Deze loggegevens worden uitsluitend op onze server opgeslagen en worden niet met derden gedeeld. Loggegevens worden gebruikt door diagnostische doeleinden en worden, indien daar uitdrukkelijk om wordt verzocht, aan wetshandhavingsinstanties verstrekt. Ze worden maximaal 14 dagen bewaard en daarna verwijderd.',
      'debugging' => 'De bot kan interacties van gebruikers ontvangen via de Discord-client, waaronder slash-opdrachten en contextmenupopodrachten (actie, command of gezamenlijk opdrachten). Slash-opdrachten kunnen bovendien worden uitgevoerd met door de gebruiker opgegeven gestructureerde sleutel-waardeparen (opties). De bot registreert de uitvoering van commando\'s ten behoeve van foutopsoring, namelijk: de Discord-gebruikersnaam en de Sowflake-identificatie (ID) van de gebruiker die het commando heeft uitgevoerd, de naam van het commando (inclusief alle opties) en de ID van de server waarop het commando is uitgevoerd. Deze gegevens worden maximaal 30 dagen opgeslagen op de projectserver en zijn uitsluitend toegankelijk voor de ontwikkelaar.',
      'noPii' => 'Bij het uitvoeren van opdrachten dient u te vermijden dat u persoonlijke gegevens opneemt. Bepaalde gegevens kunnen nog steeds in ons applicatielogboek worden bewaard; neem daarom contact met ons op via de methoden die aan het einde van dit document worden beschreven om ons op de hoogte te stellen indien onze tussenkomst vereist is.',
    ],
    'performance' => [
      'heading' => 'Performance Monitoring',
      'intro' => 'To find errors and slow pages we record performance traces: short records of how a request to the Site was handled.',
      'serverTraces' => 'A trace of a request to the Site contains the address of the page requested (including its query string), the browser type (user agent), timings, the structure of the database queries involved (which can include identifiers of records) and whether the request was made by a logged in user (but not which one). The values of query parameters that look like credentials (such as codes, tokens and keys) are replaced before storage, and IP addresses are not included in traces.',
      'legalBasis' => 'We do this based on our legitimate interest in keeping the Site working and fast (<1>GDPR Article 6(1)(f)</1>).',
      'reporting' => 'When a request fails, the reference (trace ID) of its trace is shown in a message, so that you can include it when reporting the problem.',
      'retention' => 'Traces are kept for 14 days and then discarded automatically. They are stored only on our own server, can only be read by the Developer and are not shared with any third party. As individual traces cannot be deleted before they expire, a request to remove them is fulfilled by their expiry.',
    ],
    'optOut' => [
      'heading' => 'Opt Out of Performance Monitoring',
      'intro' => 'You can opt out of performance monitoring at any time using the form below. While you are opted out, no performance traces of your visits are recorded on our server.',
      'cookie' => 'Your choice is remembered in a cookie on your device. Its expiry is renewed each time you open a page of the Site while you are opted out, and clearing your cookies removes your choice.',
      'cookieLongest' => 'The cookie stays on this device for the longest time your browser allows.',
      'cookieExpiry' => 'The cookie stays on this device for the longest time your browser allows, which currently means it expires <1/>.',
      'label' => 'Do not record performance traces of my visits',
      'statusOptedOut' => 'You are currently opted out on this device.',
      'statusNotOptedOut' => 'You are currently not opted out on this device.',
      'saved' => 'Your choice was saved.',
    ],
    'telemetry' => [
      'heading' => 'Telemetrie en statistieken',
      'statsCollection' => 'Om het gebruik van de bot te evalueren en op basis daarvan beslissingen over de ontwikkeling te nemen (bijvoorbeeld het toevoegen of verwijderen van functies), kan een specifieke set gegevens over commando\'s en het gebruik daarvan worden verzameld (telemetrie). Telemetriegegevens beperken zich tot welke opdracht en opties zijn gebruikt en wanneer deze zijn gebruikt, zonder enige identificerende informatie (deze gegevens bevatten dus nooit server- of gebruikers-ID\'s, noch door de gebruiker opgegeven waarden, en zijn volledig anoniem). Telemetriegegevens worden voor onbepaalde tijd opgeslagen en de daaruit afgeleide statistieken zijn bedoeld om in geagregeerde vorm openbaar te worden weergegeven en gedeeld.',
      'telemetryOptOut' => 'Door gebruik te maken van het Project gaan gebruikers automatisch akkoord met het verzamelen van telemetriegegevens. Indien een gebruiker zich wil afmelden voor het verzamelen van telemetriegegevens, kan hij of zij zijn of haar voorkeur aangeven via de optie op de <1/> pagina.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies zijn bestanden met een kleine hoeveelheid aan gegevens. Cookies worden vanaf een website naar uw browser gestuurd en opgeslagen op de harde schijf van up computer.',
      'disable' => 'We gebruiken "cookies" om informatie op te slaan. Je kan je zoekmachine aanpassen om geen cookies op te slaan of om een melding te ontvangen wanneer ze worden gebruikt. Maar als je de cookies niet accepteert, is er een mogelijkheid dat je sommige delen van de website niet kan gebruiken.',
      'optOut' => 'If you opt out of performance monitoring, a cookie remembering your choice is stored on your device for the longest time your browser allows, as its expiry is renewed each time you open a page of the Site.',
      'session' => 'Voor ingelogde gebruikers wordt er een blijvende cookie gebruikt om de ingelogde status in browsersessies gedurende 30 dagen te onthouden. Als u niet meer wil herinnerd worden, kunt u zich afmelden of de door onze Site Ingestelde cookies wissen.',
    ],
    'rights' => [
      'heading' => 'Your Rights',
      'intro' => 'You have the right to ask us for a copy of the personal data we hold about you, to have it corrected or erased, to restrict its processing and to receive it in a portable format. To use these rights, contact us using the methods described at the end of this document.',
      'complaint' => 'You also have the right to lodge a complaint with a data protection supervisory authority, for example in the country where you live or work. The <1>European Data Protection Board</1> lists the authorities of the EU member states.',
    ],
    'objection' => [
      'heading' => 'Right to Object',
      'text' => 'Where we process your personal data based on our legitimate interests, which includes performance monitoring, you have the right to object at any time on grounds relating to your particular situation. You can do so by opting out of performance monitoring (see above), or by contacting us.',
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
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, which is shown for up to two weeks after the update (unless you dismiss it earlier), as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Contacteer ons',
    'whereToContact' => 'Als u vragen heeft over deze Documenten of wilt vragen om een van de PII die wij opslaan te verwijderen, naam dan contact met ons op via <1>de Discord server van Bot<1/> of via een de methoden die op <3>de website van de Ontwikkelaar<3/> vermeld staan.',
  ],
];
