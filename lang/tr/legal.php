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
      'heading' => 'Telemetri ve İstatistikler',
      'statsCollection' => 'Bot\'un kullanımını değerlendirmek ve böylece geliştirme kararlarına (ör. özelliklerin eklenmesi/kaldırılması) yön vermek amacıyla; Komutlar ve bunların kullanımına ilişkin belirli bir veri kümesi toplanabilir ("Telemetri"). Telemetri bilgileri; herhangi bir tanımlayıcı bilgi içermeksizin (dolayısıyla asla sunucu veya kullanıcı kimliklerini ya da kullanıcı tarafından sağlanan değerleri içermez ve tamamen anonimdir), hangi komutun ve seçeneklerin kullanıldığı ve bunların ne zaman kullanıldığı ile sınırlıdır. Telemetri süresiz olarak saklanır ve bundan türetilen istatistiklerin, toplu biçimde kamuya açık olarak görüntülenmesi ve paylaşılması amaçlanmaktadır.',
      'telemetryOptOut' => 'Kullanıcılar, Projeyi kullanarak Telemetri toplanmasını varsayılan olarak kabul eder. Bir Kullanıcı Telemetri toplanmasını devre dışı bırakmak isterse, <1/> sayfasındaki uygun seçenek aracılığıyla tercihini belirtebilir.',
    ],
    'cookies' => [
      'heading' => 'Çerezler',
      'intro' => 'Çerezler, az miktarda veri içeren dosyalardır. Çerezler, bir web sitesinden tarayıcınıza gönderilir ve bilgisayarınızın sabit diskinizde saklanır.',
      'disable' => 'Bilgileri saklamak için "çerezler" kullanıyoruz. Tarayıcınıza tüm çerezleri reddetmesi veya bir çerez gönderildiğinde bunu belirtmesi talimatını verebilirsiniz. Ancak, çerezleri kabul etmezseniz, sitemizin bazı bölümlerini kullanamayabilirsiniz.',
      'optOut' => 'If you opt out of performance monitoring, a cookie remembering your choice is stored on your device for the longest time your browser allows, as its expiry is renewed each time you open a page of the Site.',
      'session' => 'Oturum açan kullanıcılar için, oturum durumunu tarayıcı oturumları arasında 30 gün boyunca hatırlamak için kalıcı bir çerez kullanılır. Hatırlanmayı durdurmak istiyorsanız, çıkış yapabilir veya sitemiz tarafından ayarlanan çerezleri temizleyebilirsiniz.',
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
      'heading' => 'Güvenlik',
      'noGuarantee' => 'Kişisel Bilgilerinizin güvenliği bizim için önemlidir, ancak internet üzerinden veri aktarımının veya elektronik depolamanın hiçbir yolunun %100 güvenli olmadığını unutmayın. Kişisel Bilgilerinizi korumak için ticari olarak kabul edilebilir araçlar kullanmak için çaba göstersek de, mutlak güvenliğini garanti edemeyiz.',
      'httpsCloudFlare' => 'Site, tarayıcı ile Sitemiz arasında verilerin bütünlüğünü korumak ve güvenli bir şekilde taşınmasını sağlamak için modern TLS şifrelemesini içeren HTTPS\'den yararlanmaktadır. Bununla birlikte, CloudFlare\'ın Reverse Proxy hizmetinden yararlanıyoruz, yani Sitemize gönderilen verilerin bir kısmı onların sunucularından geçiyor. CloudFlare kendi <1>gizlilik politikası</1> altında çalışır.',
      'breachNotify' => 'Bir güvenlik ihlali durumunda tüm kullanıcılar keşfedildikten sonraki 24 saat içinde bu web sitesinde yayınlanan bir bildirim, Bot tarafından gönderilen yanıtlar ve Bot\'un Discord destek sunucusundaki bir duyuru yoluyla bilgilendirilecektir.',
    ],
  ],
  'terms' => [
    'heading' => 'Şartlar & Koşullar',
    'license' => 'Projenin tüm kaynak kodu GitHub\'da herhangi bir garanti veya yükümlülük olmaksızın olduğu gibi sağlanmaktadır. Lisans koşullarının tamamı için lütfen bir kopyasını her repository\'de bulabileceğiniz <1>MIT lisans</1>ına bakın. Aşağıda özetlenen koşullar, Geliştirici tarafından barındırılan Proje sürümü ("Örnek") için geçerlidir ve burada getirilen sınırlamalar, Proje kaynak kodunun kullanımına ilişkin kısıtlamalar olarak değerlendirilmemelidir.',
    'noAbuse' => 'Komutları Örnek (Instance) üzerinden tekrar tekrar çalıştırmak için otomasyonlar kurmamalısınız. Bu Bot; diğer botlar gibi otomatik araçlar veya meşru kullanıcı etkinliğini taklit etmek üzere tasarlanmış herhangi bir başka yazılım tarafından kullanılmak üzere tasarlanmamıştır. Otomasyon amaçları doğrultusunda Botumuzun çıktısına bel bağlamak yerine; lütfen UNIX zaman damgalarının nasıl oluşturulacağı ve işleneceği konusunda, botunuzun kullandığı programlama dilinin dokümantasyonuna başvurun.',
    'fuckWeb3' => 'Bu Örnek; üretken yapay zeka modellerinin eğitilmesi sürecine katkıda bulunmak veya değiştirilemez tokenlar ("NFT\'ler") ya da herhangi bir kripto para birimi (ör. Ethereum, Bitcoin) ile ilgili herhangi bir etkinliğe ve/veya işleme aracılık etmek amacıyla kullanılmamalıdır.',
    'accessRevocation' => 'Örneğe erişiminiz, Geliştirici\'nin takdirine bağlı olarak herhangi bir nedenle (herhangi bir neden olmaksızın da dahil) geri alınabilir. Nedenler; bu şartların ihlali, Örnek özelliklerinin kasıtlı olarak kötüye kullanılması, Geliştiriciye veya Projeye katkıda bulunan herhangi birine yönelik şiddet tehditleri ve Örneğin kötü niyetli amaçlarla kullanılmasını içerebilir ancak bunlarla sınırlı değildir.',
  ],
  'changes' => [
    'heading' => 'Değişiklikler ve Revizyonlar',
    'effectiveFrom' => 'Topluca "Belgeler" olarak anılan Şartlar ve Koşullar ile Gizlilik Politikası, son güncelleme tarihi itibarıyla yürürlüktedir ve gelecekte hükümlerinde yapılacak herhangi bir değişiklik haricinde yürürlükte kalmaya devam edecektir; söz konusu değişiklikler bu sayfada yayınlandıktan hemen sonra yürürlüğe girecektir.',
    'rightToChange' => 'Bu Belgeleri herhangi bir zamanda güncelleme veya değiştirme hakkını saklı tutuyoruz; bu nedenle bu sayfayı periyodik olarak kontrol etmelisiniz. Belgeler üzerinde yaptığımız değişiklikleri bu sayfada yayınlamamızın ardından Projeyi kullanmaya devam etmeniz; değişiklikleri kabul ettiğiniz ve değiştirilmiş Belgelere uymayı ve bunlarla bağlı kalmayı onayladığınız anlamına gelecektir.',
    'willNotify' => 'If we make any material changes to these Documents, we will notify you by placing a prominent notice on our website, which is shown for up to two weeks after the update (unless you dismiss it earlier), as well as posting an announcement in the Bot\'s Discord support server.',
  ],
  'contact' => [
    'heading' => 'Bize Ulaşın',
    'whereToContact' => 'Bu Belgeler hakkında herhangi bir sorunuz varsa veya sakladığımız herhangi bir Kişisel Bilginin (PII) silinmesini talep etmek istiyorsanız; lütfen <1>Botun Discord sunucusu</1> aracılığıyla veya <3>Geliştiricinin web sitesinde</3> listelenen yöntemlerden herhangi birini kullanarak bizimle iletişime geçin.',
  ],
];
