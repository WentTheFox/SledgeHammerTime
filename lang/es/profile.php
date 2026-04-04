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
    'description' => 'Puedes vincular varias cuentas a tu cuenta de HammerTime para poder gestionarlas todas en un solo lugar. La información básica de usuario que se muestra aquí se actualiza automáticamente como máximo una vez por hora al cargar esta página.',
    'discord' => 'Cuentas de Discord',
    'crowdin' => 'Cuentas de Crowdin',
    'noConnectedAccounts' => 'No tienes ninguna cuenta conectada en este momento',
    'linkAdditional' => [
      'heading' => 'Vincular cuentas adicionales',
      'description' => 'Utiliza los botones de abajo para conectar cuentas adicionales a tu cuenta actual de HammerTime.',
      'discord' => [
        'description' => 'Si tu foto de perfil o nombre para mostrar cambió, también puedes usar esto para actualizar esa información para cualquier cuenta de Discord que ya esté vinculada.',
        'authorize' => 'Autorizar cuenta de Discord',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account lets you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Autorizar cuenta de Crowdin',
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
    'heading' => 'Eliminación de cuenta',
    'description' => 'Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente. Antes de eliminar tu cuenta, por favor descarga cualquier dato o información que desees conservar.',
    'deleteButton' => 'Eliminar cuenta',
    'confirmDialog' => [
      'header' => '¿Estás seguro de que quieres eliminar tu cuenta?',
      'body' => 'Una vez que tu cuenta sea eliminada, todos sus recursos y datos serán eliminados permanentemente.',
    ],
  ],
];
