<?php

return [
  'translations' => [
    'title' => 'Contenu traduit',
    'text' => 'Ce projet contient des traductions réalisées par des traducteurs bénévoles et d\'autres membres de la communauté. Ces traductions sont fournies pour la commodité des utilisateurs et peuvent ne pas être totalement à jour. Dans tous les cas, la <1>version originale</1> de cette page fait foi.',
  ],
  'lastUpdated' => 'Dernière mise à jour : <1/>',
  'privacy' => [
    'heading' => 'Politique de Confidentialité',
    'operator' => '<0/> ("nous", "notre", "nos" ou "Développeur") exploite le site Web HammerTime (le "Site") et HammerTimeBot (le "Bot" ou "App"), collectivement le Projet HammerTime (le "Projet"). Cette page vous informe de nos politiques concernant la collecte, l\'utilisation et la divulgation des Données Personnelles que nous recevons des utilisateurs du Projet ("vous", "Utilisateur", ou collectivement "Utilisateurs").',
    'notAffiliated' => 'Bien que le nom "HammerTime" ("Nom du projet") soit dérivé de l\'ancien nom "Hammer & Chisel" de Discord, Inc. ("Discord")<1/>, le projet n\'est en aucun cas affilié à Discord, ni à M.C. Hammer, dont la chanson<3/> reprend cette phrase de manière proéminente. Le développeur ne détient aucune marque ni aucun droit d\'auteur sur le nom du Projet.',
    'infoCollection' => [
      'heading' => 'Collecte et utilisation des Données',
      'pii' => 'Lorsque vous utilisez le Projet, nous ne vous demandons pas et ne vous encourageons pas à nous fournir des Données à Caractère Personnel ("DCP", "données personnelles") qui peuvent être utilisées pour vous identifier en tant qu\'individu. Les DCP peuvent inclure, sans s\'y limiter : votre nom, votre date de naissance, votre numéro de sécurité sociale, votre localisation, votre numéro de téléphone.',
      'auth' => 'La connexion est fournie à l\'aide de l\'API OAuth 2 de Discord ("API") qui est également sécurisée à l\'aide de HTTPS. Au cours du processus d\'authentification OAuth, notre site ne reçoit pas le nom d\'utilisateur ou le mot de passe, mais seulement un jeton qui peut être utilisé pour vérifier l\'identité de l\'utilisateur à l\'aide de cette API. Pour des raisons de performance, nous stockons localement les informations de base fournies par l\'API (ID utilisateur, nom d\'utilisateur actuel, nom d\'affichage, lien d\'avatar).',
      'removal' => 'Ces informations ne sont pas supprimées automatiquement de notre base de données si vous désactivez votre compte Discord, alors n\'oubliez pas de nous contacter si vous souhaitez que vos données soient supprimées.',
    ],
    'logData' => [
      'heading' => 'Données de journalisation',
      'browserInfo' => 'Nous recueillons des données que votre navigateur envoie chaque fois que vous visitez notre Site ("Données de Journalisation"). Ces Données de Journalisation peuvent inclure des informations telles votre adresse IP, votre système d\'exploitation, type de navigateur, version du navigateur, les pages de notre Site que vous visitez, l\'heure et la date de votre visite.',
      'thirdParty' => 'Ces Données de Journalisation sont stockées uniquement sur notre serveur et ne sont pas partagées avec des tiers. Les Données de Journalisation sont utilisées à des fins de diagnostic et partagées avec les autorités chargées de l\'application de la loi si cela est explicitement demandé. Elles sont conservées pendant 14 jours maximum et sont ensuite supprimées.',
      'debugging' => 'Le Bot peut recevoir des interactions de la part des Utilisateurs via le client Discord, ce qui inclut des commandes slash et des commandes de menu contextuel ("Action", "Commande", ou collectivement "Commandes"). Les commandes slash peuvent également être exécutées avec des paires clé-valeur structurées fournies par l\'Utilisateur ("Options"). Le Bot enregistre les exécutions de Commandes à des fins de débogage, à savoir : le nom d\'utilisateur Discord et l\'identifiant Snowflake ("ID") de l\'Utilisateur qui a exécuté la Commande, le nom de la Commande (y compris toutes les Options) et l\'ID du Serveur dans lequel la Commande a été exécutée. Ces données sont stockées sur le serveur du Projet pour une durée maximale de 30 jours et ne sont accessibles que par le Développeur.',
      'noPii' => 'Lorsque vous exécutez des Commandes, vous devez éviter d\'inclure des Données Personnelles. Certaines informations peuvent être conservées dans notre Journal d\'Application. Veuillez donc nous contacter en utilisant les méthodes décrites à la fin de ce document pour nous informer si notre intervention est nécessaire.',
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
      'heading' => 'Télémétrie et Statistiques',
      'statsCollection' => 'Pour évaluer l\'utilisation du Bot, et ainsi guider les décisions de développement (ex. l\'ajout ou la suppression de fonctionnalités) un ensemble spécifique de données sur les Commandes et leur utilisation peuvent être collectées ("Télémétrie"). Les informations de Télémétrie sont limitées à la commande et aux options utilisées, et quand elles ont été utilisées, sans aucune information d’identification (donc elles ne comprennent jamais les identifiants de serveur ou d’utilisateur, ni les valeurs fournies par l’utilisateur, et est entièrement anonyme). La Télémétrie est stockée indéfiniment et les statistiques qui en découlent sont destinées à être affichées et partagées publiquement sous forme agrégée.',
      'telemetryOptOut' => 'En utilisant le Projet, les Utilisateurs acceptent la collecte de la Télémétrie par défaut. Si un Utilisateur souhaite refuser la collecte de la Télémétrie, il peut indiquer sa préférence en choisissant l\'option appropriée sur la page <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Les cookies sont des fichiers contenant une petite quantité de données. Ils sont envoyés à votre navigateur par un site web et stockés sur le disque dur de votre ordinateur.',
      'disable' => 'Nous utilisons des "cookies" pour conserver des informations. Vous pouvez configurer votre navigateur pour qu\'il refuse tous les cookies ou pour qu\'il vous indique quand un cookie est envoyé. Toutefois, si vous n\'acceptez pas les cookies, il se peut que vous ne puissiez pas utiliser certaines parties de notre Site.',
      'optOut' => 'If you opt out of performance monitoring, a cookie remembering your choice is stored on your device for the longest time your browser allows, as its expiry is renewed each time you open a page of the Site.',
      'session' => 'Pour les utilisateurs connectés, un cookie persistant est utilisé pour mémoriser le statut de connexion à travers les sessions du navigateur pendant 30 jours. Si vous souhaitez que l\'on ne se souvienne plus de vous, vous pouvez vous déconnecter ou effacer les cookies enregistrés par notre Site.',
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
      'heading' => 'Sécurité et confidentialité',
      'noGuarantee' => 'La sécurité de vos Données Personnelles est importante pour nous. Cependant, n\'oubliez pas qu’aucune méthode d\'envoi par Internet ou de stockage électronique n\'est sûre à 100 %. Bien que nous nous efforcions d’utiliser des moyens commercialement acceptables de protéger vos Données Personnelles, nous ne pouvons garantir leur sécurité absolue.',
      'httpsCloudFlare' => 'Le Site utilise HTTPS en utilisant des algorithmes de chiffrement TLS modernes pour protéger l\'intégrité et la sécurité du transport de données entre le navigateur et notre Site. Cependant, nous utilisons le service de proxy inverse de CloudFlare, ce qui signifie qu\'une partie des données envoyées à notre Site passe par leurs serveurs. CloudFlare fonctionne sous sa propre <1>politique de confidentialité</1>.',
      'breachNotify' => 'En cas de faille de sécurité, tous les utilisateurs seront avertis dans les 24 heures suivant la découverte par un avis affiché sur ce site, dans les réponses postées par le Bot et via une annonce dans le serveur de support Discord du Bot.',
    ],
  ],
  'terms' => [
    'heading' => 'Conditions Générales d’Utilisation',
    'license' => 'L\'ensemble du code source du Projet est fourni sur GitHub en l\'état, sans aucune garantie ni responsabilité. Pour connaître les conditions complètes de la licence, veuillez consulter la <1>licence MIT</1>, dont vous trouverez une copie dans chaque dépôt. Les conditions décrites ci-dessous s\'appliquent à la version du Projet hébergée par le Développeur ("Instance") et les limitations imposées ne doivent pas être considérées comme des restrictions à l\'utilisation du code source du Projet.',
    'noAbuse' => 'Vous ne devez pas mettre en place des automatismes pour exécuter des Commandes via l\'Instance de manière répétée. Ce Bot n\'est pas destiné à être utilisé par des outils automatisés, tels que d\'autres bots, ou tout autre logiciel conçu pour imiter l\'activité d\'un utilisateur légitime. Au lieu d\'utiliser la sortie de notre Bot à des fins d\'automatisation, veuillez vous référer à la documentation du langage de programmation utilisé par votre bot pour savoir comment générer et manipuler des horodatages UNIX.',
    'fuckWeb3' => 'Cette Instance ne doit pas être utilisée pour contribuer au processus d\'entraînement des modèles d\'IA générative, ni pour faciliter des événements et/ou des transactions liés à des jetons non fongibles ("NFT") ou à toute forme de crypto-monnaie (par exemple, Ethereum, Bitcoin).',
    'accessRevocation' => 'Votre accès à l\'Instance peut être révoqué pour n\'importe quelle raison (y compris sans raison) à la discrétion du Développeur. Les raisons peuvent inclure, mais ne sont pas limitées à : la violation de ces termes, l\'abus intentionnel des fonctionnalités de l\'Instance, les menaces de violence envers le Développeur ou l\'un des contributeurs du Projet, l\'utilisation de l\'Instance à des fins malveillantes.',
  ],
  'changes' => [
    'heading' => 'Changements et révisions',
    'effectiveFrom' => 'Les Conditions Générales d’Utilisation et la Politique de Confidentialité, collectivement dénommées "Documents", entrent en vigueur à la date de leur dernière mise à jour et le resteront, sauf en ce qui concerne les modifications futures de leurs dispositions, qui entreront en vigueur immédiatement après leur publication sur cette page.',
    'rightToChange' => 'Nous nous réservons le droit de mettre à jour ou de modifier ces Documents à tout moment et nous vous conseillons de consulter régulièrement cette page. En continuant à utiliser le Projet après la publication de toute modification des Documents sur cette page, vous reconnaissez les modifications et acceptez de vous conformer et d\'être lié par les Documents modifiés.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, which is shown for up to two weeks after the update (unless you dismiss it earlier), as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Nous contacter',
    'whereToContact' => 'Si vous avez des questions sur ces Documents ou si vous souhaitez demander la suppression des DCP que nous stockons, veuillez nous contacter via le <1>serveur Discord du Bot</1> ou en utilisant l\'une des méthodes répertoriées sur <3>le site web du Développeur</3>.',
  ],
];
