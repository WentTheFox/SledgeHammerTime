<?php

return [
  'seoDescription' => 'Discord mesajları için zaman damgaları oluştur',
  'changeLanguage' => 'Dili değiştir',
  "notFound" => [
    "heading" => "Sayfa bulunamadı",
    "content" => "Burada görülecek bir şey yok.",
  ],
  'incompleteTranslations' => 'Çeviriler tamamlanmadı',
  'contributeTranslations' => 'Katkıda Bulun',
  'copyToClipboard' => 'Panoya kopyala',
  'copiedToClipboard' => 'Copied to clipboard!',
  'jsDisabled' => [
    'title' => 'JavaScript gerekli',
    'body' => "Tarayıcınız JavaScript'i desteklemiyor veya şu anda devre dışı. Bazı tarayıcılar güvenlik için JavaScript'i devre dışı bırakır, ancak bu siteyi kullanabilmek için JavaScript'i etkinleştirmeniz gerekmekte. Lütfen etkinleştirin ve sayfayı yenileyin veya farklı bir tarayıcı kullanın.",
  ],
  'nav' => [
    'botSettings' => 'Uygulama Ayarları',
    'profile' => 'Profil',
    'legal' => 'Yasal Bilgiler',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Girdi ayarları',
      'customInputs' => [
        'label' => 'Özel girdiler',
        'description' => "Tarayıcının varsayılan girdi kutucuklarını seçtiğiniz dile uygun özel girdi kutucuklarıyla değiştirir",
      ],
      'separateInputs' => [
        'label' => 'Girdileri ayır',
        'description' => "Tarih ve saat için birleşik girdi yerine iki farklı ayrı girdi görüntüleyin (bazı tarayıcılarda desteklenmez)",
      ],
    ],
    'timeSync' => [
      'title' => 'Zaman Senkronizasyonu',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'Sistem saatiniz doğru.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'Yerel ile sunucu saati arasındaki fark :offset\'dir.',
      ],
      'autoTimeSync' => [
        'label' => 'Apply server time offset to calculations (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => 'Ayrıntılar',
      'autoApplyCheckbox' => 'Apply calculated offset to DateTime library when pressing :syncButtonLabel manually (only applies if the difference is above the :offset threshold)',
      'syncButtonLabel' => 'Synchronize',
      'resetOffsetButtonLabel' => 'Reset applied offset',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'dtlOffsetCell' => 'Active Calculation Offset',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
    ],
    'localSettings' => [
      'title' => 'Yerel Ayarlar',
    ],
    'credits' => [
      'title' => 'Katkıda Bulunanlar',
      'developedBy' => '<1></1> Tarafından geliştirdi',
      'using' => 'Kullanılanlar <1></1>',
      'fontAwesomeFree' => 'Yazı Tipi Harika Ücretsiz',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => 'Çevirenler <1></1>',
      'openSourceSoftware' => 'Açık kaynak kodlu yazılım',
      'viewSourceCode' => 'Kaynak kodunu görüntüle',
      'notAffiliated' => 'Bu proje Discord ile bağlantılı değildir.',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
    ],
  ],
  'designEditor' => [
    'title' => 'Tasarım Editörü',
    'description' => 'Aşağıdaki tabloda yer alan girdileri kullanarak web sitesinin görünümünün birçok yönünü ayarlayabilirsiniz. Değişken adları koddaki tanımlayıcılara dayanmaktadır ve bu nedenle çevrilemez. Sayfa yenilendiğinde değerler sıfırlanacaktır.',
    'designPageLink' => 'Tasarım Sayfası',
    'exportInfo' => 'Değişikliklerinizi, uygulamanın görünümünü kalıcı olarak özelleştirmek için <1>Stylus</1> gibi bir uzantıyla kullanılabilecek bir UserStyle dosyasına aktarabilirsiniz. Ancak, bu değişkenlerin herhangi bir noktada değişebileceğini ve özel stillerinizi manuel olarak güncellemenizi gerektirebileceğini unutmayın.',
    'export' => 'UserStyle olarak dışa aktar',
    'variableColumnHeader' => 'CSS Değişkeni',
    'valueColumnHeader' => 'Değer',
  ],
];
