<?php

return [
  'heading' => 'Analitik Halaman Dilihat',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'Data ini dikumpul di sisi pelayan, berdasarkan tindak balas yang dihantar ke set halaman yang terhad. Halaman dilihat direkod secara individu tetapi teragregat secara harian oleh proses latar belakang.',
  'lastUpdated' => 'Maklumat di halaman ini disimpan ke cache bagi tempoh yang singkat untuk mengurangkan muatan pelayan. Data yang anda lihat dikemaskinikan buat kali terakhir pada <1/>.',
  'charts' => [
    'dailyTotal' => 'Jumlah Harian Halaman Dilihat',
    'breakdown' => 'Pecahan Halaman Dilihat',
    'byPage' => 'Mengikut Halaman',
    'byLanguage' => 'Mengikut Bahasa',
  ],
  'values' => [
    'unknown' => 'Tidak diketahui',
  ],
];
