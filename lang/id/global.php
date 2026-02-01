<?php

return [
  'seoDescription' => 'Hasilkan indikator stempel waktu untuk pesan obrolan Discord',
  'changeLanguage' => 'Ganti bahasa',
  "notFound" => [
    "heading" => "Halaman Tidak Ditemukan",
    "content" => "Tidak ada yang bisa dilihat di sini.",
  ],
  "maintenanceMode" => [
    "heading" => "Mode Pemeliharaan",
    "content" => [
      'pleaseWait' => "Aplikasi sedang diperbarui, silakan coba lagi dalam beberapa detik.",
      'joinSupportServer' => "Jika masalah berlanjut selama lebih dari beberapa menit, silakan bergabung dengan server dukungan Discord dan beri tahu kami.",
      'contactDeveloper' => "Jika masalah berlanjut selama lebih dari beberapa menit, silakan hubungi pengembang dan beri tahu mereka.",
    ],
    "supportServerButton" => "Server Dukungan",
  ],
  'incompleteTranslations' => 'Terjemahannya belum lengkap',
  'contributeTranslations' => 'Kontribusi',
  'copyToClipboard' => 'Menyalin ke clipboard',
  'copiedToClipboard' => 'Disalin ke papan klip!',
  'jsDisabled' => [
    'title' => 'JavaScript diperlukan',
    'body' => "Browser Anda tidak mendukung JavaScript atau sedang dinonaktifkan. Beberapa browser menonaktifkan JavaScript secara bawaan untuk alasan keamanan, tetapi itu diperlukan untuk aplikasi ini. Harap aktifkan dan segarkan halaman, atau gunakan browser lain.",
  ],
  'nav' => [
    'botSettings' => 'Pengaturan Aplikasi',
    'profile' => 'Profil',
    'legal' => 'Informasi Legal',
    'analytics' => 'Analisis',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Pengaturan Input',
      'naturalLanguageInput' => [
        'label' => 'kolom input @waktu',
        'description' => 'Memungkinkan manipulasi stempel waktu yang dipilih dengan bahasa alami (misalnya, "dalam 5 jam") melalui input teks bebas tambahan. Mirip dengan tag @time Discord yang baru. Hanya sejumlah bahasa terbatas yang didukung.',
      ],
      'customDateInput' => [
        'label' => 'Input tanggal khusus',
        'description' => "Ganti input tanggal bawaan browser dengan input tanggal kustom.",
      ],
      'customTimeInput' => [
        'label' => 'Input waktu khusus',
        'description' => "Mengganti input waktu default browser dengan input waktu kustom. Ini sangat berguna jika Anda kesulitan memilih waktu di browser seluler.",
      ],
      'separateInputs' => [
        'label' => 'Input terpisah',
        'description' => "Tampilkan dua input berbeda untuk tanggal dan waktu alih-alih input gabungan (yang tidak didukung di beberapa browser)",
      ],
      'flatUi' => [
        'label' => 'Ratakan antarmuka',
        'description' => "Nonaktifkan efek bayangan dan ketinggian pada input dan tombol.",
      ],
      'hourCycle' => [
        'label' => 'Jenis jam input waktu khusus',
        'description' => 'Mengubah cara jam ditampilkan dalam input waktu kustom. Tidak berpengaruh pada pratinjau di kolom contoh hasil.',
        'options' => [
          'default' => 'Bahasa bawaan',
          'h12' => '12 jam',
          'h24' => '24 jam',
        ],
      ],
      'firstDayOfWeek' => [
        'label' => 'Hari pertama dalam seminggu',
        'description' => 'Ubah hari mana yang dianggap sebagai hari pertama dalam seminggu di kalender dari input tanggal kustom.',
        'options' => [
          'default' => 'Bahasa bawaan',
        ],
      ],
      'advancedSettings' => 'Pengaturan input lanjutan',
    ],
    'timeSync' => [
      'title' => 'Sinkronisasi Waktu',
      'status' => [
        'syncing' => 'Jam sistem Anda saat ini sedang disinkronkan dengan server kami, mohon tunggu.',
        'accurate' => 'Jam sistem Anda akurat.',
        'potentiallyWrong' => 'Jam sistem Anda mungkin salah.',
        'value' => 'Perbedaan antara waktu lokal dan waktu server adalah :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Terapkan offset waktu server ke perhitungan (beta)',
        'description' => 'Jika jam sistem Anda lebih dari :offset dibandingkan dengan waktu server (tidak termasuk perbedaan zona waktu), beberapa perhitungan waktu akan disesuaikan untuk memperhitungkan hal ini, sehingga stempel waktu Anda cenderung tidak akan salah. <1>Ini adalah fitur eksperimental, gunakan dengan hati-hati!</1> Sinkronisasi terjadi saat halaman pertama kali dimuat, dan segera setelah pengaturan diaktifkan.',
      ],
      'details' => 'Detail',
      'autoApplyCheckbox' => 'Terapkan offset yang dihitung ke pustaka DateTime saat menekan :syncButtonLabel secara manual (hanya berlaku jika selisihnya di atas ambang batas :offset)',
      'syncButtonLabel' => 'Sinkronkan',
      'resetOffsetButtonLabel' => 'Reset offset yang diterapkan',
      'roundTripDuration' => 'Durasi perjalanan pulang pergi',
      't0' => 'Stempel waktu klien pada saat pengiriman permintaan',
      't1' => 'Stempel waktu penerimaan permintaan oleh server.',
      't2' => 'Stempel waktu server pada transmisi respons.',
      't3' => 'Stampel waktu penerimaan respons dari klien',
      'dtlOffsetCell' => 'Offset Perhitungan Aktif',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Offset Terdeteksi (melalui Jaringan)',
    ],
    'localSettings' => [
      'title' => 'Pengaturan Lokal',
    ],
    'credits' => [
      'title' => 'Kredit',
      'developedBy' => 'Dikembangkan oleh <1></1>',
      'using' => 'Menggunakan <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Terjemahan oleh <1></1>',
      'openSourceSoftware' => 'Perangkat lunak sumber terbuka',
      'viewSourceCode' => 'Lihat kode sumber',
      'notAffiliated' => 'Proyek ini tidak berafiliasi dengan Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tema Gelap',
      'light' => 'Tema Terang',
      'system' => 'Gunakan Tema Sistem',
    ],
  ],
  'designEditor' => [
    'title' => 'Editor Desain',
    'description' => 'Anda dapat menyesuaikan banyak aspek tampilan situs web menggunakan input pada tabel di bawah ini. Nama variabel didasarkan pada pengidentifikasi dalam kode dan oleh karena itu tidak dapat diterjemahkan. Nilai akan diatur ulang saat menyegarkan halaman.',
    'designPageLink' => 'Halaman Desain',
    'exportInfo' => 'Anda dapat mengekspor perubahan Anda ke file UserStyle, yang dapat digunakan dengan ekstensi seperti <1>Stylus</1> untuk menyesuaikan tampilan aplikasi secara permanen. Namun, perlu diingat bahwa variabel-variabel ini dapat berubah sewaktu-waktu, sehingga Anda perlu memperbarui gaya kustom Anda secara manual.',
    'export' => 'Ekspor sebagai UserStyle',
    'variableColumnHeader' => 'Variabel CSS',
    'valueColumnHeader' => 'Nilai',
  ],
];
