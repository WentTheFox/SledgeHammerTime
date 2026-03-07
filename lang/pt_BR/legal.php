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
      'pii' => 'Ao utilizar o Projeto, não solicitamos nem incentivamos que você nos forneça qualquer Informação de Identificação Pessoal ("IIP", "Informação Pessoal") que possa ser usada para identificá-lo como indivíduo. A IIP pode incluir, entre outras coisas: seu nome, data de nascimento, números de identificação nacional, localização e número de telefone.',
      'auth' => 'O login é feito através da API OAuth 2 do Discord ("API"), que também é protegida por HTTPS. Durante o processo de autenticação OAuth, nosso site não recebe o nome de usuário ou a senha, apenas um token que pode ser usado para verificar a identidade do usuário por meio dessa API. Por motivos de desempenho, armazenamos localmente as informações básicas fornecidas pela API (ID do usuário, nome de usuário atual, nome de exibição, link do avatar).',
      'removal' => 'Essas informações não serão removidas automaticamente do nosso banco de dados se você desativar sua conta do Discord. certifique-se de entrar em contato conosco se quiser que seus dados sejam removidos.',
    ],
    'logData' => [
      'heading' => 'Análises',
      'browserInfo' => 'Coletamos informações enviadas pelo seu navegador sempre que você visitar nosso Site ("Dados de registro"). Este registro de dados pode incluir informações como endereço IP do seu computador, sistema operacional, tipo de navegador, versão do navegador, as páginas do nosso site que você visita, o horário e a data da sua visita.',
      'thirdParty' => 'Esses Dados de Registro são armazenados apenas em nosso servidor e não são compartilhados com terceiros. Os dados de registro são usados ​​para fins de diagnóstico e compartilhados com autoridades policiais, se solicitados explicitamente. Eles são mantidos por até 14 dias e descartados após esse período.',
      'debugging' => 'O Bot pode receber interações de usuários por meio do cliente Discord, incluindo comandos de barra e comandos do menu de contexto ("Ação", "Comando" ou, coletivamente, "Comandos"). Os comandos de barra também podem ser executados com pares de chave-valor estruturados fornecidos pelo usuário ("Opções"). O bot registra as execuções de comandos para fins de depuração, especificamente: o nome de usuário do Discord e o identificador Snowflake ("ID") do usuário que executou o comando, o nome do comando (incluindo todas as opções) e o ID do servidor em que o comando foi executado. Esses dados são armazenados no servidor do projeto por até 30 dias e só podem ser acessados ​​pelo desenvolvedor.',
      'noPii' => 'Ao executar comandos, evite incluir qualquer informação pessoal. Algumas informações podem ser retidas em nosso registro de aplicativos, portanto, entre em contato conosco pelos métodos descritos no final deste documento para nos notificar caso seja necessária nossa intervenção.',
    ],
    'telemetry' => [
      'heading' => 'Telemetria e Estatísticas',
      'statsCollection' => 'Para avaliar o uso do Bot e, assim, orientar as decisões de desenvolvimento (por exemplo, a adição/remoção de funcionalidades), um conjunto específico de dados sobre os Comandos e seu uso pode ser coletado ("Telemetria"). As informações de Telemetria se limitam a quais comandos e opções foram usados ​​e quando foram usados, sem qualquer informação de identificação (portanto, nunca incluem IDs de servidor ou usuário, nem quaisquer valores fornecidos pelo usuário, sendo totalmente anônimas). A Telemetria é armazenada indefinidamente e as estatísticas derivadas dela destinam-se a ser exibidas e compartilhadas publicamente de forma agregada.',
      'telemetryOptOut' => 'Ao utilizar o Projeto, os Usuários concordam com a coleta de Telemetria por padrão. Caso um Usuário deseje optar por não participar da coleta de Telemetria, ele poderá indicar sua preferência por meio da opção apropriada na página <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies são arquivos com uma pequena quantidade de dados. Os cookies são enviados para o seu navegador a partir de um site e armazenados no disco rígido do seu computador.',
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
    'noAbuse' => 'Você não deve configurar automações para executar comandos repetidamente por meio da instância. Este bot não foi projetado para ser usado por ferramentas automatizadas, como outros bots, ou qualquer outro software desenvolvido para simular a atividade legítima de um usuário. Em vez de depender da saída do nosso bot para fins de automação, consulte a documentação da linguagem de programação usada pelo seu bot para obter informações sobre como gerar e manipular data e hora UNIX.',
    'fuckWeb3' => 'Esta instância não deve ser usada para auxiliar no processo de treinamento de modelos generativos de IA, nem para facilitar quaisquer eventos e/ou transações relacionadas a tokens não fungíveis ("NFTs") ou qualquer forma de criptomoeda (por exemplo, Ethereum, Bitcoin).',
    'accessRevocation' => 'Seu acesso à Instância poderá ser revogado por qualquer motivo (inclusive sem motivo algum), a critério do Desenvolvedor. Os motivos podem incluir, mas não se limitam a: violação destes termos, uso indevido intencional dos recursos da Instância, ameaças de violência contra o Desenvolvedor ou qualquer um dos colaboradores do Projeto, uso da Instância para fins maliciosos.',
  ],
  'changes' => [
    'heading' => 'Mudanças e Revisões',
    'effectiveFrom' => 'Os Termos e Condições e a Política de Privacidade, coletivamente denominados "Documentos", entram em vigor a partir da data da sua última atualização e permanecerão em vigor, exceto em relação a quaisquer alterações nas suas disposições no futuro, as quais entrarão em vigor imediatamente após serem publicadas nesta página.',
    'rightToChange' => 'Reservamo-nos o direito de atualizar ou alterar estes Documentos a qualquer momento, e você deve consultar esta página periodicamente. O uso continuado do Projeto após a publicação de quaisquer modificações nos Documentos nesta página constituirá seu reconhecimento das modificações e seu consentimento em cumprir e estar vinculado aos Documentos modificados.',
    'willNotify' => 'Caso façamos alterações substanciais a estes documentos, notificaremos você através de um aviso em destaque no nosso site, bem como publicando um comunicado no servidor de suporte do Discord do bot.',
  ],
  'contact' => [
    'heading' => 'Contato',
    'whereToContact' => 'Se você tiver alguma dúvida sobre estes documentos ou quiser solicitar a remoção de quaisquer informações pessoais que armazenamos, entre em contato conosco através do <1>servidor Discord do Bot</1> ou usando qualquer um dos métodos listados no <3>site do desenvolvedor</3>.',
  ],
];
