<?php

return [
  'title' => 'Perfil',
  'intro' => 'A página de perfil permite que você gerencie as informações da conta relacionadas especificamente ao site. Se estiver procurando onde alterar os padrões e outras configurações para o aplicativo do Discord, acesse a página <1>Configurações do Aplicativo</1>.',
  'information' => [
    'heading' => 'Informações do perfil',
    'description' => "Atualizar as informações do perfil.",
    'displayName' => 'Exibir Nome',
    'hiddenFormats' => 'Formatos ocultos da tabela de seleção',
    'saveSuccess' => 'Seu perfil foi atualizado com sucesso.',
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
  'creditOverrides' => [
    'heading' => 'Translation Credits',
    'description' => 'Customize how you appear in the translation credits for each language where you are a contributor.',
    'displayName' => 'Display Name',
    'avatarProvider' => 'Avatar',
    'avatarProviders' => [
        'discord' => 'Discord',
        'gravatar' => 'Gravatar',
        'crowdin' => 'Crowdin',
    ],
    'gravatarEmail' => 'Email address',
    'gravatarDescription' => '<1>Gravatar</1> allows you to use a single avatar across multiple websites that support it. Your e-mail address will be saved as an MD5 hash.',
    'avatarAccount' => 'Account',
    'url' => 'Link',
    'visibility' => 'Visibility',
    'submit' => 'Submit for approval',
    'saveSuccess' => 'Submitted for approval',
    'saveHideSuccess' => 'Visibility updated',
    'cancel' => 'Cancel changes',
    'statusPrefix' => 'Status',
    'status' => [
      'approved' => 'Approved',
      'inReview' => 'In review',
      'rejected' => 'Rejected',
    ],
    'currentlyApproved' => 'Currently approved values',
    'reApprovalWarning' => 'Changing anything besides visibility will require a manual review. You can cancel the review request at any time from this page.',
    'deleteOverride' => 'Remove override',
    'deleteOverrideConfirm' => 'Are you sure you want to remove your translation credit override? Your entry will revert to the default information from Crowdin.',
    'approvedValues' => [
      'displayName' => 'Name',
      'avatarProvider' => 'Avatar provider',
      'avatarId' => 'Avatar ID',
      'url' => 'Profile URL',
      'visible' => 'Visible',
      'hidden' => 'Hidden',
    ],
  ],
  'deletion' => [
    'heading' => 'Exclusão de Conta',
    'description' => 'Uma vez excluída sua conta, todos os recursos e dados nela serão deletados de forma permanente. Antes disso, baixe qualquer dado ou informação que deseja manter.',
    'deleteButton' => 'Excluir Conta',
    'confirmDialog' => [
      'header' => 'Tem certeza de que deseja excluir sua conta?',
      'body' => 'Após excluir sua conta, todos os seus recursos e dados serão excluídos permanentemente.',
    ],
  ],
];
