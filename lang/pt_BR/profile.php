<?php

return [
  'title' => 'Perfil',
  'intro' => 'A página de perfil permite que você gerencie as informações da conta relacionadas especificamente ao site. Se estiver procurando onde alterar os padrões e outras configurações para o aplicativo do Discord, acesse a página <1>Configurações do Aplicativo</1>.',
  'information' => [
    'heading' => 'Informações do perfil',
    'description' => "Atualizar as informações do perfil.",
    'displayName' => 'Exibir Nome',
    'hiddenFormats' => 'Formatos ocultos da tabela de seleção',
    'saveSuccess' => 'Your profile has been updated successfully.',
  ],
  'accounts' => [
    'heading' => 'Contas Conectadas',
    'description' => 'Você pode vincular várias contas à sua conta HammerTime para poder gerenciá-las em um só lugar. As informações básicas de usuário exibidas aqui são atualizadas automaticamente no máximo uma vez por hora ao carregar esta página.',
    'discord' => 'Contas do Discord',
    'crowdin' => 'Contas do CrowdIn',
    'noConnectedAccounts' => 'Você não tem nenhuma conta conectada no momento',
    'linkAdditional' => [
      'heading' => 'Conectar outras contas',
      'description' => 'Utilize os botões abaixo para conectar contas adicionais à sua conta atual do HammerTime.',
      'discord' => [
        'description' => 'Se sua imagem de perfil ou nome de exibição mudou, você pode usar isto para atualizar essas informações para qualquer conta do Discord que já tenha sido vinculada.',
        'authorize' => 'Autorizar conta do Discord',
      ],
      'crowdin' => [
        'description' => 'Se você é um tradutor do projeto, vincular sua conta do CrowdIn eventualmente permitirá que você customize como o seu nome aparece nos créditos de tradução, além de servir como um nível a mais de verificação de que estas contas pertencem a você, caso entre no servidor do Discord do projeto.',
        'authorize' => 'Autorizar conta do CrowdIn',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Exclusão de Conta',
    'description' => 'Uma vez excluída sua conta, todos os recursos e dados nela serão deletados de forma permanente. Antes disso, baixe qualquer dado ou informação que deseja manter.',
    'deleteButton' => 'Excluir Conta',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
