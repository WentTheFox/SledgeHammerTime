<?php

return [
  'heading' => 'API Erişimi',
  'description' => 'Kendi programlarınız üzerinden zaman damgaları oluşturun ve uygulama ayarlarınızı değiştirin. Her uç noktası bir uygulama komutuna karşılık gelir ve istekler, anahtarın oluşturulduğu Discord hesabının ayarlarına göre işlenir.',
  'overview' => [
    'baseUrl' => 'Ana URL',
    'reference' => 'Etkileşimli dokümantasyon',
    'spec' => 'OpenAPI spesifikasyonu',
  ],
  'keys' => [
    'loginPrompt' => 'API anahtarları oluşturmak için giriş yapın. Bu anahtarlar, profilinize bağlı Discord hesaplarından biri adına işlem yapar.',
  ],
  'usage' => [
    'heading' => 'API Kullanımı',
    'authentication' => 'Her isteğin Authorization başlığında anahtarınızı Bearer token olarak gönderin.',
    'example' => 'Bu örnek, kayıtlı saat diliminize göre bugün saat 18.30 için bir zaman damgası döndürür. Örneklerdeki anahtar gerçek değildir, kendi anahtarınızı kullanın:',
    'limits' => 'İstekler, her anahtar için ayrı ayrı hız sınırına tabidir. Her yanıtın RateLimit başlıkları, mevcut hız sınırı durumunuzu gösterir. 429 durum koduyla dönen yanıtlarda ise ne kadar süre beklemeniz gerektiğini belirten bir Retry-After başlığı bulunur.',
    'statistics' => 'Çalıştırmalar, uygulama komutları gibi sayılır ve uygulama ayarlarınızdan telemetriyi devre dışı bırakmadığınız sürece yanıtta bunun kaçıncı çalıştırma olduğu belirtilir.',
  ],
  'permissions' => [
    'heading' => 'İzinler',
    'description' => 'Her anahtar, oluşturulurken verilen izinlere sahiptir. Bu sayfanın geri kalanında bu izinler aşağıdaki kodlarla belirtilir.',
    'me' => 'Her anahtar, izinlerinden bağımsız olarak sahip olduğu izinleri öğrenmek için <1/> uç noktasını kullanabilir.',
    'columns' => [
      'permission' => 'İzin',
      'allows' => 'Sağladığı Yetki',
    ],
    'scopes' => [
      'timestamps:create' => 'Anahtarın işlem yaptığı Discord hesabı adına, zaman damgası uç noktaları ve MCP araçları aracılığıyla zaman damgaları oluşturma.',
      'settings:read' => 'İlgili hesabın uygulama ayarlarını görüntüleme.',
      'settings:write' => 'İlgili hesabın uygulama ayarlarını değiştirme. Yalnızca istekte gönderilen alanlar değiştirilir.',
    ],
  ],
  'reference' => [
    'heading' => 'Uç nokta referansı',
    'description' => 'Her uç noktanın kabul ettiği alanlar ve döndürdüğü yanıtlar burada listelenir. Bu bilgiler doğrudan API sunucusunun OpenAPI spesifikasyonundan alındığı için her zaman çalışan sürümle uyumludur.',
    'errors' => 'Hatalar',
    'errorsDescription' => 'Her hata yanıtı bu yapıya sahiptir. Durum kodu hatanın türünü, error.code ise tam nedenini belirtir.',
    'optional' => 'isteğe bağlı',
    'unavailable' => 'Referans bilgileri şu anda yüklenemiyor. Aynı bilgilere etkileşimli dokümantasyondan ulaşabilirsiniz.',
    'permission' => 'İzin',
    'anyKey' => 'Herhangi bir geçerli anahtar',
    'noKey' => 'Anahtar gerekmez',
    'requestBody' => 'İstek gövdesi (JSON)',
    'responses' => 'Yanıtlar',
    'nullable' => 'Can be null',
  ],
  'mcp' => [
    'heading' => 'MCP sunucusunu kullanma',
    'description' => 'MCP sunucusu, Streamable HTTP iletişim yöntemini ve aynı anahtarları kullanır. Her komut ve ayarlar için ayrı bir araç sunar. Yalnızca anahtarınızın izin verdiği araçlara erişebilirsiniz.',
    'url' => 'Sunucu Adresi',
    'placeholderKey' => 'Aşağıdaki örneklerde kullanılan anahtar gerçek değildir ve çalışmayacaktır. Bu anahtarı kendi anahtarlarınızdan biriyle değiştirin.',
    'claudeCode' => 'Claude Code\'a şu komutla ekleyin:',
    'otherClients' => 'Diğer istemciler de URL ve Authorization başlığını içeren benzer bir yapılandırma kullanır:',
  ],
];
