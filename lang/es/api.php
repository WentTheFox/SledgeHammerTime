<?php

return [
  'heading' => 'Acceso API',
  'description' => 'Genera marcas de tiempo y modifica la configuración de tu aplicación desde tus propios programas. Cada punto de acceso se corresponde con un comando de la aplicación, y las solicitudes se ajustan a la configuración de la cuenta de Discord para la que se creó la clave.',
  'overview' => [
    'baseUrl' => 'URL base',
    'reference' => 'Referencia interactiva',
    'spec' => 'Especificación OpenAPI',
  ],
  'keys' => [
    'loginPrompt' => 'Inicia sesión para crear claves API. Estas claves funcionan como una de las cuentas de Discord vinculadas a tu perfil.',
  ],
  'usage' => [
    'heading' => 'Uso de la API',
    'authentication' => 'Envíe su clave como token de portador en el encabezado «Authorization» de cada solicitud.',
    'example' => 'Esto devuelve la marca de tiempo correspondiente a las 18:30 de hoy en su zona horaria guardada. La clave que aparece en los ejemplos es ficticia; utilice la suya propia:',
    'limits' => 'Las solicitudes están sujetas a un límite de frecuencia por clave. Los encabezados «RateLimit» de cada respuesta le indican cuál es su situación actual, y una respuesta 429 incluye un encabezado «Retry-After».',
    'statistics' => 'Las ejecuciones se contabilizan como comandos de la aplicación, y la respuesta indica de qué ejecución se trata, a menos que haya desactivado la telemetría en la configuración de la aplicación.',
  ],
  'permissions' => [
    'heading' => 'Permisos',
    'description' => 'Una clave tiene los permisos con los que fue creada, y el resto de esta página se refiere a ellos por estos códigos.',
    'me' => 'Cada clave puede llamar a <1/>, independientemente de sus permisos, para averiguar cuáles tiene.',
    'columns' => [
      'permission' => 'Permiso',
      'allows' => 'Permite',
    ],
    'scopes' => [
      'timestamps:create' => 'Generar marcas de tiempo con los puntos de conexión de marcas de tiempo y herramientas MCP, actuando como la cuenta de Discord que representa la clave.',
      'settings:read' => 'Leer la configuración de la aplicación de esa cuenta.',
      'settings:write' => 'Cambiar la configuración de la aplicación de esa cuenta, únicamente los campos que se envíen.',
    ],
  ],
  'reference' => [
    'heading' => 'Referencia de puntos de conexión',
    'description' => 'Cada punto de conexión con los campos que recibe y las respuestas que devuelve. Esto se lee desde la especificación OpenAPI del servidor de la API, por lo que siempre coincide con la versión que se está ejecutando.',
    'errors' => 'Errores',
    'errorsDescription' => 'Todas las respuestas de error incluyen este cuerpo. El código de estado indica de qué tipo de error se trata, y «error.code» especifica el motivo exacto.',
    'optional' => 'opcional',
    'unavailable' => 'No ha sido posible cargar la referencia en este momento. La referencia interactiva contiene la misma información.',
    'permission' => 'Permisos',
    'anyKey' => 'Cualquier clave válida',
    'noKey' => 'No se requiere clave',
    'requestBody' => 'Cuerpo de la solicitud (JSON)',
    'responses' => 'Respuestas',
    'nullable' => 'Can be null',
  ],
  'mcp' => [
    'heading' => 'Uso del servidor MCP',
    'description' => 'El servidor MCP utiliza el protocolo de transporte HTTP «Streamable» y las mismas claves. Ofrece una herramienta por comando, además de opciones de configuración, y únicamente aquellas herramientas que permitan los permisos de tu clave.',
    'url' => 'URL del servidor',
    'placeholderKey' => 'La clave que aparece en los ejemplos siguientes es ficticia; no funcionará. Sustitúyala por una de sus propias claves.',
    'claudeCode' => 'Añádelo a Claude Code con:',
    'otherClients' => 'Otros clientes utilizan una configuración similar, con la URL y un encabezado «Authorization»:',
  ],
];
