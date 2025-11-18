<?php

return [
  'translations' => [
    'title' => 'Contenu traduit',
    'text' => 'Ce projet contient des traductions réalisées par des traducteurs bénévoles et d\'autres membres de la communauté. Ces traductions sont fournies pour la commodité des utilisateurs et peuvent ne pas être totalement à jour. Dans tous les cas, c\'est la <1>version originale</1> de cette page qui fait foi.',
  ],
  'lastUpdated' => 'Dernière mise à jour : <1/>',
  'privacy' => [
    'heading' => 'Politique de Confidentialité',
    'operator' => '<0/> ("nous", "nous", "notre" ou "Développeur") exploite le site Web HammerTime (le "Site") et Bot HammerTime (le "Bot" ou "App"), collectivement le Projet HammerTime (le "Projet"). Cette page vous informe de nos politiques concernant la collecte, l\'utilisation et la divulgation des informations personnelles que nous recevons des utilisateurs du Projet ("vous", "Utilisateur", ou collectivement "Utilisateurs").',
    'notAffiliated' => 'Bien que le nom " HammerTime " (" Nom du projet ") soit dérivé de l\'ancien nom " Hammer & Chisel " de Discord, Inc. (" Discord ")<1/>, le projet n\'est en aucun cas affilié à Discord, ni à M.C. Hammer, dont la chanson<3/> reprend cette phrase de manière proéminente. Le développeur ne détient aucune marque ni aucun droit d\'auteur sur le nom du projet.',
    'infoCollection' => [
      'heading' => 'Collecte et utilisation des informations',
      'pii' => 'Lorsque vous utilisez le projet, nous ne vous demandons pas et ne vous encourageons pas à nous fournir des Informations Personnelles Identifiables ("IPI", "informations personnelles") qui peuvent être utilisées pour vous identifier en tant qu\'individu. Les IPI peuvent inclure, sans s\'y limiter : votre nom, votre date de naissance, vos numéros de sécurité sociale, votre lieu de résidence, votre numéro de téléphone.',
      'auth' => 'La connexion est fournie à l\'aide de l\'API OAuth 2 de Discord ("API") qui est également sécurisée à l\'aide de HTTPS. Au cours du processus d\'authentification OAuth, notre site ne reçoit pas le nom d\'utilisateur ou le mot de passe, mais seulement un jeton qui peut être utilisé pour vérifier l\'identité de l\'utilisateur à l\'aide de cette API. Pour des raisons de performance, nous stockons localement les informations de base fournies par l\'API (ID utilisateur, nom d\'utilisateur actuel, nom d\'affichage, lien d\'avatar).',
      'removal' => 'Ces informations ne sont pas supprimées automatiquement de notre base de données si vous désactivez votre compte Discord, alors n\'oubliez pas de nous contacter si vous souhaitez que vos données soient supprimées.',
    ],
    'logData' => [
      'heading' => 'Données de journalisation',
      'browserInfo' => 'Nous recueillons des informations que votre navigateur envoie chaque fois que vous visitez notre site ("données de journalisation"). Ces données peuvent inclure des informations telles votre adresse IP, votre système d\'exploitation, type de navigateur, version du navigateur, les pages de notre site que vous visitez, l\'heure et la date de votre visite.',
      'thirdParty' => 'Ces données de journalisation sont stockées uniquement sur notre serveur et ne sont pas partagées avec des tiers. Les données de journalisation sont utilisées à des fins de diagnostic et partagées avec les autorités chargées de l\'application de la loi si cela est explicitement demandé. Elles sont conservées pendant 14 jours maximum et sont ensuite supprimées.',
      'debugging' => 'Le Bot peut recevoir des interactions de la part des utilisateurs via le client Discord, ce qui inclut des commandes slash et des commandes de menu contextuel ("Action", "Commande", ou collectivement "Commandes"). Les commandes "slash" peuvent également être exécutées avec des paires clé-valeur structurées fournies par l\'utilisateur ("options"). Le Bot enregistre les exécutions de commandes à des fins de débogage, à savoir : le nom d\'utilisateur Discord et l\'identifiant Snowflake ("ID") de l\'utilisateur qui a exécuté la commande, le nom de la commande (y compris toutes les options) et l\'ID du serveur dans lequel la commande a été exécutée. Ces données sont stockées sur le serveur du projet pour une durée maximale de 30 jours et ne sont accessibles qu\'au développeur.',
      'noPii' => 'Lorsque vous exécutez des commandes, vous devez éviter d\'inclure des informations personnelles. Certaines informations peuvent être conservées dans notre journal d\'application. Veuillez donc nous contacter en utilisant les méthodes décrites à la fin de ce document pour nous informer si notre intervention est nécessaire.',
    ],
    'telemetry' => [
      'heading' => 'Télémétrie et statistiques',
      'statsCollection' => 'Pour évaluer l\'utilisation du Bot, et ainsi guider les décisions de développement (ex. l\'ajout ou la suppression de fonctionnalités) un ensemble spécifique de données sur les Commandes et leur utilisation peuvent être collectées ("Télémétrie"). Les informations de télémétrie sont limitées à la commande et aux options utilisées, et quand elles ont été utilisées, sans aucune information d’identification (donc elle ne comprend jamais les identifiants de serveur ou d’utilisateur, ni les valeurs fournies par l’utilisateur, et est entièrement anonyme). La télémétrie est stockée indéfiniment et les statistiques qui en découlent sont destinées à être affichées et partagées publiquement sous forme agrégée.',
      'telemetryOptOut' => 'En utilisant le projet, les utilisateurs acceptent la collecte de données télémétriques par défaut. Si un utilisateur souhaite refuser la collecte de données télémétriques, il peut indiquer sa préférence en choisissant l\'option appropriée sur la page <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Les cookies sont des fichiers contenant une petite quantité de données. Ils sont envoyés à votre navigateur par un site web et stockés sur le disque dur de votre ordinateur.',
      'disable' => 'Nous utilisons des "cookies" pour conserver des informations. Vous pouvez configurer votre navigateur pour qu\'il refuse tous les cookies ou pour qu\'il vous indique quand un cookie est envoyé. Toutefois, si vous n\'acceptez pas les cookies, il se peut que vous ne puissiez pas utiliser certaines parties de notre site.',
      'session' => 'Pour les utilisateurs connectés, un cookie persistant est utilisé pour mémoriser le statut de connexion à travers les sessions du navigateur pendant 30 jours. Si vous souhaitez que l\'on ne se souvienne plus de vous, vous pouvez vous déconnecter ou effacer les cookies enregistrés par notre site.',
    ],
    'security' => [
      'heading' => 'Sécurité et confidentialité',
      'noGuarantee' => 'La sécurité de vos données personnelles est importante pour nous,. Cependant, n\'oubliez pas qu’aucune méthode d\'envoi par internet ou de stockage électronique n\'est sûre à 100 %. Bien que nous nous efforcions d’utiliser des moyens commercialement acceptables de protéger vos données personnelles, nous ne pouvons garantir leur sécurité absolue.',
      'httpsCloudFlare' => 'Le Site utilise HTTPS en utilisant des algorithmes de chiffrement TLS modernes pour protéger l\'intégrité et la sécurité du transport de données entre le navigateur et notre Site. Cependant, nous utilisons le service de proxy inverse de CloudFlare, ce qui signifie qu\'une partie des données envoyées à notre Site passe par leurs serveurs. CloudFlare fonctionne sous sa propre <1>politique de confidentialité</1>.',
      'breachNotify' => 'En cas de faille de sécurité, tous les utilisateurs seront avertis dans les 24 heures suivant la découverte par un avis affiché sur ce site, dans les réponses postées par le Bot et via une annonce dans le serveur de support Discord du Bot.',
    ],
  ],
  'terms' => [
    'heading' => 'Conditions générales d’utilisation',
    'license' => 'L\'ensemble du code source du projet est fourni sur GitHub en l\'état, sans aucune garantie ni responsabilité. Pour connaître les conditions complètes de la licence, veuillez consulter la <1>licence MIT</1>, dont vous trouverez une copie dans chaque dépôt. Les conditions décrites ci-dessous s\'appliquent à la version du projet hébergée par le développeur ("Instance") et les limitations imposées ne doivent pas être considérées comme des restrictions à l\'utilisation du code source du projet.',
    'noAbuse' => 'Vous ne devez pas mettre en place des automatismes pour exécuter des commandes via l\'instance de manière répétée. Ce bot n\'est pas destiné à être utilisé par des outils automatisés, tels que d\'autres bots, ou tout autre logiciel conçu pour imiter l\'activité d\'un utilisateur légitime. Au lieu d\'utiliser la sortie de notre Bot à des fins d\'automatisation, veuillez vous référer à la documentation du langage de programmation utilisé par votre Bot pour savoir comment générer et manipuler des horodatages UNIX.',
    'fuckWeb3' => 'Cette Instance ne doit pas être utilisée pour contribuer au processus d\'entraînement des modèles d\'IA générative, ni pour faciliter des événements et/ou des transactions liés à des jetons non fongibles ("NFT") ou à toute forme de crypto-monnaie (par exemple, Ethereum, Bitcoin).',
    'accessRevocation' => 'Votre accès à l\'Instance peut être révoqué pour n\'importe quelle raison (y compris sans raison) à la discrétion du développeur. Les raisons peuvent inclure, mais ne sont pas limitées à : la violation de ces termes, l\'abus intentionnel des fonctionnalités de l\'Instance, les menaces de violence envers le développeur ou l\'un des contributeurs du projet, l\'utilisation de l\'Instance à des fins malveillantes.',
  ],
  'changes' => [
    'heading' => 'Changements et révisions',
    'effectiveFrom' => 'Les conditions générales et la politique de protection de la vie privée, collectivement dénommées "documents", entrent en vigueur à la date de leur dernière mise à jour et le resteront, sauf en ce qui concerne les modifications futures de leurs dispositions, qui entreront en vigueur immédiatement après leur publication sur cette page.',
    'rightToChange' => 'Nous nous réservons le droit de mettre à jour ou de modifier ces documents à tout moment et nous vous conseillons de consulter régulièrement cette page. En continuant à utiliser le projet après la publication de toute modification des documents sur cette page, vous reconnaissez les modifications et acceptez de vous conformer et d\'être lié par les documents modifiés.',
    'willNotify' => 'Si nous apportons des modifications importantes à ces documents, nous vous en informerons en plaçant une notification bien visible sur notre site web, ainsi qu\'en publiant une annonce sur le serveur de support Discord du Bot.',
  ],
  'contact' => [
    'heading' => 'Nous contacter',
    'whereToContact' => 'Si vous avez des questions sur ces documents ou si vous souhaitez demander la suppression des IIP ("Informations Personnelles Identifiables") que nous stockons, veuillez nous contacter via le <1>serveur Discord du Bot</1> ou en utilisant l\'une des méthodes répertoriées sur <3>le site web du développeur</3>.',
  ],
];
