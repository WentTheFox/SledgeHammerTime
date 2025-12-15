<?php

return [
  'translations' => [
    'title' => 'Contenido traducido',
    'text' => 'Este proyecto contiene traducciones realizadas por traductores voluntarios y otros miembros de la comunidad. Estas traducciones se proporcionan para la conveniencia de los usuarios y pueden no estar siempre completamente actualizadas. En todos los casos, se considera vigente la <1>versión en el idioma original</1> de esta página.',
  ],
  'lastUpdated' => 'Última actualización: <1/>',
  'privacy' => [
    'heading' => 'Política de Privacidad',
    'operator' => '<0/> ("nosotros", "nuestro", "nos", o "Desarrollador") opera el sitio web HammerTime (el "Sitio") y HammerTimeBot (el "Bot", o "Aplicación"), colectivamente el Proyecto HammerTime (el "Proyecto"). Esta página te informa sobre nuestras políticas respecto a la recopilación, uso y divulgación de Información Personal que recibimos de los usuarios del Proyecto ("tú", "Usuario", o colectivamente "Usuarios").',
    'notAffiliated' => 'Aunque el nombre "HammerTime" ("Nombre del Proyecto") se deriva del antiguo nombre "Hammer & Chisel" de Discord, Inc. ("Discord")<1/>, el Proyecto no está afiliado de ninguna manera con Discord, ni con M.C. Hammer, cuya canción<3/> presenta esta frase de manera destacada. El Desarrollador no posee ninguna marca registrada ni derechos de autor sobre el Nombre del Proyecto.',
    'infoCollection' => [
      'heading' => 'Recopilación y Uso de Información',
      'pii' => 'Al usar el Proyecto, no te pedimos ni te animamos a proporcionarnos ninguna Información de Identificación Personal ("PII", "Información Personal") que pueda usarse para identificarte como individuo. La PII puede incluir, pero no se limita a: tu nombre, fecha de nacimiento, números de identificación nacional, ubicación, número de teléfono.',
      'auth' => 'El inicio de sesión se proporciona usando la API OAuth 2 de Discord ("API") que también está protegida mediante HTTPS. Durante el proceso de autenticación OAuth, nuestro Sitio no recibe el nombre de usuario ni la contraseña, solo un token que puede usarse para verificar la identidad del usuario usando esta API. Por razones de rendimiento, almacenamos localmente la información básica proporcionada por la API (ID de usuario, nombre de usuario actual, nombre para mostrar, enlace de avatar).',
      'removal' => 'Esta información no se elimina de nuestra base de datos automáticamente si desactivas tu cuenta de Discord, así que asegúrate de contactarnos si deseas que se eliminen tus datos.',
    ],
    'logData' => [
      'heading' => 'Datos de registro',
      'browserInfo' => 'Recopilamos información que tu navegador envía cada vez que visitas nuestro Sitio ("Datos de Registro"). Estos Datos de Registro pueden incluir información como la dirección IP de tu computadora, sistema operativo, tipo de navegador, versión del navegador, las páginas de nuestro Sitio que visitas, la hora y fecha de tu visita.',
      'thirdParty' => 'Estos Datos de Registro se almacenan únicamente en nuestro servidor y no se comparten con terceros. Los Datos de Registro se usan para fines de diagnóstico, y se comparten con agencias de aplicación de la ley si se solicita explícitamente. Se conservan hasta 14 días y se descartan después.',
      'debugging' => 'El Bot puede recibir interacciones de Usuarios a través del cliente de Discord, lo que incluye comandos de barra y comandos de menú contextual ("Acción", "Comando", o colectivamente "Comandos"). Los comandos de barra también pueden ejecutarse con pares clave-valor estructurados proporcionados por el Usuario ("Opciones"). El Bot registra las ejecuciones de Comandos con fines de depuración, específicamente: el nombre de usuario de Discord y el identificador Snowflake ("ID") del Usuario que ejecutó el Comando, el nombre del Comando (incluyendo todas las Opciones) y el ID del Servidor donde se ejecutó el Comando. Estos datos se almacenan en el servidor del Proyecto por hasta 30 días, y solo son accesibles por el Desarrollador.',
      'noPii' => 'Al ejecutar Comandos debes evitar incluir cualquier Información Personal. Parte de la información aún puede retenerse en nuestro Registro de Aplicación, así que por favor contáctanos usando los métodos descritos al final de este documento para notificarnos si se necesita nuestra intervención.',
    ],
    'telemetry' => [
      'heading' => 'Telemetría y estadísticas',
      'statsCollection' => 'Para evaluar el uso del Bot y así impulsar las decisiones de desarrollo (por ejemplo, la adición/eliminación de funciones) se puede recopilar un conjunto específico de datos sobre los Comandos y su uso ("Telemetría"). La información de Telemetría se limita a qué comando y opciones se usaron, y cuándo se usaron, sin ninguna información identificativa (por lo tanto nunca incluye IDs de servidor o usuario, ni valores proporcionados por el usuario, y es completamente anónima). La Telemetría se almacena indefinidamente y las estadísticas derivadas de ella están destinadas a mostrarse y compartirse públicamente de forma agregada.',
      'telemetryOptOut' => 'Al usar el Proyecto, los Usuarios aceptan la recopilación de Telemetría por defecto. Si un Usuario desea excluirse de la recopilación de Telemetría, puede indicar su preferencia a través de la opción apropiada en la página <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Las cookies son archivos con una pequeña cantidad de datos. Las cookies se envían a tu navegador desde un sitio web y se almacenan en el disco duro de tu computadora.',
      'disable' => 'Usamos "cookies" para almacenar información. Puedes configurar tu navegador para rechazar todas las cookies o para que te indique cuándo se envía una cookie. Sin embargo, si no aceptas las cookies, es posible que no puedas utilizar algunas secciones de nuestro sitio.',
      'session' => 'Para los usuarios que han iniciado sesión, se utiliza una cookie persistente para recordar el estado de inicio de sesión entre sesiones del navegador durante 30 días. Si deseas dejar de ser recordado, puedes cerrar sesión o eliminar las cookies establecidas por nuestro sitio.',
    ],
    'security' => [
      'heading' => 'Seguridad',
      'noGuarantee' => 'La seguridad de tu Información Personal es importante para nosotros, pero recuerda que ningún método de transmisión por Internet ni método de almacenamiento electrónico es 100% seguro. Aunque nos esforzamos por usar medios comercialmente aceptables para proteger tu Información Personal, no podemos garantizar su seguridad absoluta.',
      'httpsCloudFlare' => 'El Sitio utiliza HTTPS con suites de cifrado TLS modernas para proteger la integridad y el transporte seguro de los datos entre el navegador y nuestro Sitio. Sin embargo, hacemos uso del servicio de Proxy Reverso de CloudFlare, lo que significa que parte de los datos enviados a nuestro Sitio pasa por sus servidores. CloudFlare opera bajo su propia <1>política de privacidad</1>.',
      'breachNotify' => 'En caso de una brecha de seguridad, todos los usuarios serán notificados dentro de las 24 horas posteriores a su detección mediante un aviso publicado en este sitio web, en respuestas publicadas por el Bot y a través de un anuncio en el servidor de soporte de Discord del Bot.',
    ],
  ],
  'terms' => [
    'heading' => 'Términos y Condiciones',
    'license' => 'Todo el código fuente del Proyecto se proporciona en GitHub tal cual, sin ninguna garantía ni responsabilidad. Para los términos completos de la licencia, consulta la <1>licencia MIT</1>, de la cual se puede encontrar una copia en cada repositorio. Los términos que se detallan a continuación se aplican a la versión del Proyecto alojada por el Desarrollador ("Instancia") y las limitaciones impuestas en ella no deben considerarse como restricciones sobre el uso del código fuente del Proyecto.',
    'noAbuse' => 'No debes configurar automatizaciones para ejecutar Comandos a través de la Instancia de forma repetida. Este Bot no está diseñado para ser utilizado por herramientas automatizadas, como otros bots o cualquier otro software destinado a imitar la actividad legítima de un usuario. En lugar de depender de la salida de nuestro Bot para fines de automatización, consulta la documentación del lenguaje de programación utilizado por tu bot para generar y manipular marcas de tiempo UNIX.',
    'fuckWeb3' => 'Esta Instancia no debe usarse para ayudar en el proceso de entrenamiento de modelos de IA generativa, ni para facilitar cualquier evento y/o transacción relacionada con tokens no fungibles ("NFTs") o cualquier forma de criptomoneda (por ejemplo, Ethereum, Bitcoin).',
    'accessRevocation' => 'Tu acceso a la Instancia puede ser revocado por cualquier motivo (incluido ningún motivo) a discreción del Desarrollador. Las razones pueden incluir, pero no se limitan a: violación de estos términos, uso intencionado indebido de las funciones de la Instancia, amenazas de violencia hacia el Desarrollador o cualquiera de los colaboradores del Proyecto, uso de la Instancia con fines maliciosos.',
  ],
  'changes' => [
    'heading' => 'Cambios y revisiones',
    'effectiveFrom' => 'Los Términos y Condiciones y la Política de Privacidad, colectivamente denominados "Documentos", son efectivos a partir de su última fecha de actualización y permanecerán vigentes, excepto en lo que respecta a cualquier cambio en sus disposiciones en el futuro, los cuales entrarán en vigor inmediatamente después de ser publicados en esta página.',
    'rightToChange' => 'Nos reservamos el derecho de actualizar o cambiar estos Documentos en cualquier momento, y debes revisar esta página periódicamente. El uso continuo del Proyecto después de que publiquemos cualquier modificación de los Documentos en esta página constituirá tu reconocimiento de las modificaciones y tu consentimiento para cumplir y estar sujeto a los Documentos modificados.',
    'willNotify' => 'Si realizamos cambios importantes en estos Documentos, te notificaremos colocando un aviso destacado en nuestro sitio web, así como publicando un anuncio en el servidor de soporte de Discord del Bot.',
  ],
  'contact' => [
    'heading' => 'Contactanos',
    'whereToContact' => 'Si tienes alguna pregunta sobre estos Documentos o deseas solicitar la eliminación de cualquier Información Personal Identificable (PII) que almacenemos, por favor contáctanos a través de <1>el servidor de Discord del Bot</1> o usando cualquiera de los métodos listados en el <3>sitio web del Desarrollador</3>.',
  ],
];
