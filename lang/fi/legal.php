<?php

return [
  'translations' => [
    'title' => 'Käännetty sisältö',
    'text' => 'Projekti sisältää vapaaehtoisten kääntäjien ja muiden yhteisön jäsenien käännöksiä. Nämä käännökset ovat tarkoitettu käyttäjien mukavuudelle, eivätkä saata aina olla ajan tasalla. Kaikilta osin tämän sivun <1>alkuperäinen kieliversio</1> voi olla parempi vaihtoehto.',
  ],
  'lastUpdated' => 'Viimeksi päivitetty: <1/>',
  'privacy' => [
    'heading' => 'Tietosuojakäytäntö',
    'operator' => '<0/> ("me", "meidän" tai "kehittäjä) ylläpitää Hammertime sivustoa ("sivu"), ja HammertimeBottia ("botti" tai "appi") kokonaisuudessaan HammerTime projekti ("projekti"). Tämä sivu tiedottaa sinua käytännöistämme koskien henkilötietojen keräämistä, käyttöä ja luovuttamista, joita saamme projektin käyttäjältä ("sinä", "käyttäjä" tai kokonaisuudessaan "käyttäjät").',
    'notAffiliated' => 'Vaikka "HammerTime" nimi ("Projektin nimi") on peräisin Discord, Inc.:n ("Discord")<1/> vanhasta nimestä "Hammer & Chisel", projekti ei ole sidoksissa millään tavalla Discordin, tai M.C. Hammerin, jonka kappale<3/> luo tämän lauseen näkyvästi esiin. Kehittäjä ei omista projektin nimeä tavaramerkin tai tekijänoikeuden alla.',
    'infoCollection' => [
      'heading' => 'Tietojen keruu ja käyttö',
      'pii' => 'Projektia käyttäessä, emme kysy emmekä kannusta sinua antamaan meille mitään henkilötietoja joita voi käyttää sinun tunnistamiseen yksilönä. Henkilötiedot voivat sisältää, mutta eivät rajoitu sinun: syntymäpäivän, henkilötunnuksen, sijainnin, puhelinnumeron.',
      'auth' => 'Sisään kirjautumisen tarjoaa Discordin OAuth 2 API (ohjelmointirajapinta) joka on myös turvattu käyttäen HTTPS-protokollaa. OAuth todennuksen aikana, sivumme ei saa käyttäjänimeäsi eikä salasanaasi, vain tokenin henkilöllisyytesi todistamiseen tätä ohjelmointirajapintaa käyttäen. Suorituskykysyistä, tallennamme ohjelmointirajapinnan antamat perustiedot (käyttäjätunnus, nykyinen käyttäjänimi, näyttönimi, avatarin linkki) paikallisesti.',
      'removal' => 'Näitä tietoja ei poisteta tietokannastamme automaattisesti jos deaktivoit Discord käyttäjäsi, joten ota meihin yhteyttä jos haluat tietosi poistettua.',
    ],
    'logData' => [
      'heading' => 'Lokitiedot',
      'browserInfo' => 'Keräämme tietoja joita selaimesi lähettää kun vierailet sivustollamme ("lokitiedot"). Nämä lokitiedot saattavat sisältää tietoja kuten tietokoneesi IP-osoite, käyttöjärjestelmä, selaimen tyyppi, selaimen versio, sivustomme sivut joilla vierailet, vierailusi aika ja päivämäärä.',
      'thirdParty' => 'Tämä lokidata tallennetaan vain palvelimellemme, eikä sitä jaeta minkään kolmannen osapuolen kanssa. Lokidataa käytetään diagnostiikka varten, ja jaetaan lainvalvontaviranomaisten kanssa jos niin pyydetään. Sitä pidetään 14 päivää, ja poistetaan jälkikäteen.',
      'debugging' => 'Botti voi vastaanottaa käyttäjien vuorovaikutuksia Discord asiakkaalta, joka sisältää kauttaviivakomennot ja kontekstivalikon komennot ("toiminta", "komento" tai kokonaisuudessaan "komennot"). Kauttaviivakomentoja voi myös suorittaa käyttäjän toimittamilla rakenteisesti järjestetyillä avain-arvo -pareilla ("vaihtoehdot"). Botti tallentaa komentojen suoritukset virheenjäljitystarkoituksiin, nimittäin; komennon suorittaneen käyttäjän Discord käyttäjänimi ja Snowflake tunniste ("tunnus"), komennon nimi (sisältäen kaikki vaihtoehdot) ja palvelimen tunnus missä komento suoritettiin. Tätä dataa säilytetään projektin palvelimella enintään 30 päivää, ja on vain kehittäjän saavutettavissa.',
      'noPii' => 'Suorittaessa komentoja, sinun pitäisi välttää henkilötietojen jakamista. Osa tiedoista saattaa silti pysyä sovelluslokissa, joten ota meihin yhteyttä asiakirjan lopussa mainituilla metodeilla ilmoittaaksesi että haluat asiaan puuttumista.',
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
      'heading' => 'Telemetria ja tilastot',
      'statsCollection' => 'Botin käytön arvioitamiseksi, ja siten kehityspäätösten ajamiseksi (esim. ominaisuuksien lisääminen/poistaminen) tietty joukko tietoja saatetaan kerätä ("telemetria"). Telemetriatiedot rajoitetaan siihen mitä komentoja ja vaihtoehtoja käytettiin, ja milloin niitä käytettiin, ilman mitään tunnistetietoja (eli se ei ikinä sisällä palvelin- tai käyttäjätunnuksia, tai mitään käyttäjän toimittamia tietoja, ja on täysin anonyymi). Telemetriaa pidetään määräämättömästi ja siitä johdetut tilastot ovat tarkoitettu julkisesti näytettäväksi ja jaettavaksi koostetussa muodossa.',
      'telemetryOptOut' => 'Projektia käyttäessä, käyttäjät hyväksyvät telemetrian keräämiseen oletuksena. Jos käyttäjä haluaa kieltäytyä telemetrian keräämisestä, voi hän silloin kertoa mieltymyksestään sopivaa vaihtoehtoa käyttäen <1/> sivulla.',
    ],
    'cookies' => [
      'heading' => 'Evästeet',
      'intro' => 'Evästeet ovat tiedostoja joissa on pieni määrä dataa. Evästeet lähetetään selaimellesi sivustolta ja säilytetään tietokoneesi kiintolevylle.',
      'disable' => 'Käytämme evästeitä säilyttääksemme tietoa. Voit kertoa selaimellesi kieltäytyä kaikista evästeistä tai kertoa kun evästettä lähetetään. Mutta, jos et hyväksy evästeitä, et saata voida käyttää osia sivustamme.',
      'optOut' => 'If you opt out of performance monitoring, a cookie remembering your choice is stored on your device for the longest time your browser allows, as its expiry is renewed each time you open a page of the Site.',
      'session' => 'Kirjautuneille käyttäjille käytetään pysyvää evästettä, joka säilyttää kirjautumisen 30 päivän ajan myös selaimen eri istunnoissa. Jos et halua, että sinut muistetaan, voit joko kirjautua ulos tai poistaa sivustomme evästeet.',
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
      'heading' => 'Suojaus',
      'noGuarantee' => 'Tietojesi turvallisuus on meille tärkeää, mutta muista että internetissä minkään tietojen siirtämisen metodi, tai elektroninen tallennus ei ole 100% suojattu. Pyrimme käyttämään kaupallisesti hyväksyttäviä keinoja suojata tietojasi, mutta emme voi takuuta sen ehdotonta turvallisuutta.',
      'httpsCloudFlare' => 'Sivusto käyttää HTTPS-protokollaa käyttäen modernia TLS-salausprotokollaa suojatakseen eheyttä ja turvallista tiedonsiirtoa selaimen ja sivustomme kanssa. Me käytämme CloudFlaren käänteistä välityspalvelinta, tarkoittaen että osa datasta menee heidän palvelimien kautta. CloudFlare toimii oman <1>tietosuojakäytännönsä</1> mukaan.',
      'breachNotify' => 'Tietoturvaloukkauksen sattuessa, kaikille käyttäjille ilmoitetaan 24 tunnin sisällä löydöstä huomautuksessa tällä sivustolla, botin vastauksissa ja ilmoituksessa botin Discord palvelimella.',
    ],
  ],
  'terms' => [
    'heading' => 'Ehdot',
    'license' => 'Koko projektin lähdekoodi tarjotaan GitHubissa sellaisenaan, ilman mitään takuuta tai vastuuta. Näkeäksesi täydet lisenssiehdot, näe <1>MIT lisenssi</1>, kopio jonka voi löytää jokaisesta arkistosta. Ehdot alhaalla sovelletaan versioon projektista kehittäjän isännöimänä ("instanssi") ja määrättyjä limitaatioita ei saa kohdella projektin lähdekoodin käytön rajoituksena.',
    'noAbuse' => 'Et saa luoda automaatioita, jotka suorittavat komentoja instanssin kautta toistuvasti. Tätä bottia ei ole tarkoitettu käytettäväksi automaattisissa työkaluissa, kuten muissa boteissa tai ohjelmistoissa, jotka on suunniteltu jäljittelemään oikean käyttäjän toimintaa. Sen sijaan, että käyttäisit bottimme antamia tulosteita automaatiotarkoituksiin, tutustu bottisi käyttämän ohjelmointikielen dokumentaatioon siitä, miten UNIX-aikaleimoja voidaan tuottaa ja käsitellä.',
    'fuckWeb3' => 'Tätä instanssia ei saa käyttää generatiivisien tekoälymallien kouluttamiseen eikä sellaisten tapahtumien tai transaktioiden helpottamiseen, jotka liittyvät non-fungible tokeneihin (“NFT:t”) tai mihinkään kryptovaluuttoihin (esimerkiksi Ethereum tai Bitcoin).',
    'accessRevocation' => 'Pääsysi instanssiin voidaan peruuttaa mistä tahansa syystä (tai ilman syytä) kehittäjän harkinnan mukaan. Mahdollisia syitä ovat muun muassa näiden ehtojen rikkominen, instanssin tahallinen väärinkäyttö, väkivallalla uhkailu kehittäjää tai projektin avustajia kohtaan sekä esiintymän käyttäminen haitallisiin tarkoituksiin.',
  ],
  'changes' => [
    'heading' => 'Muutokset & korjaukset',
    'effectiveFrom' => 'Ehdot ja tietosuojakäytäntö (yhdessä ”Asiakirjat”) ovat voimassa niiden viimeisimmästä päivityksestä alkaen ja pysyvät voimassa, lukuun ottamatta mahdollisia tulevia muutoksia niiden määräyksiin. Tällaiset muutokset tulevat voimaan heti, kun ne ovat julkaistu tällä sivulla.',
    'rightToChange' => 'Pidätämme oikeuden päivittää tai muuttaa näitä asiakirjoja milloin tahansa, ja sinun pitäisi tarkistaa tämä sivu määräajoin. Sinun jatkuva projektin käyttö sen jälkeen kun muutamme asiakirjoja sivulla muodostaa tunnustuksenne muutoksista ja suostumuksesi noudattaa muutettuja asiakirjoja ja sitoutua niihin.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, which is shown for up to two weeks after the update (unless you dismiss it earlier), as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Ole meihin yhteydessä',
    'whereToContact' => 'Jos sinulla on kysymyksiä näistä asiakirjoista, tai haluat pyytää minkä vaan henkilökohtaisen tiedon poistamista, ole yhteydessä meihin <1>botin Discord palvelimella</1> tai käyttäen mitä vain metodia mainittu <3>kehittäjän sivulla</3>.',
  ],
];
