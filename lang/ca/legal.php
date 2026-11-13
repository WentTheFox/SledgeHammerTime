<?php

return [
  'translations' => [
    'title' => 'Contingut traduït',
    'text' => 'Aquest projecte conté traduccions realitzades per traductors voluntaris i altres membres de la comunitat. Aquestes traduccions es proporcionen per a la comoditat dels usuaris i pot ser que no estiguin sempre totalment actualitzades. En tots els casos, la versió original d\'aquesta pàgina <1>en la llengua original</1> és la que es considera efectiva.',
  ],
  'lastUpdated' => 'Darrera actualització: <1/>',
  'privacy' => [
    'heading' => 'Política de privadesa',
    'operator' => '<0/> ("us", "we", "our", or "Developer") operates the HammerTime website (the "Site"), and HammerTimeBot (the "Bot", or "App"), collectively the HammerTime Project (the "Project"). This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Project ("you", "User", or collectively "Users").',
    'notAffiliated' => 'Although the "HammerTime" name ("Project Name") is derived from the former name "Hammer & Chisel" of Discord, Inc. ("Discord")<1/> the Project is not affiliated in any way, shape, or form, with Discord, nor M.C. Hammer, whose song<3/> features this phrase prominently. The Developer holds no trademark or copyright over the Project Name.',
    'infoCollection' => [
      'heading' => 'Recollida i ús d\'informació',
      'pii' => 'While using the Project we do not ask nor encourage you to provide us with any Personally Identifiable Information ("PII", "Personal Information") that can be used to identify you as an individual. PII may include, but is not limited to: your name, birth date, national identification numbers, location, phone number.',
      'auth' => 'Sign in is provided using Discord\'s OAuth 2 API ("API") which is also secured using HTTPS. During the OAuth authentication process our Site does not receive the username or password, only a token that can be used to verify the user\'s identity using this API. For performance reasons we store the basic information provided by the API (user ID, current username, display name, avatar link) locally.',
      'removal' => 'This information is not removed from our database automatically if you deactivate your Discord account, so be sure to reach out to us if you would like your data removed.',
    ],
    'logData' => [
      'heading' => 'Dades del registre',
      'browserInfo' => 'We collect information that your browser sends whenever you visit our Site ("Log Data"). This Log Data may include information such as your computer\'s IP address, operating system, browser type, browser version, the pages of our Site that you visit, the time and date of your visit.',
      'thirdParty' => 'This Log Data is stored only within our server and is not shared with any third party. Log Data is used for diagnostic purposes, and shared with law enforcement agencies if explicitly requested. It is kept for up to 14 days and discarded afterwards.',
      'debugging' => 'The Bot can receive interactions from Users via the Discord client, which includes slash commands and context menu commands ("Action", "Command", or collectively "Commands"). Slash commands can additionally be executed with User-supplied structured key-value pairs ("Options"). The Bot records Command executions for debugging purposes, namely: the Discord username and Snowflake identifier ("ID") of the User that executed the Command, the name of the Command (including all Options) and the ID of the Server the Command was executed in. This data is stored on the Project server for up to 30 days, and is only accessible by the Developer.',
      'noPii' => 'When executing Commands you should avoid including any Personal Information. Some information may still be retained in our Application Log, so please contact us using the methods described at the end of this document to notify us if our intervention is needed.',
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
      'heading' => 'Telemetria i estadístiques',
      'statsCollection' => 'In order to assess the Bot\'s usage and thereby drive development decisions (e.g. the addition/removal of features) a specific set of data about Commands and their usage may be collected ("Telemetry"). Telemetry information is limited to which command and options were used, and when they were used, without any identifying information (therefore it never includes server or user IDs, nor any user-supplied values, and is fully anonymous). Telemetry is stored indefinitely and statistics derived from it are intended to be displayed and shared publicly in aggregate form.',
      'telemetryOptOut' => 'By using the Project, Users agree to the collection of Telemetry by default. If a User wishes to opt out of Telemetry collection, they may indicate their preference via the appropriate option on the <1/> page.',
    ],
    'cookies' => [
      'heading' => 'Galetes',
      'intro' => 'Cookies are files with small amount of data. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.',
      'disable' => 'Usem "cookies" per retenir informacio. Podeu indicar al vostre navegador que rebutgi totes les cookies o que indiqui quan s\'envia una cookie. Tanmateix, si no accepteu les cookies, és possible que no pugueu utilitzar algunes parts del nostre lloc web.',
      'optOut' => 'If you opt out of performance monitoring, a cookie remembering your choice is stored on your device for the longest time your browser allows, as its expiry is renewed each time you open a page of the Site.',
      'session' => 'For logged in users a persistent cookie is used to remember the logged in status across browser sessions for 30 days. If you want to stop being remembered you can either sign out or clear the cookies set by our Site.',
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
      'heading' => 'Seguretat',
      'noGuarantee' => 'The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.',
      'httpsCloudFlare' => 'The Site makes use of HTTPS using modern TLS encryption suites to protect the integrity and secure transport of data between the browser and our Site. However, we make use of CloudFlare\'s Reverse Proxy service, meaning some portion of the data sent to our Site passes through their servers. CloudFlare operates under their own <1>privacy policy</1>.',
      'breachNotify' => 'In the event of a security breach all users will be notified within 24 hours of discovery through a notice posted on this website, in replies posted by the Bot and via an announcement in the Bot\'s Discord support server.',
    ],
  ],
  'terms' => [
    'heading' => 'Termes i condicions',
    'license' => 'Tot el codi font del Projecte es proporciona a GitHub tal qual, sense cap garantia ni responsabilitat. Per als termes complets de la llicència, consulteu la <1>llicència MIT</1>, una còpia de la qual es pot trobar a cada repositori. Els termes que es detallen a continuació s\'apliquen a la versió del Projecte allotjada pel Desenvolupador («Instance») i les limitacions que s\'hi imposen no s\'han de considerar restriccions en l\'ús del codi font del Projecte.',
    'noAbuse' => 'No heu d\'establir automatitzacions per executar Comandes mitjançant la Instància repetidament. Aquest Bot no està pensat per ser utilitzat per eines automatitzades, com ara altres bots o qualsevol altre programari dissenyat per imitar l\'activitat d\'un usuari legítim. En lloc de confiar en la sortida del nostre bot amb finalitats d\'automatització, consulteu la documentació del llenguatge de programació que utilitza el vostre bot sobre com generar i manipular segells de temps UNIX.',
    'fuckWeb3' => 'Aquesta instància no s\'ha d\'utilitzar per ajudar en el procés d\'entrenament de models d\'IA generativa, ni per ajudar a facilitar cap esdeveniment i/o transacció relacionada amb tokens no fungibles ("NFTs") o qualsevol forma de criptomoneda (p. ex., Ethereum, Bitcoin).',
    'accessRevocation' => 'El vostre accés a l\'Instance pot ser revocat per qualsevol motiu (inclòs cap motiu) a discreció del Desenvolupador. Les raons poden incloure, però no es limiten a: violació d\'aquests termes, abús intencionat de les funcionalitats de l\'Instance, amenaces de violència contra el Desenvolupador o qualsevol dels col·laboradors del Projecte, ús de l\'Instance amb finalitats malicioses.',
  ],
  'changes' => [
    'heading' => 'Canvis i revisions',
    'effectiveFrom' => 'Els Termes i Condicions i la Política de privadesa, col·lectivament anomenats «Documents», són vigents des de la data de l\'última actualització i continuaran vigents, excepte pel que fa a qualsevol canvi en les seves disposicions en el futur, que entraran en vigor immediatament després de ser publicats en aquesta pàgina.',
    'rightToChange' => 'Ens reservem el dret d\'actualitzar o modificar aquests Documents en qualsevol moment i hauríeu de consultar aquesta pàgina periòdicament. El vostre ús continuat del Projecte després que publiquem qualsevol modificació dels Documents en aquesta pàgina constituirà el vostre reconeixement de les modificacions i el vostre consentiment per acatar i estar vinculats als Documents modificats.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, which is shown for up to two weeks after the update (unless you dismiss it earlier), as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Contacteu-nos',
    'whereToContact' => 'Si tens alguna pregunta sobre aquest document o vols preguntar per la per l\'eliminació d\'algun PII que tenim contacta amb nosaltres via <1> del bot de Dicord</1> o fent servi algun mètode llistat a la <3>web del desenvolupador</3>.',
  ],
];
