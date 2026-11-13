<?php

return [
  'translations' => [
    'title' => 'Переведенный контент',
    'text' => 'Этот проект содержит переводы, выполненные переводчиками добровольцами и другими участниками сообщества. Эти переводы предоставляются для удобства пользователей и не всегда могут быть полностью актуальными. Во всех случаях эффективной считается версия этой страницы на <1>оригинальном языке</1>.',
  ],
  'lastUpdated' => 'Последнее изменение: <1/>',
  'privacy' => [
    'heading' => 'Политика конфиденциальности',
    'operator' => '<0/> ("мы", "наш" или "Разработчик") управляет веб-сайтом HammerTime ("Сайт") и ботом HammerTimeBot ("Бот" или "Приложение"), в совокупности являющимися проектом HammerTime ("Проект"). Эта страница информирует Вас о нашей политике в отношении сбора, использования и раскрытия Личной информации, которую мы получаем от пользователей Проекта ("Вы", "Пользователь" или все вместе "Пользователи").',
    'notAffiliated' => 'Хотя название "HammerTime" ("Название проекта") происходит от прежнего названия "Hammer & Chisel" принадлежащей компании Discord, Inc. ("Discord")<1/>, проект не связан каким-либо образом, формой или формой ни с Discord, ни с M.C. Hammer, в чьей песне<3/> эта фраза занимает видное место. Разработчик не владеет торговыми марками или авторскими правами на Название проекта.',
    'infoCollection' => [
      'heading' => 'Сбор и использование информации',
      'pii' => 'При использовании проекта вами, мы не запрашиваем передачу любых личных данных пользователя ("ЛДП"), которые могут быть использованы для установления его личности. Такие ЛДП включают в себя: ваше имя, дату рождения, номер документов, удостоверяющих личность, местоположения, номер телефона.',
      'auth' => 'Вход осуществляется через API Discord OAuth 2 («API»), который также защищён протоколом HTTPS. В процессе аутентификации OAuth наш сайт не получает имя пользователя и пароль, а только токен, который можно использовать для подтверждения личности пользователя с помощью этого API. Для повышения производительности мы храним основную информацию, предоставляемую API (идентификатор пользователя, текущее имя пользователя, отображаемое имя, ссылку на аватар), локально.',
      'removal' => 'Эта информация не удаляется с наших серверов автоматически, когда вы отключаете вашу учетную запись Discord. Если вы желаете удалить их, обратитесь к нам.',
    ],
    'logData' => [
      'heading' => 'Логирование Данных',
      'browserInfo' => 'Мы собираем информацию, которую ваш браузер отправляет при каждом посещении вами нашего сайта("Лог Даты"). Эти данные могут включать ваш IP Адрес, операционную систему, тип браузера, версия браузера, страницы нашего сайта, которые вы посещаете, время и дата захода на сайт',
      'thirdParty' => 'Данные журнала хранятся только на нашем сервере и не передаются третьим лицам. Данные журнала используются для диагностики и могут быть переданы правоохранительным органам по запросу. Они хранятся до 14 дней, после чего удаляются.',
      'debugging' => 'Бот может принимать взаимодействия от пользователей через клиент Discord, которые включают в себя слэш-команды и команды контекстного меню ("Действие", "Команда", или в совокупности "Команды"). Слэш-команды могут быть дополнительно выполнены с помощью предоставленных пользователем структурированных пар ключ-значений ("Опции"). Бот записывает выполнение команд в целях отладки, а именно: имя пользователя Discord и идентификатор Snowflake ("ID") пользователя, выполнившего команду, название команды (включая все опции) и ID сервера, на котором была выполнена команда. Эти данные хранятся на сервере проекта до 30 дней и доступны только Разработчику.',
      'noPii' => 'При выполнении команд следует избегать предоставления каких-либо персональных данных. Некоторая информация может сохраняться в нашем журнале заявок, поэтому, если потребуется наше вмешательство, свяжитесь с нами способами, описанными в конце этого документа. ',
    ],
    'performance' => [
      'heading' => 'Performance Monitoring',
      'intro' => 'To find errors and slow pages we record performance traces: short records of how a request to the Site was handled.',
      'serverTraces' => 'A trace of a request to the Site contains the address of the page requested (including its query string), the browser type (user agent), timings, the structure of the database queries involved (which can include identifiers of records) and whether the request was made by a logged in user (but not which one). The values of query parameters that look like credentials (such as codes, tokens and keys) are replaced before storage, and IP addresses are not included in traces.',
      'legalBasis' => 'We do this based on our legitimate interest in keeping the Site working and fast (<1>GDPR Article 6(1)(f)</1>).',
      'reporting' => 'When a request fails, the reference (trace ID) of its trace is shown in a message, so that you can include it when reporting the problem.',
      'retention' => 'Traces are kept for 14 days and then discarded automatically. They are stored only on our own server, can only be read by the Developer and are not shared with any third party. As individual traces cannot be deleted before they expire, a request to remove them is fulfilled by their expiry.',
    ],
    'optOut' => [
      'heading' => 'Opt Out of Performance Monitoring',
      'intro' => 'You can opt out of performance monitoring at any time using the form below. While you are opted out, no performance traces of your visits are recorded on our server.',
      'cookie' => 'Your choice is remembered in a cookie on your device. Its expiry is renewed each time you open a page of the Site while you are opted out, and clearing your cookies removes your choice.',
      'cookieLongest' => 'The cookie stays on this device for the longest time your browser allows.',
      'cookieExpiry' => 'The cookie stays on this device for the longest time your browser allows, which currently means it expires <1/>.',
      'label' => 'Do not record performance traces of my visits',
      'statusOptedOut' => 'You are currently opted out on this device.',
      'statusNotOptedOut' => 'You are currently not opted out on this device.',
      'saved' => 'Your choice was saved.',
    ],
    'telemetry' => [
      'heading' => 'Телеметрия и статистика',
      'statsCollection' => 'Для оценки бота и принятия решений о разработке(к примеру, добавление/удаление функций) может собираться определенные данные о командах и их использовании ("Телеметрия"). Телеметрическая информация ограничивается указанием использованных команд и параметров, а также временем их использования, без какой-либо идентифицирующей информации (поэтому она не включает идентификаторы сервера или пользователя, а также любые введенные пользователем значения и является полностью анонимной). Телеметрия хранится неограниченный срок, и полученная статистика предназначена для отображения и публичного распространения в обобщенном виде.',
      'telemetryOptOut' => 'Используя Проект, пользователь автоматически соглашаются на сбор телеметрических данных. Если пользователь хочет отказаться, он может поделиться своим мнением выбрав соответствующую опцию на <1/> странице',
    ],
    'cookies' => [
      'heading' => 'Файлы Cookies',
      'intro' => 'Cookies - это файлы с небольшим количеством данных. Cookies отправляются в Ваш браузер с веб-сайта и хранятся исключительно на жестком диске Вашего компьютера.',
      'disable' => 'Мы используем "cookies" для сохранения информации. Вы можете настроить свой браузер так, чтобы он отказывался от всех "куки" или указывал, когда отправляются "куки". Однако, если Вы не принимаете "cookies", Вы не сможете пользоваться некоторыми разделами нашего Сайта.',
      'optOut' => 'If you opt out of performance monitoring, a cookie remembering your choice is stored on your device for the longest time your browser allows, as its expiry is renewed each time you open a page of the Site.',
      'session' => 'Для пользователей, вошедших в систему, используется постоянный файл cookie, который запоминает статус входа в систему в течение 30 дней в разных сеансах работы браузера. Если Вы хотите, чтобы о Вас перестали помнить, Вы можете выйти из системы или очистить файлы cookie, установленные нашим Сайтом.',
    ],
    'rights' => [
      'heading' => 'Your Rights',
      'intro' => 'You have the right to ask us for a copy of the personal data we hold about you, to have it corrected or erased, to restrict its processing and to receive it in a portable format. To use these rights, contact us using the methods described at the end of this document.',
      'complaint' => 'You also have the right to lodge a complaint with a data protection supervisory authority, for example in the country where you live or work. The <1>European Data Protection Board</1> lists the authorities of the EU member states.',
    ],
    'objection' => [
      'heading' => 'Right to Object',
      'text' => 'Where we process your personal data based on our legitimate interests, which includes performance monitoring, you have the right to object at any time on grounds relating to your particular situation. You can do so by opting out of performance monitoring (see above), or by contacting us.',
    ],
    'security' => [
      'heading' => 'Безопасность',
      'noGuarantee' => 'Для нас важна безопасность вашей Личной информации, но помните, что ни один метод передачи информации через Интернет или метод электронного хранения, не является на 100% безопасным. В то время как мы стремимся использовать коммерчески приемлемые средства для защиты вашей личной информации, мы не можем гарантировать ее абсолютную безопасность.',
      'httpsCloudFlare' => 'Сайт использует HTTPS с современными пакетами шифрования TLS для защиты целостности и безопасной передачи данных между браузером и нашим Сайтом. Однако мы используем службу обратного прокси CloudFlare, это означанет, что некоторая часть данных, отправляемых на наш Сайт, проходит через их серверы. CloudFlare работает в соответствии со своей собственной <1>политикой конфиденциальности</1>.',
      'breachNotify' => 'В случае нарушения безопасности все пользователи будут уведомлены в течение следующих 24 часов с момента обнаружения через уведомление, размещенное на этом сайте, в ответах, опубликованных Ботом, и через объявление на сервере поддержки Бота Discord.',
    ],
  ],
  'terms' => [
    'heading' => 'Условия использования',
    'license' => 'Весь исходный код проекта предоставляется на GitHub как есть, без каких-либо гарантий и обязательств. Полные условия лицензии приведены в <1>лицензии MIT</1>, копию которой можно найти в каждом репозитории. Условия, изложенные ниже, относятся к версии Проекта, размещенной Разработчиком ("Instance"), и ограничения, наложенные в ней, не должны рассматриваться как ограничения на использование исходного кода Проекта.',
    'noAbuse' => 'Вы не должны настраивать автоматизацию для многократного выполнения команд через Инстанс. Этот Бот не предназначен для использования автоматизированными инструментами, такими как другие боты или любое другое программное обеспечение, предназначенное для имитации законной деятельности пользователя. Вместо того, чтобы полагаться на результаты работы нашего Бота для целей автоматизации, пожалуйста, обратитесь к документации языка программирования, используемого Вашим ботом, чтобы узнать, как генерировать и манипулировать временными метками UNIX.',
    'fuckWeb3' => 'Этот Экземпляр не должен использоваться для помощи в процессе обучения генеративных моделей ИИ, а также для содействия любым событиям и/или транзакциям, связанным с несгораемыми токенами ("NFT") или любой формой криптовалюты (например, Ethereum, Bitcoin).',
    'accessRevocation' => 'Ваш доступ к Инстансу может быть аннулирован по любой причине (в том числе и без причины) по усмотрению Разработчика. Причины могут включать, но не ограничиваться: нарушение данных условий, намеренное злоупотребление возможностями Инстанса, угрозы насилия в адрес Разработчика или любого из участников проекта, использование Инстанса в злонамеренных целях.',
  ],
  'changes' => [
    'heading' => 'Изменения и пересмотры',
    'effectiveFrom' => 'Положения и условия и Политика конфиденциальности, вместе взятые "Документы", вступают в силу с даты их последнего обновления и остаются в силе, за исключением любых изменений в их положениях в будущем, которые вступят в силу сразу после размещения на этой странице.',
    'rightToChange' => 'Мы оставляем за собой право обновлять или изменять эти Документы в любое время, и Вам следует периодически проверять эту страницу. Ваше дальнейшее использование Проекта после того, как мы опубликуем любые изменения в Документах на этой странице, будет означать Ваше согласие с изменениями и Ваше согласие соблюдать и быть связанным измененными Документами.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, which is shown for up to two weeks after the update (unless you dismiss it earlier), as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Свяжитесь с нами',
    'whereToContact' => 'Если у Вас возникли вопросы по поводу этих Документов или Вы хотите попросить удалить хранящиеся у нас PII, пожалуйста, свяжитесь с нами через <1>сервер Discord</1> или используя любой из способов, перечисленных на <3>сайте разработчика</3>.',
  ],
];
