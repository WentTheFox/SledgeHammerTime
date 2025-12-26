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
        'description' => 'Si eres traductor del proyecto, vincular tu cuenta de Crowdin eventualmente te permitirá personalizar cómo aparece tu nombre en los créditos de traducción, y también sirve como un nivel extra de verificación de que estas cuentas te pertenecen en caso de que te unas al servidor de Discord del proyecto.',
        'authorize' => 'Autorizar cuenta de Crowdin',
      ],
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
