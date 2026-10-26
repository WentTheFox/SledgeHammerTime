<?php

return [
  'heading' => 'API Access',
  'description' => 'Generate timestamps and change your app settings from your own programs. Every endpoint matches an app command, and requests follow the settings of the Discord account the key was created for.',
  'overview' => [
    'baseUrl' => 'Базовый URL',
    'reference' => 'Интерактивный справочник',
    'spec' => 'Спецификация OpenAPI',
  ],
  'keys' => [
    'loginPrompt' => 'Войдите в систему, чтобы создать ключи API. Эти ключи выступают в качестве одной из учетных записей Discord, привязанных к вашему профилю.',
  ],
  'usage' => [
    'heading' => 'Использование API',
    'authentication' => 'Send your key as a bearer token in the Authorization header of every request.',
    'example' => 'Эта команда возвращает временную метку, соответствующую 18:30 сегодняшнего дня в вашем сохраненном часовом поясе. Ключ в примерах является вымышленным, используйте свой собственный:',
    'limits' => 'Requests are rate limited per key. The RateLimit headers of every response tell you where you stand, and a 429 response comes with a Retry-After header.',
    'statistics' => 'Запуски учитываются так же, как команды приложения, и в ответе указывается, какой именно запуск имел место, если только вы не отключили телеметрию в настройках приложения.',
  ],
  'permissions' => [
    'heading' => 'Права доступа',
    'description' => 'Ключ обладает правами доступа, с которыми он был создан, и далее на этой странице они обозначаются соответствующими кодами.',
    'me' => 'Любой ключ может вызвать функцию <1/>, независимо от своих прав доступа, чтобы узнать, какими правами он обладает.',
    'columns' => [
      'permission' => 'Права',
      'allows' => 'Позволяет',
    ],
    'scopes' => [
      'timestamps:create' => 'Генерация временных меток с помощью конечных точек timestamp и инструментов MCP, при этом ключ выступает в качестве учетной записи Discord.',
      'settings:read' => 'Считывание настроек приложения для данной учетной записи.',
      'settings:write' => 'Изменение настроек приложения для этой учетной записи, только поля, которые будут отправлены.',
    ],
  ],
  'reference' => [
    'heading' => 'Endpoint reference',
    'description' => 'Every endpoint with the fields it takes and the responses it gives. This is read from the OpenAPI specification of the API server, so it always matches the version that is running.',
    'errors' => 'Errors',
    'errorsDescription' => 'Every error response has this body. The status code tells what kind of error it is, and error.code the exact reason.',
    'optional' => 'опционально',
    'unavailable' => 'В данный момент не удалось загрузить справочник. В интерактивном справочнике содержится та же информация.',
    'permission' => 'Права',
    'anyKey' => 'Любой действительный ключ',
    'noKey' => 'Ключ не требуется',
    'requestBody' => 'Тело запроса (JSON)',
    'responses' => 'Ответы',
    'nullable' => 'Can be null',
  ],
  'mcp' => [
    'heading' => 'Использование MCP сервера',
    'description' => 'Сервер MCP использует HTTP-транспорт Streamable и те же ключи. Он предоставляет по одному инструменту на каждую команду, а также настройки, причём доступны только те инструменты, которые разрешены правами вашего ключа.',
    'url' => 'URL сервера',
    'placeholderKey' => 'Ключ, приведённый в примерах ниже, является вымышленным и не будет работать. Замените его одним из ваших собственных ключей.',
    'claudeCode' => 'Добавьте это в Claude Code следующим образом:',
    'otherClients' => 'Другие клиенты используют аналогичную конфигурацию, включая URL-адрес и заголовок «Authorization»:',
  ],
];
