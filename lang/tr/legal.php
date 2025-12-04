<?php

return [
  'translations' => [
    'title' => 'Çevrilmiş İçerik',
    'text' => 'Bu proje, gönüllü çevirmenler ve topluluğun diğer üyeleri tarafından yapılan çevirileri içerir. Bu çeviriler kullanıcılara kolaylık olması amacıyla sunulmaktadır ve her zaman tamamen güncel olmayabilir. Her türlü durumda, bu sayfanın <1>orijinal dil sürümü</1> esas alınır.',
  ],
  'lastUpdated' => 'Son güncelleme: <1/>',
  'privacy' => [
    'heading' => 'Gizlilik Politikası',
    'operator' => '<0/> ("biz", "bizim" veya "Geliştirici"); topluca HammerTime Projesi ("Proje") olarak anılan HammerTime web sitesini ("Site") ve HammerTimeBot\'u ("Bot" veya "Uygulama") işletmektedir. Bu sayfa, Proje kullanıcılarından ("siz", "Kullanıcı" veya topluca "Kullanıcılar") aldığımız Kişisel Bilgilerin toplanması, kullanımı ve ifşasına ilişkin politikalarımız hakkında sizi bilgilendirir.',
    'notAffiliated' => '"HammerTime" adı ("Proje Adı"), Discord, Inc.\'in ("Discord") eski adı olan "Hammer & Chisel"dan türetilmiş olsa da<1/>; Proje\'nin Discord veya şarkısında<3/> bu ifadenin belirgin bir şekilde geçtiği M.C. Hammer ile hiçbir şekilde bağlantısı yoktur. Geliştirici, Proje Adı üzerinde herhangi bir ticari marka veya telif hakkına sahip değildir.',
    'infoCollection' => [
      'heading' => 'Bilgi Toplama ve Kullanma',
      'pii' => 'Projeyi kullanırken; sizi bir birey olarak tanımlamak için kullanılabilecek herhangi bir Kişisel Olarak Tanımlanabilir Bilgiyi ("PII", "Kişisel Bilgiler") bize sağlamanızı talep etmiyor ve sizi bu konuda teşvik etmiyoruz. Kişisel Bilgiler; adınızı, doğum tarihinizi, ulusal kimlik numaralarınızı, konumunuzu ve telefon numaranızı içerebilir ancak bunlarla sınırlı değildir.',
      'auth' => 'Oturum açma işlemi, güvenliği aynı zamanda HTTPS ile sağlanan Discord\'un OAuth 2 API\'si ("API") kullanılarak gerçekleştirilir. OAuth kimlik doğrulama süreci sırasında Sitemiz kullanıcı adını veya şifreyi almaz; bunun yerine yalnızca bu API kullanılarak kullanıcının kimliğini doğrulamak için kullanılabilecek bir belirteç (token) alır. Performans nedenleriyle; API tarafından sağlanan temel bilgileri (kullanıcı kimliği, mevcut kullanıcı adı, görünen ad, avatar bağlantısı) yerel olarak saklamaktayız.',
      'removal' => 'Discord hesabınızı devre dışı bırakmanız durumunda bu bilgiler veri tabanımızdan otomatik olarak silinmez; bu nedenle verilerinizin silinmesini istiyorsanız bizimle iletişime geçtiğinizden emin olun.',
    ],
    'logData' => [
      'heading' => 'Günlük Verileri',
      'browserInfo' => 'Sitemizi her ziyaret ettiğinizde tarayıcınızın gönderdiği bilgileri ("Günlük Verileri") topluyoruz. Bu Günlük Verileri; bilgisayarınızın IP adresi, işletim sistemi, tarayıcı türü, tarayıcı sürümü, Sitemizde ziyaret ettiğiniz sayfalar ile ziyaretinizin saati ve tarihi gibi bilgileri içerebilir.',
      'thirdParty' => 'Bu Günlük Verileri yalnızca sunucumuzda saklanmakta olup herhangi bir üçüncü tarafla paylaşılmamaktadır. Günlük Verileri tanılama amaçlı kullanılmakta ve açıkça talep edilmesi halinde kolluk kuvvetleriyle paylaşılmaktadır. Bu veriler 14 güne kadar saklanmakta ve sonrasında silinmektedir.',
      'debugging' => 'Bot; Discord istemcisi aracılığıyla Kullanıcılardan, eğik çizgi komutları ve bağlam menüsü komutlarını ("Eylem", "Komut" veya topluca "Komutlar") içeren etkileşimler alabilir. Eğik çizgi komutları ek olarak Kullanıcı tarafından sağlanan yapılandırılmış anahtar-değer çiftleri ("Seçenekler") ile çalıştırılabilir. Bot; hata ayıklama amacıyla Komut çalıştırma işlemlerini, yani Komutu çalıştıran Kullanıcının Discord kullanıcı adını ve Snowflake tanımlayıcısını ("ID"), (tüm Seçenekler dahil olmak üzere) Komut adını ve Komutun çalıştırıldığı Sunucunun ID\'sini kaydeder. Bu veriler Proje sunucusunda 30 güne kadar saklanır ve yalnızca Geliştirici tarafından erişilebilir.',
      'noPii' => 'Komutları çalıştırırken herhangi bir Kişisel Bilgiyi dahil etmekten kaçınmalısınız. Bazı bilgiler Uygulama Günlüğümüzde yine de saklanabilir; bu nedenle müdahalemize ihtiyaç duyulması halinde bizi bilgilendirmek için lütfen bu belgenin sonunda açıklanan yöntemleri kullanarak bizimle iletişime geçin.',
    ],
    'telemetry' => [
      'heading' => 'Telemetri ve İstatistikler',
      'statsCollection' => 'Bot\'un kullanımını değerlendirmek ve böylece geliştirme kararlarına (ör. özelliklerin eklenmesi/kaldırılması) yön vermek amacıyla; Komutlar ve bunların kullanımına ilişkin belirli bir veri kümesi toplanabilir ("Telemetri"). Telemetri bilgileri; herhangi bir tanımlayıcı bilgi içermeksizin (dolayısıyla asla sunucu veya kullanıcı kimliklerini ya da kullanıcı tarafından sağlanan değerleri içermez ve tamamen anonimdir), hangi komutun ve seçeneklerin kullanıldığı ve bunların ne zaman kullanıldığı ile sınırlıdır. Telemetri süresiz olarak saklanır ve bundan türetilen istatistiklerin, toplu biçimde kamuya açık olarak görüntülenmesi ve paylaşılması amaçlanmaktadır.',
      'telemetryOptOut' => 'Kullanıcılar, Projeyi kullanarak Telemetri toplanmasını varsayılan olarak kabul eder. Bir Kullanıcı Telemetri toplanmasını devre dışı bırakmak isterse, <1/> sayfasındaki uygun seçenek aracılığıyla tercihini belirtebilir.',
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
