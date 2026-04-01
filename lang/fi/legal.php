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
      'removal' => 'Näitä tietoja ei poisteta tietokannastamme automaattisesti jos deaktivoit Discord käyttäjäsi, joten ota meihin yhteyttä jos haluat tietosi poistettua.',
    ],
    'logData' => [
      'heading' => 'Lokitiedot',
      'browserInfo' => 'Keräämme tietoja joita selaimesi lähettää kun vierailet sivustollamme ("lokitiedot"). Nämä lokitiedot saattavat sisältää tietoja kuten tietokoneesi IP-osoite, käyttöjärjestelmä, selaimen tyyppi, selaimen versio, sivustomme sivut joilla vierailet, vierailusi aika ja päivämäärä.',
      'thirdParty' => 'Tämä lokidata tallennetaan vain palvelimellemme, eikä sitä jaeta minkään kolmannen osapuolen kanssa. Lokidataa käytetään diagnostiikka varten, ja jaetaan lainvalvontaviranomaisten kanssa jos niin pyydetään. Sitä pidetään 14 päivää, ja poistetaan jälkikäteen.',
      'debugging' => 'Botti voi vastaanottaa käyttäjien vuorovaikutuksia Discord asiakkaalta, joka sisältää kauttaviivakomennot ja kontekstivalikon komennot ("toiminta", "komento" tai kokonaisuudessaan "komennot"). Kauttaviivakomentoja voi myös suorittaa käyttäjän toimittamilla rakenteisesti järjestetyillä avain-arvo -pareilla ("vaihtoehdot"). Botti tallentaa komentojen suoritukset virheenjäljitystarkoituksiin, nimittäin; komennon suorittaneen käyttäjän Discord käyttäjänimi ja Snowflake tunniste ("tunnus"), komennon nimi (sisältäen kaikki vaihtoehdot) ja palvelimen tunnus missä komento suoritettiin. Tätä dataa säilytetään projektin palvelimella enintään 30 päivää, ja on vain kehittäjän saavutettavissa.',
      'noPii' => 'Suorittaessa komentoja, sinun pitäisi välttää henkilötietojen jakamista. Osa tiedoista saattaa silti pysyä sovelluslokissa, joten ota meihin yhteyttä asiakirjan lopussa mainituilla metodeilla ilmoittaaksesi että haluat asiaan puuttumista.',
    ],
    'telemetry' => [
      'heading' => 'Telemetria ja tilastot',
      'statsCollection' => 'Botin käytön arvioitamiseksi, ja siten kehityspäätösten ajamiseksi (esim. ominaisuuksien lisääminen/poistaminen) tietty joukko tietoja saatetaan kerätä ("telemetria"). Telemetriatiedot rajoitetaan siihen mitä komentoja ja vaihtoehtoja käytettiin, ja milloin niitä käytettiin, ilman mitään tunnistetietoja (eli se ei ikinä sisällä palvelin- tai käyttäjätunnuksia, tai mitään käyttäjän toimittamia tietoja, ja on täysin anonyymi). Telemetriaa pidetään määräämättömästi ja siitä johdetut tilastot ovat tarkoitettu julkisesti näytettäväksi ja jaettavaksi koostetussa muodossa.',
      'telemetryOptOut' => 'By using the Project, Users agree to the collection of Telemetry by default. If a User wishes to opt out of Telemetry collection, they may indicate their preference via the appropriate option on the <1/> page.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies are files with small amount of data. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.',
      'disable' => 'We use "cookies" to retain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Site.',
      'session' => 'For logged in users a persistent cookie is used to remember the logged in status across browser sessions for 30 days. If you want to stop being remembered you can either sign out or clear the cookies set by our Site.',
    ],
    'security' => [
      'heading' => 'Security',
      'noGuarantee' => 'The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.',
      'httpsCloudFlare' => 'The Site makes use of HTTPS using modern TLS encryption suites to protect the integrity and secure transport of data between the browser and our Site. However, we make use of CloudFlare\'s Reverse Proxy service, meaning some portion of the data sent to our Site passes through their servers. CloudFlare operates under their own <1>privacy policy</1>.',
      'breachNotify' => 'Tietoturvaloukkauksen sattuessa, kaikille käyttäjille ilmoitetaan 24 tunnin sisällä löydöstä huomautuksessa tällä sivustolla, botin vastauksissa ja ilmoituksessa botin Discord palvelimella.',
    ],
  ],
  'terms' => [
    'heading' => 'Ehdot',
    'license' => 'All of the Project\'s source code is provided on GitHub as-is, without any warranty or liability. For the full license terms, please see the <1>MIT license</1>, a copy of which can be found in each repository. The terms outlined below apply to the version of the Project hosted by the Developer ("Instance") and the limitations imposed within are not to be treated as  restrictions on the usage of the Project source code.',
    'noAbuse' => 'You must not set up automations to run Commands via the Instance repeatedly. This Bot is not meant to be used by automated tools, such as other bots, or any other software designed to mimic legitimate user activity. Instead of relying on our Bot\'s output for automation purposes, please refer to the documentation of the programming language used by your bot on how to generate and manipulate UNIX timestamps.',
    'fuckWeb3' => 'This Instance shall not be used to aid in the process of training generative AI models, nor to help facilitate any events and/or transactions related to non-fungible tokens ("NFTs") or any form of cryptocurrency (e.g. Ethereum, Bitcoin).',
    'accessRevocation' => 'Your access to the Instance may be revoked for any reason (including no reason) at the Developer\'s discretion. Reasons can include, but are not limited to: violation of these terms, intentional abuse of the Instance\'s features, threats of violence towards the Developer or any of the Project\'s contributors, use of the Instance for malicious purposes.',
  ],
  'changes' => [
    'heading' => 'Changes & Revisions',
    'effectiveFrom' => 'The Terms & Conditions and Privacy Policy, collectively "Documents", are effective as of their last update date and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page.',
    'rightToChange' => 'We reserve the right to update or change these Documents at any time and you should check this page periodically. Your continued use of the Project after we post any modifications to the Documents on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Documents.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Contact Us',
    'whereToContact' => 'If you have any questions about these Documents or want to ask for the removal of any PII we store please contact us via <1>the Bot\'s Discord server</1> or using any of the methods listed on the <3>Developer\'s website</3>.',
  ],
];
