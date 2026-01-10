<?php

return [
  'translations' => [
    'title' => 'Kandungan Terjemahan',
    'text' => 'Projek ini mengandungi terjemahan oleh penterjemah sukarela dan ahli komuniti yang lainnya. Terjemahan ini disediakan untuk kemudahan pengguna, dan tidak semestinya dikemaskini sepenuhnya. Dalam segala urusan, <1>versi bahasa asal</1> halaman ini yang dikira dikuatkuasakan.',
  ],
  'lastUpdated' => 'Kemas kini terakhir: <1/>',
  'privacy' => [
    'heading' => 'Polisi Privasi',
    'operator' => '<0/> ("kami", atau "Pembangun") mengendalikan laman sesawang HammerTime ("Laman"), dan HammerTimeBot ("Bot", atau "Apl"), bersama-sama dipanggil Projek HammerTime ("Projek"). Halaman ini memberitahu anda polisi kami mengenai pengumpulan, penggunaan dan pendedahan Maklumat Peribadi yang kami terima daripada para pengguna Projek ini ("anda", "Pengguna", atau bersama-sama dipanggil "Para Pengguna").',
    'notAffiliated' => 'Walaupun nama "HammerTime" ("Nama Projek") diterbitkan daripada nama lama Discord, Inc. ("Discord") iaitu "Hammer & Chisel",<1/> Projek ini tidak mempunyai kaitan dalam sebarang cara, rupa, atau bentuk, dengan Discord, mahupun M.C. Hammer, yang mana lagunya<3/> menampilkan frasa ini dengan ulungnya. Pembangun tidak memegang tanda dagang atau hak cipta ke atas Nama Projek.',
    'infoCollection' => [
      'heading' => 'Pengumpulan dan Penggunaan Maklumat',
      'pii' => 'Ketika anda menggunakan Projek ini, kami tidak meminta mahupun menggalakkan anda untuk memberikan kami sebarang Maklumat Pengenalan Peribadi ("PII", "Maklumat Peribadi") yang boleh digunakan untuk mengenal pasti diri anda sebagai seorang individu. PII boleh termasuk, tetapi tidak terhad kepada: nama anda, tarikh lahir, nombor pengenalan kebangsaan, lokasi, nombor telefon.',
      'auth' => 'Log masuk disediakan menggunakan API OAuth 2 Discord ("API") yang disulitkan menggunakan HTTPS juga. Ketika proses pengesahan OAuth, Laman kami tidak menerima nama pengguna mahupun kata laluan, sebaliknya hanya suatu token yang boleh digunakan untuk mengesah betul identiti pengguna menggunakan API ini. Untuk tujuan prestasi kami menyimpan maklumat asas yang disediakan oleh API tersebut (ID pengguna, nama pengguna semasa, nama paparan, pautan avatar) secara tempatan.',
      'removal' => 'Maklumat ini tidak dikeluarkan daripada pangkalan data kami secara automatiknya sekiranya anda menyahaktifkan akaun Discord anda, jadi sila pastikan anda menghubungi kami sekiranya anda ingin data anda dikeluarkan.',
    ],
    'logData' => [
      'heading' => 'Data Log',
      'browserInfo' => 'Kami mengumpulkan maklumat yang pelayar anda hantar setiap kali anda melawati Laman kami ("Data Log"). Data Log ini boleh termasuk maklumat seperti alamat IP komputer anda, sistem pengoperasian, jenis pelayar, versi pelayar, halaman di Laman kami yang anda lawati, masa dan tarikh lawatan anda.',
      'thirdParty' => 'Data Log ini hanya disimpan di pelayan kami dan tidak dikongsikan dengan mana-mana pihak ketiga. Data Log digunakan untuk tujuan diagnostik, dan dikongsikan dengan agensi penguatkuasaan undang-undang sekiranya diminta secara eksplisit. Maklumat ini disimpan sehingga 14 hari dan dibuang selepas itu.',
      'debugging' => 'Bot boleh menerima interaksi daripada Para Pengguna melalui klien Discord, yang merangkumi perintah tanda miring dan perintah menu konteks ("Tindakan", "Perintah", atau bersama-sama dipanggil "Para Perintah"). Perintah tanda miring juga boleh dijalankan dengan pasangan kekunci-nilai berstruktur yang disediakan oleh Pengguna ("Pilihan"). Bot merekodkan penjalanan Perintah untuk tujuan nyahpepijat, yakni: nama pengguna Discord dan pengenal pasti Snowflake ("ID") bagi Pengguna yang menjalankan Perintah tersebut, nama Perintah berkenaan (termasuk kesemua Pilihan) dan juga ID bagi Pelayan di mana Perintah tersebut dijalankan. Data ini disimpan di pelayan Projek sehingga 30 hari, dan hanya boleh dicapai oleh Pembangun.',
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
      'disable' => 'We use "cookies" to retain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Site.',
      'session' => 'For logged in users a persistent cookie is used to remember the logged in status across browser sessions for 30 days. If you want to stop being remembered you can either sign out or clear the cookies set by our Site.',
    ],
    'security' => [
      'heading' => 'Security',
      'noGuarantee' => 'The security of your Personal Information is important to us, but remember that no method of transmission over the Internet, or method of electronic storage, is 100% secure. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security.',
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
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Contact Us',
    'whereToContact' => 'If you have any questions about these Documents or want to ask for the removal of any PII we store please contact us via <1>the Bot\'s Discord server</1> or using any of the methods listed on the <3>Developer\'s website</3>.',
  ],
];
