<?php

return [
  'title' => 'Perfil',
  'intro' => 'La página de perfil te permite administrar la información de tu cuenta específicamente relacionada con el sitio web. Si buscas dónde cambiar los valores predeterminados y otras configuraciones para la aplicación de Discord, visita la página <1>Ajustes de la aplicación</1>.',
  'information' => [
    'heading' => 'Información del perfil',
    'description' => "Actualiza la información de perfil de tu cuenta.",
    'displayName' => 'Nombre para mostrar',
    'hiddenFormats' => 'Formatos ocultos de la tabla de selección',
    'saveSuccess' => 'Tu perfil se ha actualizado correctamente.',
  ],
  'accounts' => [
    'heading' => 'Cuentas conectadas',
    'description' => [
      'Una cuenta de HammerTime te permitirá vincular múltiples cuentas de Discord para poder administrar sus recursos en un solo lugar en el futuro.',
      'A continuación puedes encontrar una lista de todas las cuentas de Discord asociadas con esta cuenta de HammerTime.',
    ],
    'discord' => 'Cuentas de Discord',
    'crowdin' => 'Cuentas de Crowdin',
    'noConnectedAccounts' => 'No tienes ninguna cuenta conectada en este momento',
    'linkAdditional' => [
      'heading' => 'Vincular o actualizar cuenta',
      'description' => 'Al vincular múltiples cuentas a una sola cuenta de HammerTime, puedes administrar la configuración de todas las cuentas conectadas en un solo lugar.',
      'discord' => [
        'description' => 'Si tu foto de perfil o nombre para mostrar cambió, también puedes usar esto para actualizar esa información para cualquier cuenta de Discord que ya esté vinculada.',
        'authorize' => 'Autorizar cuenta de Discord',
      ],
      'crowdin' => [
        'description' => 'Si eres traductor del proyecto, vincular tu cuenta de Crowdin eventualmente te permitirá personalizar cómo aparece tu nombre en los créditos de traducción, y también sirve como un nivel extra de verificación de que estas cuentas te pertenecen en caso de que te unas al servidor de Discord del proyecto.',
        'authorize' => 'Autorizar cuenta de Crowdin',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'Eliminación de cuenta',
    'description' => 'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
    'deleteButton' => 'Delete Account',
    'confirmDialog' => [
      'header' => 'Are you sure you want to delete your account?',
      'body' => 'Once your account is deleted, all of its resources and data will be permanently deleted.',
    ],
  ],
];
