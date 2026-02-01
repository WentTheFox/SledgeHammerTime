<?php

return [
  'translations' => [
    'title' => 'Conteúdo Traduzido',
    'text' => 'Esse projeto contém traduções feitas por tradutores voluntários e outros membros da comunidade. Essas traduções são oferecidas para conveniência dos usuários e podem estar desatualizadas. Porém, o <1>idioma original</1> dessa página é considerado efetivo.',
  ],
  'lastUpdated' => 'Ultima atualização: <1/>',
  'privacy' => [
    'heading' => 'Política de Privacidade',
    'operator' => '<0/> (nós, nós, nosso ou Desenvolvedor) operamos o "website" "HammerTime" (o "Site) e o "HammerTimeBot (o "Bot", ou Aplicativo), juntamente ao "HammerTime Project" (o projeto). Essa página informa nossas políticas sobre o conjunto, uso e divulgação de informações pessoais recebidos de usuário do projeto (você, usuário ou usuários).',
    'notAffiliated' => 'Ainda que o nome "HammerTime" (nome do projeto) seja derivado do nome "Hammer & Chisel" da Discord, inc. (aplicativo "Discord")<1/>, o projeto não possui qualquer afiliação com o Discord ou com "M.C. Hammer", cuja música<3/> popularizou a expressão. O desenvolvedor não detém direitos de marca ou autorais sobre o nome do projeto.',
    'infoCollection' => [
      'heading' => 'Coleta e uso de informações',
      'pii' => 'While using the Project we do not ask nor encourage you to provide us with any Personally Identifiable Information ("PII", "Personal Information") that can be used to identify you as an individual. PII may include, but is not limited to: your name, birth date, national identification numbers, location, phone number.',
      'auth' => 'Sign in is provided using Discord\'s OAuth 2 API ("API") which is also secured using HTTPS. During the OAuth authentication process our Site does not receive the username or password, only a token that can be used to verify the user\'s identity using this API. For performance reasons we store the basic information provided by the API (user ID, current username, display name, avatar link) locally.',
      'removal' => 'This information is not removed from our database automatically if you deactivate your Discord account, so be sure to reach out to us if you would like your data removed.',
    ],
    'logData' => [
      'heading' => 'Análises',
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
      'intro' => 'Cookies are files with small amount of data. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.',
      'disable' => 'Nós usamos "cookies" para reter informações. Você pode configurar seu navegador para recusar todos os "cookies" ou indicar quando um "cookie" será enviado. Porém, caso não aceite os "cookies", algumas áreas do "Site" podem ficar inacessíveis.',
      'session' => 'Para usuários conectados, um "cookie" temporário é utilizado para manter a conexão nesse navegador durante 30 dias. Se quiser reverter essa configuração, basta se desconectar ou limpar os "cookies" definidos por nosso "Site".',
    ],
    'security' => [
      'heading' => 'Segurança',
      'noGuarantee' => 'A segurança dos seus Dados Pessoais é importante para nós, mas lembre-se que nada compartilhado através da Internet, ou por métodos de salvamento eletrônico, é 100% seguro.  Enquanto nos empenhamos em utilizar meios comercialmente aceitáveis para proteger seus dados, não podemos garantir sua total segurança.',
      'httpsCloudFlare' => 'O Site se utiliza de HTTPS, que usam conjuntos modernos de criptografia TLS para proteger a integridade e o transporte seguro de dados através do navegador e nosso Site. Porém, fazemos o uso do serviço de Proxy Reverso da CloudFlare, fazendo com que alguns desses dados passem por seus servidores. A CloudFlare trabalha sob as próprias políticas de privacidade.',
      'breachNotify' => 'No caso de uma brecha de segurança, todos os usuários serão notificados em até 24 horas do ocorrido, através de um aviso em nosso “website”, em respostas publicadas pelo "Bot." e através de um anúncio no Discord de suporte do "Bot.". ',
    ],
  ],
  'terms' => [
    'heading' => 'Termos e Condições',
    'license' => 'To o código-fonte do projeto está disponível no GitHub, sem qualquer garantia ou responsabilidade. Para acessar os termos completos da licença,  veja  <1>MIT license<1>',
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
