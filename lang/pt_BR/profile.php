<?php

return [
  'title' => 'Perfil',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'Profile Information',
    'description' => "Update your account's profile information.",
    'displayName' => 'Display Name',
    'hiddenFormats' => 'Formats hidden from picker table',
    'saveSuccess' => 'Your profile has been updated successfully.',
  ],
  'accounts' => [
    'heading' => 'Connected Accounts',
    'description' => [
      'A HammerTime account is going to let you link multiple Discord accounts to be able to manage their resources in one place in the future.',
      'Below you can find a list of all Discord accounts associated with this HammerTime account.',
    ],
    'discord' => 'Contas do Discord',
    'crowdin' => 'Contas do CrowdIn',
    'noConnectedAccounts' => 'You do not have any accounts connected at the moment',
    'linkAdditional' => [
      'heading' => 'Vincular ou Atualizar Conta',
      'description' => 'Ao vincular várias contas a uma única conta do HammerTime, você pode gerenciar as configurações de todas as contas conectadas do mesmo lugar.',
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
    'heading' => 'Account Deletion',
    'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
    'deleteButton' => 'Delete Account',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
