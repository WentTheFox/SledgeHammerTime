<?php

return [
  'seoDescription' => 'Genera marcas de tiempo para mensajes de chat de Discord',
  'changeLanguage' => 'Cambiar Idioma',
  "notFound" => [
    "heading" => "Página no encontrada",
    "content" => "No hay resultados para mostrar.",
  ],
  "maintenanceMode" => [
    "heading" => "Modo de mantenimiento",
    "content" => [
      'pleaseWait' => "La aplicación se está actualizando actualmente, por favor intenta de nuevo en unos segundos.",
      'joinSupportServer' => "Si el problema persiste por más de unos minutos, por favor únete al servidor de soporte de Discord y avísanos.",
      'contactDeveloper' => "Si el problema persiste por más de unos minutos, por favor contacta al desarrollador y avísale.",
    ],
    "supportServerButton" => "Servidor de soporte",
  ],
  'incompleteTranslations' => 'Las traducciones están incompletas',
  'contributeTranslations' => 'Contribuye',
  'copyToClipboard' => 'Copiar al portapapeles',
  'copiedToClipboard' => '¡Copiado al portapapeles!',
  'jsDisabled' => [
    'title' => 'JavaScript es necesario',
    'body' => "Su navegador no soporta JavaScript o está actualmente deshabilitado. Algunos navegadores deshabilitan JavaScript por defecto por razones de seguridad, pero es necesario para esta aplicación. Por favor, actívelo y actualice la página o utilice un navegador diferente.",
  ],
  'nav' => [
    'botSettings' => 'Ajustes de aplicación',
    'profile' => 'Perfil',
    'legal' => 'Información legal',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Ajustes de entrada',
      'customDateInput' => [
        'label' => 'Entrada de fecha personalizada',
        'description' => "Reemplaza la entrada de fecha predeterminada del navegador con una personalizada.",
      ],
      'customTimeInput' => [
        'label' => 'Entrada de hora personalizada',
        'description' => "Reemplaza la entrada de hora predeterminada del navegador con una personalizada. Esto es especialmente útil si tienes problemas para seleccionar la hora en navegadores móviles.",
      ],
      'separateInputs' => [
        'label' => 'Entradas separadas',
        'description' => "Muestra dos entradas diferentes para la fecha y la hora en lugar de una combinada (que no es compatible con algunos navegadores)",
      ],
      'flatUi' => [
        'label' => 'Aplanar interfaz',
        'description' => "Desactivar efectos de sombra y altura en campos de entrada y botones",
      ],
    ],
    'timeSync' => [
      'title' => 'Sincronización de hora',
      'status' => [
        'syncing' => 'El reloj de tu sistema se está sincronizando actualmente con nuestros servidores, por favor espera.',
        'accurate' => 'El reloj del sistema es preciso.',
        'potentiallyWrong' => 'El reloj de tu sistema podría estar mal.',
        'value' => 'La diferencia entre la hora local y la del servidor es :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Aplicar el desfase de tiempo del servidor a los cálculos (beta)',
        'description' => '"Si el reloj de tu sistema tiene una diferencia superior a :offset con respecto al tiempo del servidor (excluyendo las diferencias de zona horaria), algunos cálculos de tiempo se ajustarán para tener esto en cuenta, de modo que sea menos probable que tus marcas de tiempo sean incorrectas. <1>¡Esta es una función experimental, úsala con precaución!</1> La sincronización se realiza cuando la página se carga por primera vez y justo después de activar la configuración.',
      ],
      'details' => 'Detalles',
      'autoApplyCheckbox' => 'Aplicar el desfase calculado a la biblioteca DateTime al presionar :syncButtonLabel manualmente (solo se aplica si la diferencia supera el umbral de :offset)',
      'syncButtonLabel' => 'Sincronizar',
      'resetOffsetButtonLabel' => 'Restablecer el desfase aplicado',
      'roundTripDuration' => 'Duración del viaje de ida y vuelta',
      't0' => 'La marca de tiempo del cliente en el momento de la transmisión de la solicitud',
      't1' => 'La marca de tiempo del servidor en la recepción de la solicitud',
      't2' => 'La marca de tiempo del servidor en la transmisión de la respuesta',
      't3' => 'La marca de tiempo del cliente en la recepción de la respuesta',
      'dtlOffsetCell' => 'Desfase de cálculo activo',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Desfase detectado (a través de la red)',
    ],
    'localSettings' => [
      'title' => 'Configuración local',
    ],
    'credits' => [
      'title' => 'Créditos',
      'developedBy' => 'Desarrollado por <1></1>',
      'using' => 'Utilizando <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Traducciones por <1></1>',
      'openSourceSoftware' => 'Software de código abierto',
      'viewSourceCode' => 'Ver código fuente',
      'notAffiliated' => 'Este proyecto no está afiliado con Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tema oscuro',
      'light' => 'Tema claro',
      'system' => 'Usar tema del sistema',
    ],
  ],
  'designEditor' => [
    'title' => 'Editor de diseño',
    'description' => 'Puedes ajustar muchos aspectos de la apariencia del sitio web usando los campos en la tabla de abajo. Los nombres de las variables están basados en identificadores del código y por lo tanto no pueden ser traducidos. Los valores se restablecerán al actualizar la página.',
    'designPageLink' => 'Página de diseño',
    'exportInfo' => 'Puedes exportar tus cambios a un archivo UserStyle, que puede usarse con una extensión como <1>Stylus</1> para personalizar la apariencia de la aplicación permanentemente. Ten en cuenta, sin embargo, que estas variables pueden cambiar en cualquier momento, requiriendo que actualices manualmente tus estilos personalizados.',
    'export' => 'Exportar como UserStyle',
    'variableColumnHeader' => 'Variable CSS',
    'valueColumnHeader' => 'Valor',
  ],
];
