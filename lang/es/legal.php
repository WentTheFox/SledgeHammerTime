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
    'heading' => 'Terms & Conditions',
    'license' => 'All of the Project\'s source code is provided on GitHub as-is, without any warranty or liability. For the full license terms, please see the <1>MIT license</1>, a copy of which can be found in each repository. The terms outlined below apply to the version of the Project hosted by the Developer ("Instance") and the limitations imposed within are not to be treated as  restrictions on the usage of the Project source code.',
    'noAbuse' => 'You must not set up automations to run Commands via the Instance repeatedly. This Bot is not meant to be used by automated tools, such as other bots, or any other software designed to mimic legitimate user activity. Instead of relying on our Bot\'s output for automation purposes, please refer to the documentation of the programming language used by your bot on how to generate and manipulate UNIX timestamps.',
    'fuckWeb3' => 'This Instance shall not be used to aid in the process of training generative AI models, nor to help facilitate any events and/or transactions related to non-fungible tokens ("NFTs") or any form of cryptocurrency (e.g. Ethereum, Bitcoin).',
    'accessRevocation' => 'Your access to the Instance may be revoked for any reason (including no reason) at the Developer\'s discretion. Reasons can include, but are not limited to: violation of these terms, intentional abuse of the Instance\'s features, threats of violence towards the Developer or any of the Project\'s contributors, use of the Instance for malicious purposes.',
  ],
  'changes' => [
    'heading' => 'Changes & Revisions',
    'effectiveFrom' => 'The Terms & Conditions and Privacy Policy, collectively "Documents", are effective as of their last update date and will remain in effect except with respect to any changes in its provisions in the future, which will be in effect immediately after being posted on this page.',
    'rightToChange' => 'We reserve the right to update or change these Documents at any time and you should check this page periodically. Your continued use of the Project after we post any modifications to the Documents on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Documents.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Contact Us',
    'whereToContact' => 'If you have any questions about these Documents or want to ask for the removal of any PII we store please contact us via <1>the Bot\'s Discord server</1> or using any of the methods listed on the <3>Developer\'s website</3>.',
  ],
];
