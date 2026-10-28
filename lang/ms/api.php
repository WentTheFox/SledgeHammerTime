<?php

return [
  'heading' => 'Capaian API',
  'description' => 'Jana cap masa dan ubah tetapan aplikasi anda daripada atur cara anda sendiri. Setiap titik akhir sepadan dengan perintah aplikasi, dan permintaan mengikut tetapan akaun Discord yang mana kuncinya telah diciptakan.',
  'overview' => [
    'baseUrl' => 'URL asas',
    'reference' => 'Rujukan Interaktif',
    'spec' => 'Spesifikasi OpenAPI',
  ],
  'keys' => [
    'loginPrompt' => 'Log masuk untuk mencipta kunci API. Kunci bertindak sebagai salah satu akaun Discord yang dipautkan pada profil anda.',
  ],
  'usage' => [
    'heading' => 'Menggunakan API',
    'authentication' => 'Hantar kunci anda sebagai token pembawa dalam pengepala Authorization bagi setiap permintaan.',
    'example' => 'Permintaan ini mengembalikan cap masa bagi jam 18:30 hari ini dalam zon masa yang anda simpan. Kunci dalam contoh ini dibuat-buat, gunakan kunci anda sendiri:',
    'limits' => 'Permintaan mempunyai had perkadaran bagi setiap kunci. Pengepala RateLimit bagi setiap sambutan memberitahu anda di manakah kedudukan anda, dan sambutan 429 didatangkan dengan pengepala Retry-After.',
    'statistics' => 'Runs are counted like app commands, and the reply says which run it was, unless you turned telemetry off in your app settings.',
  ],
  'permissions' => [
    'heading' => 'Keizinan',
    'description' => 'Suatu kunci mempunyai keizinan yang diberikan semasa ia dicipta, dan baki halaman ini merujuk keizinan tersebut menggunakan kod-kod ini.',
    'me' => 'Setiap kunci boleh panggil <1/>, tanpa mengira keizinannya, untuk mengetahui keizinan apa yang kunci tersebut ada.',
    'columns' => [
      'permission' => 'Keizinan',
      'allows' => 'Membolehkan',
    ],
    'scopes' => [
      'timestamps:create' => 'Menjana cap masa menggunakan titik akhir cap masa dan alatan MCP, sebagai akaun Discord yang kunci tersebut bertindak.',
      'settings:read' => 'Membaca tetapan aplikasi bagi akaun tersebut.',
      'settings:write' => 'Mengubah tetapan aplikasi bagi akaun tersebut, hanya bagi medan yang dihantar.',
    ],
  ],
  'reference' => [
    'heading' => 'Rujukan titik akhir',
    'description' => 'Setiap titik akhir dengan medan yang diterima dan sambutan yang diberi. Maklumat ini dibaca dari spesifikasi OpenAPI milik pelayan API, jadi ia sentiasa sepadan dengan versi yang dijalankan.',
    'errors' => 'Ralat',
    'errorsDescription' => 'Every error response has this body. The status code tells what kind of error it is, and error.code the exact reason.',
    'optional' => 'pilihan',
    'unavailable' => 'Rujukan tidak dapat dimuatkan ketika ini. Rujukan interaktif mempunyai maklumat yang sama.',
    'permission' => 'Keizinan',
    'anyKey' => 'Sebarang kunci yang sah',
    'noKey' => 'Tiada kunci diperlukan',
    'requestBody' => 'Kandungan permintaan (JSON)',
    'responses' => 'Sambutan',
    'nullable' => 'Can be null',
  ],
  'mcp' => [
    'heading' => 'Menggunakan pelayan MCP',
    'description' => 'Pelayan MCP menggunakan pengangkutan Streamable HTTP serta kunci yang sama. Ia menawarkan satu alatan bagi setiap perintah berserta tetapannya, dan hanya alatan yang dibenarkan oleh keizinan kunci anda.',
    'url' => 'URL pelayan',
    'placeholderKey' => 'Kunci dalam contoh di bawah ini dibuat-buat, ia tidak akan berfungsi. Gantikannya dengan salah satu kunci anda sendiri.',
    'claudeCode' => 'Tambahkannya ke Claude Code dengan:',
    'otherClients' => 'Klien lain menggunakan tatarajah yang serupa, dengan URL dan pengepala Authorization:',
  ],
];
