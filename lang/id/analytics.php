<?php

return [
  'heading' => 'Analisis Tayangan Halaman',
  'description' => 'Halaman ini berisi analitik dasar (baik yang disimpan maupun ditampilkan tanpa detail yang dapat mengidentifikasi individu) untuk total tampilan halaman agregat di aplikasi selama 30 hari terakhir.',
  'collectionMethod' => 'Data dikumpulkan di sisi server, berdasarkan respons yang dikirim ke sejumlah halaman terbatas. Tampilan halaman dicatat secara individual tetapi diagregasikan setiap hari oleh proses latar belakang.',
  'lastUpdated' => 'Informasi di halaman ini disimpan sementara untuk mengurangi beban server. Data yang Anda lihat terakhir diperbarui <1/>.',
  'charts' => [
    'dailyTotal' => 'Jumlah Tayangan Halaman Harian',
    'breakdown' => 'Rincian Tayangan Halaman',
    'byPage' => 'Berdasarkan Halaman',
    'byLanguage' => 'Berdasarkan Bahasa',
  ],
  'values' => [
    'unknown' => 'Tidak Diketahui',
  ],
];
