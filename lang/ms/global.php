<?php

return [
  'seoDescription' => 'Jana penunjuk cap masa untuk mesej sembang Discord',
  'changeLanguage' => 'Tukar bahasa',
  "notFound" => [
    "heading" => "Halaman Tidak Dijumpai",
    "content" => "Tiada apa-apa untuk dilihat di sini.",
  ],
  "maintenanceMode" => [
    "heading" => "Mod Penyelenggaraan",
    "content" => [
      'pleaseWait' => "Aplikasi ini sedang dikemas kini, sila cuba semula sebentar lagi.",
      'joinSupportServer' => "Sekiranya masalah berterusan melebihi beberapa minit, sila sertai pelayan sokongan Discord dan beritahu kami.",
      'contactDeveloper' => "Sekiranya masalah berterusan melebihi beberapa minit, sila hubungi pembangun dan beritahunya.",
    ],
    "supportServerButton" => "Pelayan Sokongan",
  ],
  'incompleteTranslations' => 'Terjemahan masih belum lengkap',
  'contributeTranslations' => 'Sumbang',
  'copyToClipboard' => 'Salin ke papan keratan',
  'copiedToClipboard' => 'Disalin ke papan keratan!',
  'jsDisabled' => [
    'title' => 'JavaScript diperlukan',
    'body' => "Pelayar anda sama ada tidak menyokong JavaScript ataupun ia dinyahdayakan ketika ini. Sesetengah pelayar menyahdayakan JavaScript secara lalainya atas sebab keselamatan, tetapi ia diperlukan untuk aplikasi ini. Sila mendayakannya dan segar semula halaman, atau guna pelayar yang lain.",
  ],
  'nav' => [
    'botSettings' => 'Tetapan Apl',
    'profile' => 'Profil',
    'legal' => 'Maklumat Undang-Undang',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => 'Tetapan input',
      'naturalLanguageInput' => [
        'label' => '@time input field',
        'description' => 'Allow manipulating the selected timestamp with natural language (e.g. “in 5 hours”) via an additional free-text input. Similar to the new Discord @time tag. Only a limited number of languages are supported.',
      ],
      'customDateInput' => [
        'label' => 'Input tarikh tersuai',
        'description' => "Gantikan input tarikh lalai pelayar dengan input tersuai.",
      ],
      'customTimeInput' => [
        'label' => 'Input masa tersuai',
        'description' => "Gantikan input masa lalai pelayar dengan input tersuai. Tetapan ini berguna terutamanya apabila anda mengalami masalah memilih masa pada pelayar peranti mudah alih.",
      ],
      'separateInputs' => [
        'label' => 'Input berasingan',
        'description' => "Memaparkan dua input berlainan untuk tarikh dan masa menggantikan input bergabung (yang tidak disokong pada sesetengah pelayar)",
      ],
      'flatUi' => [
        'label' => 'Leperkan antara muka',
        'description' => "Nyahdayakan kesan ketinggian dan bayang pada input dan butang",
      ],
    ],
    'timeSync' => [
      'title' => 'Penyegerakan Masa',
      'status' => [
        'syncing' => 'Jam sistem anda sedang disegerakkan dengan pelayan kami, sila tunggu.',
        'accurate' => 'Jam sistem anda adalah tepat.',
        'potentiallyWrong' => 'Jam sistem anda mungkin salah.',
        'value' => 'Perbezaan antara masa tempatan dan masa pelayan ialah :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Terapkan ofset masa pelayan pada pengiraan (beta)',
        'description' => 'Sekiranya jam sistem anda berbeza melebihi :offset berbanding jam pelayan (tidak termasuk perbezaan zon waktu), perkiraan masa akan dilaraskan untuk mengambil kira perbezaan ini, supaya kurang risiko untuk cap masa anda menjadi salah. <1>Ciri ini dalam uji kaji, gunakan dengan berhati-hati!</1> Penyegerakkan dilakukan apabila halaman dimuatkan buat kali pertama, dan secara serta-merta setelah tetapan ini dihidupkan.',
      ],
      'details' => 'Butiran',
      'autoApplyCheckbox' => 'Terapkan ofset ke pustaka DateTime apabila butang :syncButtonLabel ditekan secara manual (hanya diterapkan sekiranya perbezaan melebihi nilai ambang :offset)',
      'syncButtonLabel' => 'Segerakkan',
      'resetOffsetButtonLabel' => 'Tetapkan semula ofset diterap',
      'roundTripDuration' => 'Tempoh masa pergi balik',
      't0' => 'Cap masa klien bagi penghantaran permintaan',
      't1' => 'Cap masa pelayan bagi penerimaan permintaan',
      't2' => 'Cap masa pelayan bagi penghantaran sambutan',
      't3' => 'Cap masa klien bagi penerimaan sambutan',
      'dtlOffsetCell' => 'Ofset Perkiraan Aktif',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Ofset Dikesan (melalui Rangkaian)',
    ],
    'localSettings' => [
      'title' => 'Tetapan Tempatan',
    ],
    'credits' => [
      'title' => 'Penghargaan',
      'developedBy' => 'Dibangunkan oleh <1></1>',
      'using' => 'Menggunakan <1></1>',
      'fontAwesomeFree' => 'Font Awesome Free',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'chrono' => 'chrono',
      'translatedBy' => 'Terjemahan oleh <1></1>',
      'openSourceSoftware' => 'Perisian sumber terbuka',
      'viewSourceCode' => 'Lihat kod sumber',
      'notAffiliated' => 'Projek ini tidak berkaitan dengan Discord.',
    ],
    'themeButton' => [
      'dark' => 'Tema Gelap',
      'light' => 'Tema Cerah',
      'system' => 'Guna Tema Sistem',
    ],
  ],
  'designEditor' => [
    'title' => 'Penyunting Reka Bentuk',
    'description' => 'Anda boleh mengubah pelbagai aspek penampilan laman sesawang ini menggunakan input di jadual di bawah. Nama-nama pemboleh ubah didasarkan pada pengenal pasti dalam kod dan oleh itu tidak boleh diterjemahkan. Nilai-nilai akan ditetapkan semula apabila halaman disegarkan semula.',
    'designPageLink' => 'Halaman Reka Bentuk',
    'exportInfo' => 'Anda boleh eksport perubahan anda ke sebuah fail UserStyle, yang boleh digunakan bersama sambungan seperti <1>Stylus</1> untuk mengubah suai penampilan aplikasi secara kekal. Namun begitu, ambil perhatian bahawa pemboleh ubah ini boleh berubah pada bila-bila masa, memerlukan anda mengemas kini gaya tersuai anda secara manual.',
    'export' => 'Eksport sebagai UserStyle',
    'variableColumnHeader' => 'Pembolehubah CSS',
    'valueColumnHeader' => 'Nilai',
  ],
];
