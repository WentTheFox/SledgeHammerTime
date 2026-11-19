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
      'heading' => 'Prestatie monitoring',
      'intro' => 'Om fouten en trage pagina’s op te sporen, registreren wij prestatiegegevens: dit zijn korte verslagen van de manier waarop een verzoek aan de website is verwerkt.',
      'serverTraces' => 'Een trace van een verzoek aan de website bevat het adres van de opgevraagde pagina (inclusief de bijbehorende query-string), het browsertype (user agent), tijdstippen, de structuur van de betrokken databasequery’s (waarin identificatiegegevens van records kunnen voorkomen) en of het verzoek afkomstig was van een ingelogde gebruiker (maar niet welke). De waarden van queryparameters die op inloggegevens lijken (zoals codes, tokens en sleutels) worden voordat ze worden opgeslagen vervangen, en IP-adressen worden niet in de logbestanden opgenomen.',
      'legalBasis' => 'Wij doen dit op grond van ons gerechtvaardigd belang om de website goed en snel te laten functioneren (<1>Artikel 6, lid 1, onder f), van de AVG</1>).',
      'reporting' => 'Wanneer een verzoek mislukt, wordt de referentie (trace-ID) van de bijbehorende trace in een melding weergegeven, zodat u deze kunt vermelden wanneer u het probleem meldt.',
      'retention' => 'Traces worden voor 14 dagen bewaard en vervolgens automatisch verwijderd. Ze worden uitsluitend op onze eigen server opgeslagen, kunnen alleen door de ontwikkelaar worden ingezien en worden niet met derden gedeeld. Aangezien individuele traces niet kunnen worden verwijderd voordat hun bewaartermijn is verstreken, wordt een verzoek tot verwijdering ingewilligd op het moment dat de bewaartermijn afloopt.',
    ],
    'optOut' => [
      'heading' => 'Afmelden voor prestatiebewaking',
      'intro' => 'U kunt zich te allen tijde afmelden voor prestatiebewaking via het onderstaande formulier. Zolang u bent afgemeld, worden er geen prestatiegegevens van uw bezoeken op onze server vastgelegd.',
      'cookie' => 'Uw keuze wordt opgeslagen in een cookie op uw apparaat. De geldigheidsduur ervan wordt telkens verlengd wanneer u een pagina van de website opent terwijl u zich hebt afgemeld, het wissen van uw cookies leidt tot het verwijderen van uw keuze.',
      'cookieLongest' => 'De cookie staat op uw apparaat voor de maximale tijd die uw browser toestaat.',
      'cookieExpiry' => 'The cookie stays on this device for the longest time your browser allows, which currently means it expires <1/>.',
      'label' => 'Leg geen prestatiegegevens van mijn bezoeken vast',
      'statusOptedOut' => 'Op dit apparaat hebt u zich momenteel afgemeld.',
      'statusNotOptedOut' => 'U hebt zich op dit apparaat momenteel niet afgemeld.',
      'saved' => 'Uw keuze is opgeslagen.',
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
      'optOut' => 'Indien u zich afmeldt voor prestatiebewaking, wordt er een cookie op uw apparaat opgeslagen waarin uw keuze wordt vastgelegd, en dit wordt opgeslagen voor de maximale periode die uw browser toestaat, aangezien de geldigheidsduur ervan telkens wordt verlengd wanneer u een pagina van de website opent.',
      'session' => 'Voor ingelogde gebruikers wordt er een blijvende cookie gebruikt om de ingelogde status in browsersessies gedurende 30 dagen te onthouden. Als u niet meer wil herinnerd worden, kunt u zich afmelden of de door onze Site Ingestelde cookies wissen.',
    ],
    'rights' => [
      'heading' => 'Uw rechten',
      'intro' => 'U heeft het recht om ons te vragen om een kopie van de persoonlijke gegevens die wij over u bewaren, om het te laten corrigeren of wissen, om de verwerking ervan te beperken en om het in draagbare vorm te ontvangen. Om deze rechten te gebruiken, neem contact met ons op via de methoden die aan het eind van dit document beschreven zijn.',
      'complaint' => 'U hebt tevens het recht om een klacht in te dienen bij een toezichthoudende autoriteit voor gegevensbescherming, bijvoorbeeld in het land waar u woont of werkt. Op de website van het <1>Europees Comité voor gegevensbescherming</1> vindt u een overzicht van de autoriteiten van de EU-lidstaten.',
    ],
    'objection' => [
      'heading' => 'Recht van bezwaar',
      'text' => 'Wanneer wij uw persoonsgegevens verwerken op basis van onze gerechtvaardigde belangen, waaronder prestatiebewaking, heeft u het recht om te allen tijde bezwaar te maken op grond van redenen die verband houden met uw specifieke situatie. U kunt dit doen door u af te melden voor prestatiebewaking (zie hierboven), of door contact met ons op te nemen.',
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
    'willNotify' => 'Indien wij wezenlijke wijzigingen aanbrengen in deze documenten, zullen wij u hiervan op de hoogte stellen door een opvallende mededeling op onze website te plaatsen, die tot twee weken na de update zichtbaar blijft (tenzij u deze eerder wegklikt), en door een aankondiging te plaatsen op de Discord-ondersteuningsserver van de bot.',
  ],
  'contact' => [
    'heading' => 'Contacteer ons',
    'whereToContact' => 'Als u vragen heeft over deze Documenten of wilt vragen om een van de PII die wij opslaan te verwijderen, naam dan contact met ons op via <1>de Discord server van Bot<1/> of via een de methoden die op <3>de website van de Ontwikkelaar<3/> vermeld staan.',
  ],
];
