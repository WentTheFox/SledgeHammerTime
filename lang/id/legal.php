<?php

return [
  'translations' => [
    'title' => 'Konten Terjemahan',
    'text' => 'Proyek ini berisi terjemahan oleh penerjemah sukarelawan dan anggota komunitas lainnya. Terjemahan ini disediakan untuk kenyamanan pengguna, dan mungkin tidak selalu sepenuhnya mutakhir. Dalam segala hal, <1>versi bahasa asli</1> halaman ini dianggap berlaku.',
  ],
  'lastUpdated' => 'Terakhir Diperbarui: <1/>',
  'privacy' => [
    'heading' => 'Kebijakan Privasi',
    'operator' => '<0/> ("kami", "kita", "milik kami", atau "Pengembang") mengoperasikan situs web HammerTime ("Situs"), dan HammerTimeBot ("Bot", atau "Aplikasi"), secara kolektif disebut Proyek HammerTime ("Proyek"). Halaman ini memberi tahu Anda tentang kebijakan kami mengenai pengumpulan, penggunaan, dan pengungkapan Informasi Pribadi yang kami terima dari pengguna Proyek ("Anda", "Pengguna", atau secara kolektif "Pengguna").',
    'notAffiliated' => 'Meskipun nama "HammerTime" ("Nama Proyek") berasal dari nama sebelumnya "Hammer & Chisel" dari Discord, Inc. ("Discord")<1/> Proyek ini tidak berafiliasi dengan Discord, atau MC Hammer, yang lagunya<3/> menampilkan frasa ini secara menonjol. Pengembang tidak memegang merek dagang atau hak cipta atas Nama Proyek.',
    'infoCollection' => [
      'heading' => 'Pengumpulan dan Penggunaan Informasi',
      'pii' => 'Saat menggunakan Proyek ini, kami tidak meminta atau mendorong Anda untuk memberikan Informasi Identifikasi Pribadi ("PII", "Informasi Pribadi") apa pun yang dapat digunakan untuk mengidentifikasi Anda sebagai individu. PII dapat mencakup, tetapi tidak terbatas pada: nama Anda, tanggal lahir, nomor identifikasi nasional, lokasi, nomor telepon.',
      'auth' => 'Proses masuk disediakan menggunakan API OAuth 2 Discord ("API") yang juga diamankan menggunakan HTTPS. Selama proses autentikasi OAuth, Situs kami tidak menerima nama pengguna atau kata sandi, hanya token yang dapat digunakan untuk memverifikasi identitas pengguna menggunakan API ini. Untuk alasan kinerja, kami menyimpan informasi dasar yang diberikan oleh API (ID pengguna, nama pengguna saat ini, nama tampilan, tautan avatar) secara lokal.',
      'removal' => 'Informasi ini tidak dihapus dari basis data kami secara otomatis jika Anda menonaktifkan akun Discord Anda, jadi pastikan untuk menghubungi kami jika Anda ingin data Anda dihapus.',
    ],
    'logData' => [
      'heading' => 'Data Log',
      'browserInfo' => 'Kami mengumpulkan informasi yang dikirimkan oleh peramban Anda setiap kali Anda mengunjungi Situs kami ("Data Log"). Data Log ini dapat mencakup informasi seperti alamat IP komputer Anda, sistem operasi, jenis browser, versi browser, halaman Situs kami yang Anda kunjungi, waktu dan tanggal kunjungan Anda.',
      'thirdParty' => 'Data Log ini hanya disimpan di dalam server kami dan tidak dibagikan kepada pihak ketiga mana pun. Data Log digunakan untuk tujuan diagnostik, dan dibagikan kepada lembaga penegak hukum jika diminta secara eksplisit. Data tersebut disimpan hingga 14 hari dan akan dihapus setelahnya.',
      'debugging' => 'Bot dapat menerima interaksi dari Pengguna melalui klien Discord, yang mencakup perintah slash dan perintah menu konteks ("Aksi", "Perintah", atau secara kolektif "Perintah"). Perintah slash juga dapat dieksekusi dengan pasangan kunci-nilai terstruktur yang diberikan Pengguna ("Opsi"). Bot merekam eksekusi Perintah untuk tujuan debugging, yaitu: nama pengguna Discord dan pengidentifikasi Snowflake ("ID") dari Pengguna yang mengeksekusi Perintah, nama Perintah (termasuk semua Opsi) dan ID Server tempat Perintah dieksekusi. Data ini disimpan di server Proyek hingga 30 hari, dan hanya dapat diakses oleh Pengembang.',
      'noPii' => 'Saat menjalankan Perintah, Anda harus menghindari menyertakan Informasi Pribadi apa pun. Beberapa informasi mungkin masih tersimpan dalam Log Aplikasi kami, jadi harap hubungi kami menggunakan metode yang dijelaskan di akhir dokumen ini untuk memberi tahu kami jika intervensi kami diperlukan.',
    ],
    'telemetry' => [
      'heading' => 'Telemetri & Statistik',
      'statsCollection' => 'Untuk menilai penggunaan Bot dan dengan demikian mendorong keputusan pengembangan (misalnya, penambahan/penghapusan fitur), serangkaian data spesifik tentang Perintah dan penggunaannya dapat dikumpulkan ("Telemetri"). Informasi telemetri terbatas pada perintah dan opsi mana yang digunakan, dan kapan digunakan, tanpa informasi pengenal apa pun (oleh karena itu, informasi tersebut tidak pernah mencakup ID server atau pengguna, maupun nilai yang diberikan pengguna, dan sepenuhnya anonim). Telemetri disimpan tanpa batas waktu dan statistik yang diperoleh darinya dimaksudkan untuk ditampilkan dan dibagikan secara publik dalam bentuk agregat.',
      'telemetryOptOut' => 'Dengan menggunakan Proyek ini, Pengguna menyetujui pengumpulan Telemetri secara default. Jika Pengguna ingin menolak pengumpulan Telemetri, mereka dapat menunjukkan preferensi mereka melalui opsi yang sesuai di halaman <1/>.',
    ],
    'cookies' => [
      'heading' => 'Cookie',
      'intro' => 'Cookie adalah berkas berisi sejumlah kecil data. Cookie dikirim ke browser Anda dari situs web dan disimpan di hard drive komputer Anda.',
      'disable' => 'Kami menggunakan "cookie" untuk menyimpan informasi. Anda dapat menginstruksikan browser Anda untuk menolak semua cookie atau untuk memberi tahu saat cookie dikirim. Namun, jika Anda tidak menerima cookie, Anda mungkin tidak dapat menggunakan beberapa bagian dari Situs kami.',
      'session' => 'Bagi pengguna yang sudah masuk, cookie persisten digunakan untuk mengingat status masuk di seluruh sesi browser selama 30 hari. Jika Anda ingin berhenti diingat, Anda dapat keluar atau menghapus cookie yang ditetapkan oleh Situs kami.',
    ],
    'security' => [
      'heading' => 'Keamanan',
      'noGuarantee' => 'Keamanan Informasi Pribadi Anda penting bagi kami, tetapi ingatlah bahwa tidak ada metode transmisi melalui Internet, atau metode penyimpanan elektronik, yang 100% aman. Meskipun kami berupaya menggunakan cara-cara yang dapat diterima secara komersial untuk melindungi Informasi Pribadi Anda, kami tidak dapat menjamin keamanan absolutnya.',
      'httpsCloudFlare' => 'Situs ini menggunakan HTTPS dengan menggunakan rangkaian enkripsi TLS modern untuk melindungi integritas dan pengiriman data yang aman antara browser dan Situs kami. Namun, kami menggunakan layanan Cloudflare\'s Reverse Proxy, yang berarti sebagian data yang dikirim ke Situs kami melewati server mereka. CloudFlare beroperasi di bawah <1>kebijakan privasi</1>.',
      'breachNotify' => 'Jika terjadi pelanggaran keamanan, semua pengguna akan diberi tahu dalam waktu 24 jam setelah ditemukan melalui pemberitahuan yang diposting di situs web ini, dalam balasan yang diposting oleh Bot, dan melalui pengumuman di server dukungan Discord Bot.',
    ],
  ],
  'terms' => [
    'heading' => 'Syarat & Ketentuan',
    'license' => 'Seluruh kode sumber Proyek disediakan di GitHub apa adanya, tanpa jaminan atau tanggung jawab apa pun. Untuk ketentuan lisensi lengkap, silakan lihat <1>Lisensi MIT</1>, salinannya dapat ditemukan di setiap repositori. Ketentuan yang diuraikan di bawah ini berlaku untuk versi Proyek yang dihosting oleh Pengembang ("Instansi") dan batasan yang diberlakukan di dalamnya tidak boleh dianggap sebagai pembatasan penggunaan kode sumber Proyek.',
    'noAbuse' => 'Anda tidak boleh mengatur otomatisasi untuk menjalankan Perintah melalui Instance secara berulang. Bot ini tidak dimaksudkan untuk digunakan oleh alat otomatis, seperti bot lain, atau perangkat lunak lain yang dirancang untuk meniru aktivitas pengguna yang sah. Alih-alih mengandalkan output Bot kami untuk tujuan otomatisasi, silakan merujuk ke dokumentasi bahasa pemrograman yang digunakan oleh bot Anda tentang cara menghasilkan dan memanipulasi stempel waktu UNIX.',
    'fuckWeb3' => 'Instans ini tidak boleh digunakan untuk membantu proses pelatihan model AI generatif, maupun untuk membantu memfasilitasi peristiwa dan/atau transaksi apa pun yang terkait dengan token non-fungible ("NFT") atau bentuk mata uang kripto apa pun (misalnya Ethereum, Bitcoin).',
    'accessRevocation' => 'Akses Anda ke Instance dapat dicabut karena alasan apa pun (termasuk tanpa alasan) atas kebijakan Pengembang. Alasan tersebut dapat mencakup, tetapi tidak terbatas pada: pelanggaran terhadap ketentuan ini, penyalahgunaan fitur Instance secara sengaja, ancaman kekerasan terhadap Pengembang atau kontributor Proyek mana pun, penggunaan Instance untuk tujuan jahat.',
  ],
  'changes' => [
    'heading' => 'Perubahan & Revisi',
    'effectiveFrom' => 'Syarat & Ketentuan dan Kebijakan Privasi, secara kolektif disebut "Dokumen", berlaku sejak tanggal pembaruan terakhirnya dan akan tetap berlaku kecuali terdapat perubahan pada ketentuannya di masa mendatang, yang akan berlaku segera setelah diposting di halaman ini.',
    'rightToChange' => 'Kami berhak untuk memperbarui atau mengubah Dokumen ini kapan saja dan Anda harus memeriksa halaman ini secara berkala. Penggunaan Proyek secara berkelanjutan setelah kami memposting modifikasi apa pun pada Dokumen di halaman ini akan dianggap sebagai pengakuan Anda atas modifikasi tersebut dan persetujuan Anda untuk mematuhi dan terikat oleh Dokumen yang telah dimodifikasi.',
    'willNotify' => 'Jika kami melakukan perubahan material apa pun pada Dokumen ini, kami akan memberi tahu Anda dengan menempatkan pemberitahuan yang jelas di situs web kami, serta memposting pengumuman di server dukungan Discord Bot.',
  ],
  'contact' => [
    'heading' => 'Hubungi Kami',
    'whereToContact' => 'Jika Anda memiliki pertanyaan tentang Dokumen ini atau ingin meminta penghapusan PII (Informasi Identitas Pribadi) yang kami simpan, silakan hubungi kami melalui <1>server Discord Bot</1> atau menggunakan salah satu metode yang tercantum di <3>situs web Pengembang</3>.',
  ],
];
