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
  ],
  'usefulLinks' => [
    'lead' => 'También puede que encuentre útiles:',
    'server' => [
      'header' => 'Servidor Oficial de HammerTime',
      'p' => 'Discuta el sitio web, prueba la sintaxis y sugiera funciones',
    ],
    'bot' => [
      'header' => 'Aplicación HammerTime',
      'p' => 'Genera marcas de tiempo desde Discord usando commandos de barra diagonal',
    ],
    'oldSite' => [
      'header' => 'Sitio web antiguo de HammerTime',
      'p' => 'The old website of the project, still available until further notice',
    ],
    'textColor' => [
      'header' => 'Generador de texto de <1>color</1> de Rebane',
      'p' => 'Una aplicación simple que crea mensajes coloreados de Discord utilizando los códigos de color ANSI',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "La comunidad que organiza retos semanales para un juego de carrera infravalorado que inspiró la creación de este proyecto",
    ],
  ],
];
