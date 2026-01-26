<?php

return [
  'heading' => 'Sayfa Görüntüleme Analitiği',
  'description' => 'Bu sayfada, son 30 güne ait uygulama içi toplam sayfa görüntüleme sayılarını içeren temel analitik verileri yer almaktadır. Bu bilgiler, kimlik tanımlayıcı hiçbir detay içermeyecek şekilde (anonim olarak) hem saklanır hem de gösterilir.',
  'collectionMethod' => 'Veriler, sınırlı sayıdaki sayfaya gönderilen yanıtlara dayanarak sunucu tarafında toplanır. Sayfa görüntülemeleri bireysel olarak kaydedilir, ancak bir arka plan işlemi tarafından günlük olarak birleştirilir.',
  'lastUpdated' => 'Sunucu yükünü azaltmak amacıyla, bu sayfadaki bilgiler kısa süreliğine önbelleğe alınmaktadır. Gördüğünüz veriler en son <1/> güncellendi.',
  'charts' => [
    'dailyTotal' => 'Günlük Toplam Sayfa Görüntüleme',
    'breakdown' => 'Sayfa Görüntüleme Dağılımı',
    'byPage' => 'Sayfalara Göre',
    'byLanguage' => 'Dile Göre',
  ],
  'values' => [
    'unknown' => 'Bilinmeyen',
  ],
];
