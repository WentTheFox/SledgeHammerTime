<?php

return [
  'howTo' => 'Pilih tanggal, salin stempel waktu yang diinginkan dari kolom :syntaxColName, lalu tempel di mana saja dalam pesan obrolan. Hasilnya akan menjadi stempel waktu yang ditampilkan secara berbeda untuk semua orang berdasarkan zona waktu mereka sendiri.',
  'picker' => [
    'label' => [
      'date' => 'Tanggal',
      'time' => 'Waktu',
      'dateAndTime' => 'Tanggal dan waktu',
      'timezone' => 'Zona waktu',
      'naturalLanguageInput' => 'input @time',
      'modeOffset' => 'Offset Absolut',
      'modeZoneName' => 'Nama Zona',
    ],
    'button' => [
      'jumpToToday' => 'Lompat ke bulan saat ini',
      'contextRange' => '<0/>-<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Setel ke waktu saat ini',
      'lock' => 'Mengunci stempel waktu melalui URL',
      'unlock' => 'Buka kunci stempel waktu',
      'previousYear' => 'Tahun lalu',
      'previousMonth' => 'Bulan lalu',
      'previousDecade' => 'Dekade sebelumnya',
      'nextMonth' => 'Bulan depan',
      'nextYear' => 'Tahun depan',
      'nextDecade' => 'Dekade berikutnya',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Tidak dapat menguraikan input bahasa alami.'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sintaks obrolan',
    'resultColumn' => 'Contoh hasil',
    'editFormats' => 'Customize formats',
    'resetFormats' => 'Reset to defaults',
    'hideFormat' => 'Hide this format',
    'showFormat' => 'Show this format',
    'unhideInProfile' => 'Unhide in profile settings',
  ],
  'faq' => [
    'title' => 'Frequently Asked Questions',
    'description' => 'This section is English-only for now, and it\'s heavily based on content from <1>our Discord server</1>. Some links might not work as expected unless you are a member.',
  ],
  'usefulLinks' => [
    'lead' => 'Anda mungkin juga menemukan ini berguna:',
    'server' => [
      'header' => 'Server HammerTime Resmi',
      'p' => 'Diskusikan situs web, uji sintaks dan sarankan fitur',
    ],
    'bot' => [
      'header' => 'Aplikasi HammerTime',
      'p' => 'Hasilkan stempel waktu dari dalam Discord menggunakan perintah garis miring',
    ],
    'oldSite' => [
      'header' => 'Situs Web Lama HammerTime',
      'p' => 'Situs web lama proyek tersebut masih tersedia hingga pemberitahuan lebih lanjut.',
    ],
    'textColor' => [
      'header' => 'Generator Teks <1>Berwarna</1> Rebane',
      'p' => 'Aplikasi sederhana yang membuat pesan Discord berwarna menggunakan kode warna ANSI',
    ],
    "subreddit" => [
      "p" => "Komunitas yang menyelenggarakan tantangan mingguan untuk game balap yang kurang dikenal yang menginspirasi terciptanya proyek ini",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => '',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => '',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
