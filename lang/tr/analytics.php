<?php

return [
  'heading' => 'Sayfa Görüntüleme Analitiği',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
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
