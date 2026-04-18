<?php

return [
  'howTo' => 'Elige una fecha, copia la marca de tiempo que desees de la columna :syntaxColName, luego cópiala en un mensaje de chat. El resultado será una marca de tiempo dinámica que se mostrará diferente a cada usuario basado en su zona horaria.',
  'picker' => [
    'label' => [
      'date' => 'Fecha',
      'time' => 'Hora',
      'dateAndTime' => 'Fecha y Hora',
      'timezone' => 'Zona Horaria',
      'naturalLanguageInput' => 'Entrada @time',
      'modeOffset' => 'Diferencia horaria con GMT',
      'modeZoneName' => 'Nombre de la zona',
    ],
    'button' => [
      'jumpToToday' => 'Saltar al mes actual',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Establecer a hora actual',
      'lock' => 'Bloquear la marca de tiempo vía URL',
      'unlock' => 'Desbloquear marca de tiempo',
      'previousYear' => 'El año anterior',
      'previousMonth' => 'El mes anterior',
      'previousDecade' => 'La década anterior',
      'nextMonth' => 'El próximo mes',
      'nextYear' => 'El próximo año',
      'nextDecade' => 'La próxima década',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'No se pudo interpretar la entrada de lenguaje natural'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintaxis de chat',
    'resultColumn' => 'Ejemplo del resultado',
    'editFormats' => 'Personalizar formatos',
    'resetFormats' => 'Restablecer a los valores predeterminados',
    'hideFormat' => 'Ocultar este formato',
    'showFormat' => 'Mostrar este formato',
    'unhideInProfile' => 'Desocultar en los ajustes del perfil',
  ],
  'faq' => [
    'title' => 'Preguntas Frecuentes',
    'description' => 'Por ahora, esta sección solo está disponible en inglés y se basa en gran medida en el contenido de <1>nuestro servidor de Discord</1>. Puede que algunos enlaces no funcionen como deberían si no eres un miembro.',
  ],
  'usefulLinks' => [
    'lead' => 'También puede que encuentre útiles:',
    'server' => [
      'header' => 'Servidor Oficial de HammerTime',
      'p' => 'Discuta el sitio web, prueba la sintaxis y sugiera funciones',
    ],
    'bot' => [
      'header' => 'Aplicación HammerTime',
      'p' => 'Genera marcas de tiempo desde Discord usando comandos de barra diagonal',
    ],
    'oldSite' => [
      'header' => 'Sitio web antiguo de HammerTime',
      'p' => 'El antiguo sitio web del proyecto, todavía disponible hasta próximo aviso',
    ],
    'textColor' => [
      'header' => 'Generador de texto de <1>color</1> de Rebane',
      'p' => 'Una aplicación simple que crea mensajes coloreados de Discord utilizando los códigos de color ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "La comunidad que organiza retos semanales para un juego de carrera infravalorado que inspiró la creación de este proyecto",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => 'r.3v.fi/discord-timestamps',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => 'timestamp.dabric.xyz',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'header' => 'DiscordTimestamp.com',
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'header' => 'DiscordTimestamp.org',
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'header' => 'sesh.fyi/timestamp',
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
