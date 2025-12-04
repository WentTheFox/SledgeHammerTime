<?php

return [
  'seoDescription' => 'Discord mesajları için zaman damgaları oluştur',
  'changeLanguage' => 'Dili değiştir',
  "notFound" => [
    "heading" => "Sayfa bulunamadı",
    "content" => "Burada görülecek bir şey yok.",
  ],
  "maintenanceMode" => [
    "heading" => "Bakım Modu",
    "content" => [
      'pleaseWait' => "Uygulama şu anda güncelleniyor, lütfen birkaç saniye sonra tekrar deneyin.",
      'joinSupportServer' => "Sorun birkaç dakikadan fazla devam ederse, lütfen Discord destek sunucumuza katılın ve bize bildirin.",
      'contactDeveloper' => "Sorun birkaç dakikadan fazla devam ederse, lütfen geliştiriciyle iletişime geçin ve durumu bildirin.",
    ],
    "supportServerButton" => "Destek Sunucusu",
  ],
  'incompleteTranslations' => 'Çeviriler tamamlanmadı',
  'contributeTranslations' => 'Katkıda Bulun',
  'copyToClipboard' => 'Panoya kopyala',
  'copiedToClipboard' => 'Panoya kopyalandı!',
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
      'customDateInput' => [
        'label' => 'Özel tarih girişi',
        'description' => "Tarayıcının varsayılan tarih girişini özel bir girişle değiştirin.",
      ],
      'customTimeInput' => [
        'label' => 'Özel zaman girişi',
        'description' => "Tarayıcının varsayılan zaman girişini özel bir girişle değiştirin. Bu, özellikle mobil tarayıcılarda zaman seçmekte zorlanıyorsanız faydalıdır.",
      ],
      'separateInputs' => [
        'label' => 'Girdileri ayır',
        'description' => "Tarih ve saat için birleşik girdi yerine iki farklı ayrı girdi görüntüleyin (bazı tarayıcılarda desteklenmez)",
      ],
      'flatUi' => [
        'label' => 'Düzleştirilmiş arayüz',
        'description' => "Girişler ve butonlardaki gölge ve yükseklik efektlerini devre dışı bırakın",
      ],
    ],
    'timeSync' => [
      'title' => 'Zaman Senkronizasyonu',
      'status' => [
        'syncing' => 'Sistem saatiniz şu anda sunucularımızla senkronize ediliyor, lütfen bekleyin.',
        'accurate' => 'Sistem saatiniz doğru.',
        'potentiallyWrong' => 'Sistem saatiniz yanlış olabilir.',
        'value' => 'Yerel ile sunucu saati arasındaki fark :offset\'dir.',
      ],
      'autoTimeSync' => [
        'label' => 'Sunucu zaman ofsetini hesaplamalara uygula (beta)',
        'description' => 'Sistem saatiniz ile sunucu saati arasında (zaman dilimi farkları hariç) :offset \'ten fazla bir sapma varsa, bazı zaman hesaplamaları bu durumu dikkate alacak şekilde ayarlanır. Bu sayede, zaman damgalarınızın hatalı olma olasılığı azalacaktır. <1>Bu deneysel bir özelliktir, dikkatli kullanın!</1> Senkronizasyon, sayfa ilk yüklendiğinde ve ayar etkinleştirildikten hemen sonra gerçekleşir.',
      ],
      'details' => 'Ayrıntılar',
      'autoApplyCheckbox' => ':syncButtonLabel düğmesine manuel olarak basıldığında, hesaplanan ofseti DateTime kütüphanesine uygulayın (yalnızca fark, :offset eşiğinin üzerindeyse uygulanır).',
      'syncButtonLabel' => 'Senkronize et',
      'resetOffsetButtonLabel' => 'Uygulanan ofseti sıfırla',
      'roundTripDuration' => 'Gidiş-dönüş süresi',
      't0' => 'İsteğin, istemci tarafından gönderildiği ana ait zaman damgası.',
      't1' => 'İsteğin sunucu tarafındaki alınma zaman damgası',
      't2' => 'Yanıtın, sunucu tarafından gönderildiği ana ait zaman damgası.',
      't3' => 'Yanıtın istemci tarafından alındığı zaman damgası',
      'dtlOffsetCell' => 'Aktif Hesaplama Ofseti',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Algılanan Ofset (Ağ üzerinden)',
    ],
    'localSettings' => [
      'title' => 'Yerel Ayarlar',
    ],
    'credits' => [
      'title' => 'Katkıda Bulunanlar',
      'developedBy' => '<1></1> Tarafından geliştirdi',
      'using' => 'Kullanılanlar <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
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
      'dark' => 'Koyu Tema',
      'light' => 'Açık Tema',
      'system' => 'Sistem temasını kullan',
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
