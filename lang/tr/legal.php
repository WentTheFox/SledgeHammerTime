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
      'heading' => 'Çerezler',
      'intro' => 'Çerezler, az miktarda veri içeren dosyalardır. Çerezler, bir web sitesinden tarayıcınıza gönderilir ve bilgisayarınızın sabit diskinizde saklanır.',
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
    'noAbuse' => 'Komutları Örnek (Instance) üzerinden tekrar tekrar çalıştırmak için otomasyonlar kurmamalısınız. Bu Bot; diğer botlar gibi otomatik araçlar veya meşru kullanıcı etkinliğini taklit etmek üzere tasarlanmış herhangi bir başka yazılım tarafından kullanılmak üzere tasarlanmamıştır. Otomasyon amaçları doğrultusunda Botumuzun çıktısına bel bağlamak yerine; lütfen UNIX zaman damgalarının nasıl oluşturulacağı ve işleneceği konusunda, botunuzun kullandığı programlama dilinin dokümantasyonuna başvurun.',
    'fuckWeb3' => 'Bu Örnek; üretken yapay zeka modellerinin eğitilmesi sürecine katkıda bulunmak veya değiştirilemez tokenlar ("NFT\'ler") ya da herhangi bir kripto para birimi (ör. Ethereum, Bitcoin) ile ilgili herhangi bir etkinliğe ve/veya işleme aracılık etmek amacıyla kullanılmamalıdır.',
    'accessRevocation' => 'Örneğe erişiminiz, Geliştirici\'nin takdirine bağlı olarak herhangi bir nedenle (herhangi bir neden olmaksızın da dahil) geri alınabilir. Nedenler; bu şartların ihlali, Örnek özelliklerinin kasıtlı olarak kötüye kullanılması, Geliştiriciye veya Projeye katkıda bulunan herhangi birine yönelik şiddet tehditleri ve Örneğin kötü niyetli amaçlarla kullanılmasını içerebilir ancak bunlarla sınırlı değildir.',
  ],
  'changes' => [
    'heading' => 'Değişiklikler ve Revizyonlar',
    'effectiveFrom' => 'Topluca "Belgeler" olarak anılan Şartlar ve Koşullar ile Gizlilik Politikası, son güncelleme tarihi itibarıyla yürürlüktedir ve gelecekte hükümlerinde yapılacak herhangi bir değişiklik haricinde yürürlükte kalmaya devam edecektir; söz konusu değişiklikler bu sayfada yayınlandıktan hemen sonra yürürlüğe girecektir.',
    'rightToChange' => 'Bu Belgeleri herhangi bir zamanda güncelleme veya değiştirme hakkını saklı tutuyoruz; bu nedenle bu sayfayı periyodik olarak kontrol etmelisiniz. Belgeler üzerinde yaptığımız değişiklikleri bu sayfada yayınlamamızın ardından Projeyi kullanmaya devam etmeniz; değişiklikleri kabul ettiğiniz ve değiştirilmiş Belgelere uymayı ve bunlarla bağlı kalmayı onayladığınız anlamına gelecektir.',
    'willNotify' => 'Bu Belgelerde herhangi bir önemli değişiklik yapmamız durumunda; web sitemizde belirgin bir bildirim yayınlayarak ve Botun Discord destek sunucusunda bir duyuru paylaşarak sizi bilgilendireceğiz.',
  ],
  'contact' => [
    'heading' => 'Bize Ulaşın',
    'whereToContact' => 'Bu Belgeler hakkında herhangi bir sorunuz varsa veya sakladığımız herhangi bir Kişisel Bilginin (PII) silinmesini talep etmek istiyorsanız; lütfen <1>Botun Discord sunucusu</1> aracılığıyla veya <3>Geliştiricinin web sitesinde</3> listelenen yöntemlerden herhangi birini kullanarak bizimle iletişime geçin.',
  ],
];
