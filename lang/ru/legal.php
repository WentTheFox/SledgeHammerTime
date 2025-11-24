<?php

return [
  'translations' => [
    'title' => 'Translated Content',
    'text' => 'Этот проект содержит переводы, выполненные переводчиками-добровольцами и другими членами сообщества. Эти переводы предоставляются для удобства пользователей и не всегда могут быть полностью актуальными. Во всех случаях эффективной считается <1>версия</1> этой страницы на <1>оригинальном языке</1>.',
  ],
  'lastUpdated' => 'Последнее изменение: <1/>',
  'privacy' => [
    'heading' => 'Политика конфиденциальности',
    'operator' => '<0/> ("us", "we", "our", or "Developer") operates the HammerTime website (the "Site"), and HammerTimeBot (the "Bot", or "App"), collectively the HammerTime Project (the "Project"). This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Project ("you", "User", or collectively "Users").',
    'notAffiliated' => 'Although the "HammerTime" name ("Project Name") is derived from the former name "Hammer & Chisel" of Discord, Inc. ("Discord")<1/> the Project is not affiliated in any way, shape, or form, with Discord, nor M.C. Hammer, whose song<3/> features this phrase prominently. The Developer holds no trademark or copyright over the Project Name.',
    'infoCollection' => [
      'heading' => 'Сбор и использование информации',
      'pii' => 'While using the Project we do not ask nor encourage you to provide us with any Personally Identifiable Information ("PII", "Personal Information") that can be used to identify you as an individual. PII may include, but is not limited to: your name, birth date, national identification numbers, location, phone number.',
      'auth' => 'Sign in is provided using Discord\'s OAuth 2 API ("API") which is also secured using HTTPS. During the OAuth authentication process our Site does not receive the username or password, only a token that can be used to verify the user\'s identity using this API. For performance reasons we store the basic information provided by the API (user ID, current username, display name, avatar link) locally.',
      'removal' => 'This information is not removed from our database automatically if you deactivate your Discord account, so be sure to reach out to us if you would like your data removed.',
    ],
    'logData' => [
      'heading' => 'Log Data',
      'browserInfo' => 'We collect information that your browser sends whenever you visit our Site ("Log Data"). This Log Data may include information such as your computer\'s IP address, operating system, browser type, browser version, the pages of our Site that you visit, the time and date of your visit.',
      'thirdParty' => 'This Log Data is stored only within our server and is not shared with any third party. Log Data is used for diagnostic purposes, and shared with law enforcement agencies if explicitly requested. It is kept for up to 14 days and discarded afterwards.',
      'debugging' => 'The Bot can receive interactions from Users via the Discord client, which includes slash commands and context menu commands ("Action", "Command", or collectively "Commands"). Slash commands can additionally be executed with User-supplied structured key-value pairs ("Options"). The Bot records Command executions for debugging purposes, namely: the Discord username and Snowflake identifier ("ID") of the User that executed the Command, the name of the Command (including all Options) and the ID of the Server the Command was executed in. This data is stored on the Project server for up to 30 days, and is only accessible by the Developer.',
      'noPii' => 'When executing Commands you should avoid including any Personal Information. Some information may still be retained in our Application Log, so please contact us using the methods described at the end of this document to notify us if our intervention is needed.',
    ],
    'telemetry' => [
      'heading' => 'Telemetry & Statistics',
      'statsCollection' => 'In order to assess the Bot\'s usage and thereby drive development decisions (e.g. the addition/removal of features) a specific set of data about Commands and their usage may be collected ("Telemetry"). Telemetry information is limited to which command and options were used, and when they were used, without any identifying information (therefore it never includes server or user IDs, nor any user-supplied values, and is fully anonymous). Telemetry is stored indefinitely and statistics derived from it are intended to be displayed and shared publicly in aggregate form.',
      'telemetryOptOut' => 'By using the Project, Users agree to the collection of Telemetry by default. If a User wishes to opt out of Telemetry collection, they may indicate their preference via the appropriate option on the <1/> page.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies are files with small amount of data. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.',
      'disable' => 'Мы используем "cookies" для сохранения информации. Вы можете настроить свой браузер так, чтобы он отказывался от всех "куки" или указывал, когда отправляются "куки". Однако, если Вы не принимаете "cookies", Вы не сможете пользоваться некоторыми разделами нашего Сайта.',
      'session' => 'Для пользователей, вошедших в систему, используется постоянный файл cookie, который запоминает статус входа в систему в течение 30 дней в разных сеансах работы браузера. Если Вы хотите, чтобы о Вас перестали помнить, Вы можете выйти из системы или очистить файлы cookie, установленные нашим Сайтом.',
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
    'willNotify' => 'Если мы внесем какие-либо существенные изменения в эти Документы, мы уведомим Вас об этом, разместив уведомление на нашем сайте, а также опубликуем объявление на сервере поддержки Бота Discord.',
  ],
  'contact' => [
    'heading' => 'Свяжитесь с нами',
    'whereToContact' => 'Если у Вас возникли вопросы по поводу этих Документов или Вы хотите попросить удалить хранящиеся у нас PII, пожалуйста, свяжитесь с нами через <1>сервер Discord</1> или используя любой из способов, перечисленных на <3>сайте разработчика</3>.',
  ],
];
