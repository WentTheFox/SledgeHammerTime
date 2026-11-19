<?php

return [
  'translations' => [
    'title' => 'Käännetty sisältö',
    'text' => 'Projekti sisältää vapaaehtoisten kääntäjien ja muiden yhteisön jäsenien käännöksiä. Nämä käännökset ovat tarkoitettu käyttäjien mukavuudelle, eivätkä saata aina olla ajan tasalla. Kaikilta osin tämän sivun <1>alkuperäinen kieliversio</1> voi olla parempi vaihtoehto.',
  ],
  'lastUpdated' => 'Viimeksi päivitetty: <1/>',
  'privacy' => [
    'heading' => 'Tietosuojakäytäntö',
    'operator' => '<0/> ("me", "meidän" tai "kehittäjä") ylläpitää Hammertime sivustoa ("sivu"), ja HammertimeBottia ("botti" tai "appi") kokonaisuudessaan HammerTime projekti ("projekti"). Tämä sivu tiedottaa sinua käytännöistämme koskien henkilötietojen keräämistä, käyttöä ja luovuttamista, joita saamme projektin käyttäjältä ("sinä", "käyttäjä" tai kokonaisuudessaan "käyttäjät").',
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
      'heading' => 'Suorituskyvyn seuranta',
      'intro' => 'Löytääksemme virheitä ja hitaita sivuja, tallennamme suorituskykyjälkiä: lyhyitä tallenteita siitä, miten sivustolle lähetetty pyyntö käsiteltiin.',
      'serverTraces' => 'Sivustolle lähetetyn pyynnön jälki sisältää pyydetyn sivuston osoitteen (mukaan lukien sen kyselymerkkijono), selaimen tyypin (käyttäjäagentti), aikatiedot, kyseessä olevien tietokantakyselyjen rakenteen (joka voi sisältää tietueiden tunnisteita), sekä jos pyynnön lähetti käyttäjä joka on kirjautunut sisään (mutta ei sitä että kuka). Kyselyparametrien arvot jotka näyttävät tunnistetiedoilta (kuten koodit, tokenit ja avaimet), korvataan ennen tallennusta, eikä IP-osoitteita sisällytetä jälkiin.',
      'legalBasis' => 'Teemme tätä perustuen oikeutettuun etuumme pitää sivusto toiminnassa ja nopeana (<1>GDPR 6 artikla(1)(f)</1>).',
      'reporting' => 'Kun pyyntö epäonnistuu, sen jäljitystiedon viite (jäljitystunnus) näkyy viestissä, jotta voit mainita sen ongelmaa ilmoittaessa.',
      'retention' => 'Jäljet säilytetään 14 päivän ajan, jonka jälkeen ne poistetaan automaattisesti. Ne tallennetaan ainoastaan omalle palvelimellemme, vain kehittäjä voi lukea niitä, eikä niitä jaeta kolmansien osapuolien kanssa. Koska yksittäisiä jälkiä ei voida poistaa ennen kuin ne vanhenevat, pyyntö niiden poistamisesta toteutetaan niiden voimassaolon päättyessä.',
    ],
    'optOut' => [
      'heading' => 'Kieltäydy suorituskyvyn seurannasta',
      'intro' => 'Voit kieltäytyä suorituskyvyn seurannasta milloin tahansa käyttämällä alla olevaa lomaketta. Kun olet kieltäytynyt, käynneistäsi ei tallenneta mitään jälkiä.',
      'cookie' => 'Valintasi tallennetaan laitteellesi evästeeseen. Sen voimassaoloaika uusitaan joka kerta kun avaat sivuston sivun kun olet kieltäytynyt, ja evästeidesi tyhjentäminen poistaa valintasi.',
      'cookieLongest' => 'Eväste säilyy tällä laitteella niin kauan, kuin selaimesi sen sallii.',
      'cookieExpiry' => 'Eväste säilyy tällä laitteella niin kauan, kuin selaimesi sen sallii, joka tarkoittaa että se vanhenee <1/>.',
      'label' => 'Älä tallenna vierailujeni toimintatietoja',
      'statusOptedOut' => 'Olet kieltäytynyt seurannasta tällä laitteella.',
      'statusNotOptedOut' => 'Et ole kieltäytynyt seurannasta tällä laitteella.',
      'saved' => 'Valintasi on tallennettu.',
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
      'optOut' => 'Jos kieltäydyt suorituskyvyn seurannasta, laitteellesi tallennetaan eväste joka muistaa valintasi, niin kauaksi ajaksi kuin selaimesi sallii, sillä sen voimassaoloaika uusitaan joka kerta kun avaat sivuston sivun.',
      'session' => 'Kirjautuneille käyttäjille käytetään pysyvää evästettä, joka säilyttää kirjautumisen 30 päivän ajan myös selaimen eri istunnoissa. Jos et halua, että sinut muistetaan, voit joko kirjautua ulos tai poistaa sivustomme evästeet.',
    ],
    'rights' => [
      'heading' => 'Oikeutesi',
      'intro' => 'You have the right to ask us for a copy of the personal data we hold about you, to have it corrected or erased, to restrict its processing and to receive it in a portable format. To use these rights, contact us using the methods described at the end of this document.',
      'complaint' => 'Sinulla on myös oikeus tehdä valitus tietosuojavaltuutetun kanssa, esimerkiksi siinä maassa missä elät tai työskentelet. <1>Euroopan tietosuojaneuvosto</1> esittää luettelon EU:n jäsenvaltioiden viranomaisista.',
    ],
    'objection' => [
      'heading' => 'Oikeus vastustaa',
      'text' => 'Kun käsittelemme dataasi oikeutettujen etujemme perusteella, joka sisältää suorituskyvyn seurantaa, sinulla on oikeus vastustaa milloin tahansa tilanteeseesi liittyviä asioita. Voit tehdä niin kieltäytymällä suorituskyvyn seurannasta (katso yllä), tai ottamalla meihin yhteyttä.',
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
    'willNotify' => 'Jos teemme näihin asiakirjoihin muutoksia, ilmoitamme siitä sinulle julkaisemalla näkyvän ilmoituksen sivustollamme, jota näytetään kaksi viikkoa päivityksen jälkeen (ellet sulje sitä aikaisemmin), sekä lähettämällä ilmoituksen botin Discord-palvelimella.',
  ],
  'contact' => [
    'heading' => 'Ole meihin yhteydessä',
    'whereToContact' => 'Jos sinulla on kysymyksiä näistä asiakirjoista, tai haluat pyytää minkä vaan henkilökohtaisen tiedon poistamista, ole yhteydessä meihin <1>botin Discord palvelimella</1> tai käyttäen mitä vain metodia mainittu <3>kehittäjän sivulla</3>.',
  ],
];
