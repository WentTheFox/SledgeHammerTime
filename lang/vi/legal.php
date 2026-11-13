<?php

return [
  'translations' => [
    'title' => 'Translated Content',
    'text' => 'This project contains translations by volunteer translators and other members of the community. These translations are provided for users\' convenience, and may not always be fully up-to-date. In all matters, the <1>original language version</1> of this page is considered effective.',
  ],
  'lastUpdated' => 'Cập nhật lần cuối: <1/>',
  'privacy' => [
    'heading' => 'Chính sách Quyền Riêng tư',
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
      'heading' => 'Telemetry & Statistics',
      'statsCollection' => 'In order to assess the Bot\'s usage and thereby drive development decisions (e.g. the addition/removal of features) a specific set of data about Commands and their usage may be collected ("Telemetry"). Telemetry information is limited to which command and options were used, and when they were used, without any identifying information (therefore it never includes server or user IDs, nor any user-supplied values, and is fully anonymous). Telemetry is stored indefinitely and statistics derived from it are intended to be displayed and shared publicly in aggregate form.',
      'telemetryOptOut' => 'By using the Project, Users agree to the collection of Telemetry by default. If a User wishes to opt out of Telemetry collection, they may indicate their preference via the appropriate option on the <1/> page.',
    ],
    'cookies' => [
      'heading' => 'Cookies',
      'intro' => 'Cookies are files with small amount of data. Cookies are sent to your browser from a web site and stored on your computer\'s hard drive.',
      'disable' => 'Chúng tôi sử dụng "cookie" để lưu trữ thông tin. Bạn có thể thiết lập trình duyệt của mình để từ chối tất cả các cookie hoặc thông báo khi một cookie được gửi. Tuy nhiên, nếu bạn không chấp nhận cookie, một số nội dung trên trang web của chúng tôi sẽ không sử dụng được.',
      'optOut' => 'If you opt out of performance monitoring, a cookie remembering your choice is stored on your device for the longest time your browser allows, as its expiry is renewed each time you open a page of the Site.',
      'session' => 'Đối với người dùng đã đăng nhập, một cookie cố định sẽ được sử dụng để ghi nhớ trạng thái đăng nhập giữa các phiên trình duyệt trong vòng 30 ngày. Nếu bạn muốn dừng sử dụng tính năng ghi nhớ, bạn có thể đăng xuất hoặc xóa các cookie được tạo bởi trang web của chúng tôi.',
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
      'heading' => 'Bảo mật',
      'noGuarantee' => 'Sự bảo mật thông tin cá nhân của bạn là điều quan trọng đối với chúng tôi, nhưng hãy lưu ý rằng không có phương thức truyền tải thông tin qua Internet hay phương thức lưu trữ số nào là an toàn 100%. Chúng tôi sẽ luôn nỗ lực sử dụng những biện pháp bảo vệ thông tin cá nhân theo tiêu chuẩn thương mại, nhưng chúng tôi không thể đảm bảo an toàn tuyệt đối cho những dữ liệu này.',
      'httpsCloudFlare' => 'The Site makes use of HTTPS using modern TLS encryption suites to protect the integrity and secure transport of data between the browser and our Site. However, we make use of CloudFlare\'s Reverse Proxy service, meaning some portion of the data sent to our Site passes through their servers. CloudFlare operates under their own <1>privacy policy</1>.',
      'breachNotify' => 'In the event of a security breach all users will be notified within 24 hours of discovery through a notice posted on this website, in replies posted by the Bot and via an announcement in the Bot\'s Discord support server.',
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
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, which is shown for up to two weeks after the update (unless you dismiss it earlier), as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Contact Us',
    'whereToContact' => 'If you have any questions about these Documents or want to ask for the removal of any PII we store please contact us via <1>the Bot\'s Discord server</1> or using any of the methods listed on the <3>Developer\'s website</3>.',
  ],
];
