<?php

return [
  'translations' => [
    'title' => 'Translated Content',
    'text' => 'This project contains translations by volunteer translators and other members of the community. These translations are provided for users\' convenience, and may not always be fully up-to-date. In all matters, the <1>original language version</1> of this page is considered effective.',
  ],
  'lastUpdated' => 'Last updated: <1/>',
  'privacy' => [
    'heading' => 'Gizlilik Politikası',
    'operator' => '<0/> ("us", "we", "our", or "Developer") operates the HammerTime website (the "Site"), and HammerTimeBot (the "Bot", or "App"), collectively the HammerTime Project (the "Project"). This page informs you of our policies regarding the collection, use and disclosure of Personal Information we receive from users of the Project ("you", "User", or collectively "Users").',
    'notAffiliated' => 'Although the "HammerTime" name ("Project Name") is derived from the former name "Hammer & Chisel" of Discord, Inc. ("Discord")<1/> the Project is not affiliated in any way, shape, or form, with Discord, nor M.C. Hammer, whose song<3/> features this phrase prominently. The Developer holds no trademark or copyright over the Project Name.',
    'infoCollection' => [
      'heading' => 'Information Collection And Use',
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
      'disable' => 'Bilgileri saklamak için "çerezler" kullanıyoruz. Tarayıcınıza tüm çerezleri reddetmesi veya bir çerez gönderildiğinde bunu belirtmesi talimatını verebilirsiniz. Ancak, çerezleri kabul etmezseniz, sitemizin bazı bölümlerini kullanamayabilirsiniz.',
      'session' => 'Oturum açan kullanıcılar için, oturum durumunu tarayıcı oturumları arasında 30 gün boyunca hatırlamak için kalıcı bir çerez kullanılır. Hatırlanmayı durdurmak istiyorsanız, çıkış yapabilir veya sitemiz tarafından ayarlanan çerezleri temizleyebilirsiniz.',
    ],
    'security' => [
      'heading' => 'Güvenlik',
      'noGuarantee' => 'Kişisel Bilgilerinizin güvenliği bizim için önemlidir, ancak internet üzerinden veri aktarımının veya elektronik depolamanın hiçbir yolunun %100 güvenli olmadığını unutmayın. Kişisel Bilgilerinizi korumak için ticari olarak kabul edilebilir araçlar kullanmak için çaba göstersek de, mutlak güvenliğini garanti edemeyiz.',
      'httpsCloudFlare' => 'Site, tarayıcı ile Sitemiz arasında verilerin bütünlüğünü korumak ve güvenli bir şekilde taşınmasını sağlamak için modern TLS şifrelemesini içeren HTTPS\'den yararlanmaktadır. Bununla birlikte, CloudFlare\'ın Reverse Proxy hizmetinden yararlanıyoruz, yani Sitemize gönderilen verilerin bir kısmı onların sunucularından geçiyor. CloudFlare kendi <1>gizlilik politikası</1> altında çalışır.',
      'breachNotify' => 'Bir güvenlik ihlali durumunda tüm kullanıcılar keşfedildikten sonraki 24 saat içinde bu web sitesinde yayınlanan bir bildirim, Bot tarafından gönderilen yanıtlar ve Bot\'un Discord destek sunucusundaki bir duyuru yoluyla bilgilendirilecektir.',
    ],
  ],
  'terms' => [
    'heading' => 'Şartlar & Koşullar',
    'license' => 'Projenin tüm kaynak kodu GitHub\'da herhangi bir garanti veya yükümlülük olmaksızın olduğu gibi sağlanmaktadır. Lisans koşullarının tamamı için lütfen bir kopyasını her repository\'de bulabileceğiniz <1>MIT lisans</1>ına bakın. Aşağıda özetlenen koşullar, Geliştirici tarafından barındırılan Proje sürümü ("Örnek") için geçerlidir ve burada getirilen sınırlamalar, Proje kaynak kodunun kullanımına ilişkin kısıtlamalar olarak değerlendirilmemelidir.',
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
