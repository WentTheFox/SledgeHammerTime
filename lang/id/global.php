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
  'incompleteTranslations' => 'Terjemahannya tidak lengkap',
  'contributeTranslations' => 'Kontribusi',
  'copyToClipboard' => 'Menyalin ke clipboard',
  'copiedToClipboard' => 'Disalin ke papan klip!',
  'jsDisabled' => [
    'title' => 'JavaScript diperlukan',
    'body' => "Peramban Anda tidak mendukung JavaScript atau sedang dinonaktifkan. Beberapa browser menonaktifkan JavaScript secara bawaan untuk alasan keamanan, tetapi itu diperlukan untuk aplikasi ini. Harap aktifkan dan segarkan halaman, atau gunakan browser lain.",
  ],
  'nav' => [
    'botSettings' => 'Pengaturan Aplikasi',
    'profile' => 'Profil',
    'legal' => 'Informasi Legal',
    'analytics' => 'Analisis',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Pengaturan Masukan',
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
        'label' => 'Masukan terpisah',
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
      'dtlOffsetCell' => 'Active Calculation Offset',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
    ],
    'localSettings' => [
      'title' => 'Local Settings',
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
    'title' => 'Design Editor',
    'description' => 'You can adjust many aspects of the website\'s appearance using the inputs in the table below. Variable names are based on identifiers in the code and therefore cannot be translated. Values will be reset when refreshing the page.',
    'designPageLink' => 'Design Page',
    'exportInfo' => 'You may export your changes to a UserStyle file, which can be used with an extension such as <1>Stylus</1> to customize the app\'s appearance permanently. Note, however, that these variables may change at any point, requiring you to manually update your custom styles.',
    'export' => 'Export as UserStyle',
    'variableColumnHeader' => 'CSS Variable',
    'valueColumnHeader' => 'Value',
  ],
];
