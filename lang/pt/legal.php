<?php

return [
  'translations' => [
    'title' => 'Conteúdo traduzido',
    'text' => 'Este projeto contém traduções realizadas por tradutores voluntários e outros membros da comunidade. Estas traduções são disponibilizadas para conveniência dos utilizadores e podem nem sempre estar totalmente atualizadas. Em todos os casos, a versão na <1>língua original</1> desta página é considerada a versão válida.',
  ],
  'lastUpdated' => 'Última atualização: <1/>',
  'privacy' => [
    'heading' => 'Política de Privacidade',
    'operator' => '<0/> ("nós", "nós", "nosso", ou "Desenvolvedor") opera o website HammerTime (o "Site"), e o HammerTimeBot (o "Bot", ou "App"), coletivamente o Projeto HammerTime (o "Projeto"). Esta página informa-o das nossas políticas relativas à recolha, utilização e divulgação de informações pessoais que recebemos dos utilizadores do Projeto ("você", "Utilizador", ou coletivamente "Utilizadores").',
    'notAffiliated' => 'Embora o nome «HammerTime» («Nome do Projeto») derive do antigo nome «Hammer & Chisel» da Discord, Inc. («Discord»)<1/>, o Projeto não está de forma alguma associado à Discord, nem a M.C. Hammer, cuja canção<3/> destaca esta expressão de forma proeminente. O Desenvolvedor não detém qualquer marca registada ou direito de autor sobre o Nome do Projeto.',
    'infoCollection' => [
      'heading' => 'Coleta e uso de informações',
      'pii' => 'Ao utilizar o Projeto, não solicitamos nem encorajamos que nos forneça quaisquer Informações de Identificação Pessoal («PII», «Informações Pessoais») que possam ser utilizadas para o identificar como indivíduo. As PII podem incluir, entre outras: o seu nome, data de nascimento, números de identificação nacional, localização e número de telefone.',
      'auth' => 'O início de sessão é efetuado através da API OAuth 2 do Discord («API»), que também é protegida por HTTPS. Durante o processo de autenticação OAuth, o nosso Site não recebe o nome de utilizador nem a palavra-passe, mas apenas um token que pode ser utilizado para verificar a identidade do utilizador através desta API. Por motivos de desempenho, armazenamos localmente as informações básicas fornecidas pela API (ID do utilizador, nome de utilizador atual, nome de exibição, ligação para o avatar).',
      'removal' => 'Estas informações não são removidas automaticamente da nossa base de dados caso desative a sua conta do Discord; por isso, não se esqueça de nos contactar caso pretenda que os seus dados sejam removidos.',
    ],
    'logData' => [
      'heading' => 'Registro de dados',
      'browserInfo' => 'Coletamos informações enviadas pelo seu navegador sempre que você visitar nosso Site ("Dados de registro"). Este registro de dados pode incluir informações como endereço IP do seu computador, sistema operacional, tipo de navegador, versão do navegador, as páginas do nosso site que você visita, o horário e a data da sua visita.',
      'thirdParty' => 'Estes dados de registo são armazenados exclusivamente no nosso servidor e não são partilhados com terceiros. Os dados de registo são utilizados para fins de diagnóstico e partilhados com as autoridades policiais, caso tal seja explicitamente solicitado. São conservados durante um período máximo de 14 dias, sendo posteriormente eliminados.',
      'debugging' => 'O Bot pode receber interações de usuários através do cliente do Discord, o que inclui comandos de barra e comandos do menu de contexto ("Ação", "Comando", ou coletivamente "Comando"). Comandos de traço podem ser executados adicionalmente com pares de valor-chave estruturados fornecidos pelo usuário ("Opções"). O Bot registra execuções de Comando para fins de depuração, nomeadamente: o nome de usuário do Discord e identificador do Snowflake ("ID") do usuário que executou o comando, o nome do Comando (incluindo todas as opções) e o ID do Servidor no qual o Comando foi executado. Estes dados são armazenados no servidor do Projeto por até 30 dias e só são acessíveis pelo Desenvolvedor.',
      'noPii' => 'Ao executar comandos, deve evitar incluir quaisquer dados pessoais. Algumas informações poderão ainda assim ficar registadas no nosso registo de aplicações; por isso, contacte-nos através dos meios descritos no final deste documento para nos notificar caso seja necessária a nossa intervenção.',
    ],
    'telemetry' => [
      'heading' => 'Telemetria e Estatísticas',
      'statsCollection' => 'A fim de avaliar a utilização do Bot e, assim, orientar as decisões de desenvolvimento (por exemplo, a adição ou remoção de funcionalidades), poderá ser recolhido um conjunto específico de dados sobre os comandos e a sua utilização («Telemetria»). As informações de telemetria limitam-se aos comandos e opções utilizados, bem como ao momento em que foram utilizados, sem quaisquer dados de identificação (por conseguinte, nunca incluem IDs de servidor ou de utilizador, nem quaisquer valores fornecidos pelo utilizador, sendo totalmente anónimas). A telemetria é armazenada por tempo indeterminado e as estatísticas daí derivadas destinam-se a ser apresentadas e partilhadas publicamente de forma agregada.',
      'telemetryOptOut' => 'Ao utilizar o Projeto, os utilizadores concordam com a recolha de dados de telemetria por padrão. Caso um utilizador pretenda recusar a recolha de dados de telemetria, poderá indicar a sua preferência através da opção adequada na página <1/>.',
    ],
    'cookies' => [
      'heading' => '“Cookies”',
      'intro' => 'Os “cookies” são ficheiros que contêm uma pequena quantidade de dados. Os “cookies” são enviados para o seu navegador a partir de um site e armazenados no disco rígido do seu computador.',
      'disable' => 'Utilizamos «‘cookies’» para guardar informações. Pode configurar o seu navegador para recusar todos os “cookies” ou para o avisar sempre que um “cookie” estiver a ser enviado. No entanto, se não aceitar “cookies”, poderá não conseguir utilizar algumas partes do nosso site.',
      'session' => 'Para usuários logados, um cookie persistente é usado para lembrar o status logado em todas as sessões do navegador por 30 dias. Se você quiser parar de ser lembrado, você pode sair ou limpar os cookies definidos por nosso site.',
    ],
    'security' => [
      'heading' => 'Segurança',
      'noGuarantee' => 'A segurança de suas Informações Pessoais é importante para nós, mas lembre-se de que nenhum método de transmissão pela internet, ou método de armazenamento eletrônico, é 100% seguro. Embora nós nos empenhemos em usar meios comercialmente aceitáveis de proteger suas Informações Pessoais, nós não podemos garantir sua segurança absoluta.',
      'httpsCloudFlare' => 'O Site utiliza HTTPS usando modernos conjuntos de criptografia TLS para proteger a integridade e o transporte seguro de dados entre o navegador e o nosso Site. No entanto, utilizamos o serviço de Proxy reverso do CloudFlare, o que significa que uma parte dos dados enviados para o nosso Site passa por seus servidores. CloudFlare opera sob sua própria <1>política de privacidade</1>.',
      'breachNotify' => 'No caso de violação de segurança todos os usuários serão notificados dentro de 24 horas a partir da descoberta através de um aviso publicado neste site, em respostas publicadas pelo Bot e por meio de um anúncio no servidor de suporte do Discord do Bot.',
    ],
  ],
  'terms' => [
    'heading' => 'Termos e Condições',
    'license' => 'Todo o código-fonte do projeto é fornecido no GitHub como está, sem qualquer garantia ou responsabilidade. Para termos de licença completos, por favor veja a licença <1>MIT</1>, uma cópia da qual pode ser encontrada em cada repositório. Os termos descritos abaixo aplicam-se à versão do Projeto hospedado pelo Desenvolvedor ("Instância") e as limitações impostas dentro não devem ser tratadas como restrições ao uso do código fonte do projeto.',
    'noAbuse' => 'Você não deve configurar automações para executar comandos através da instância repetidamente. Este Bot não deve ser usado por ferramentas automatizadas, como outros bots, ou qualquer outro software projetado para imitar a atividade de usuário legítimo. Em vez de confiar na saída do nosso bot para fins de automação, por favor, consulte a documentação da linguagem de programação usada pelo seu bot sobre como gerar e manipular as carimbos de tempo do UNIX.',
    'fuckWeb3' => 'This Instance shall not be used to aid in the process of training generative AI models, nor to help facilitate any events and/or transactions related to non-fungible tokens ("NFTs") or any form of cryptocurrency (e.g. Ethereum, Bitcoin).',
    'accessRevocation' => 'O seu acesso à Instância poderá ser revogado por qualquer motivo (incluindo sem motivo) a critério do Desenvolvedor. Os motivos podem incluir, entre outros: violação destes termos, abuso intencional das funcionalidades da Instância, ameaças de violência contra o Desenvolvedor ou qualquer um dos colaboradores do Projeto, utilização da Instância para fins maliciosos.',
  ],
  'changes' => [
    'heading' => 'Mudanças e revisões',
    'effectiveFrom' => 'Os Termos e Condições e a Política de Privacidade, designados coletivamente por «Documentos», entram em vigor a partir da data da sua última atualização e permanecerão em vigor, salvo no que diz respeito a quaisquer alterações futuras às suas disposições, as quais entrarão em vigor imediatamente após a sua publicação nesta página.',
    'rightToChange' => 'Nós nos reservamos o direito de atualizar ou alterar esses Documentos a qualquer momento e você deverá consultar essa página periodicamente. Seu uso continuado do Projeto depois que postarmos qualquer modificação nos Documentos nesta página constituirá seu reconhecimento das modificações e seu consentimento para respeitar e ser vinculado pelos Documentos modificados.',
    'willNotify' => 'Caso introduzamos quaisquer alterações substanciais nestes Documentos, iremos notificá-lo através da publicação de um aviso em destaque no nosso site, bem como através da publicação de um comunicado no servidor de apoio do Bot no Discord.',
  ],
  'contact' => [
    'heading' => 'Contacte-nos',
    'whereToContact' => 'Caso tenha alguma dúvida sobre estes Documentos ou pretenda solicitar a remoção de quaisquer DPI que tenhamos armazenadas, contacte-nos através do <1>servidor Discord do Bot</1> ou utilizando qualquer um dos métodos indicados no <3>site do Desenvolvedor</3>.',
  ],
];
