<?php

return [
  'title' => 'Profil',
  'intro' => 'Halaman profil memungkinkan Anda mengelola informasi akun Anda yang khusus terkait dengan situs web. Jika Anda mencari tempat untuk mengubah pengaturan default dan pengaturan lainnya untuk aplikasi Discord, kunjungi halaman <1>Pengaturan Aplikasi</1>.',
  'information' => [
    'heading' => 'Informasi Profil',
    'description' => "Perbarui informasi profil akun Anda",
    'displayName' => 'Nama Tampilan',
    'hiddenFormats' => 'Format yang disembunyikan dari tabel pemilih',
    'saveSuccess' => 'Profil Anda telah berhasil diperbarui.',
  ],
  'accounts' => [
    'heading' => 'Akun Terhubung',
    'description' => 'Anda dapat menautkan beberapa akun ke akun HammerTime Anda agar dapat mengelolanya di satu tempat. Informasi pengguna dasar yang ditampilkan di sini diperbarui secara otomatis paling lambat satu kali per jam saat Anda memuat halaman ini.',
    'discord' => 'Akun Discord',
    'crowdin' => 'Akun Crowdin',
    'noConnectedAccounts' => 'Anda tidak memiliki akun yang terhubung saat ini',
    'linkAdditional' => [
      'heading' => 'Tautkan Akun Tambahan',
      'description' => 'Gunakan tombol di bawah ini untuk menghubungkan akun tambahan ke akun HammerTime Anda saat ini.',
      'discord' => [
        'description' => 'Jika gambar profil atau nama tampilan Anda berubah, Anda juga dapat menggunakan fitur ini untuk memperbarui informasi tersebut untuk akun Discord mana pun yang sudah terhubung.',
        'authorize' => 'Otorisasi akun Discord',
      ],
      'crowdin' => [
        'description' => 'Jika Anda adalah penerjemah untuk proyek ini, menautkan akun Crowdin Anda pada akhirnya akan memungkinkan Anda untuk menyesuaikan bagaimana nama Anda muncul dalam kredit terjemahan, dan juga berfungsi sebagai tingkat verifikasi tambahan bahwa akun-akun ini milik Anda jika Anda bergabung dengan server Discord proyek ini.',
        'authorize' => 'Otorisasi akun Crowdin',
      ],
    ],
  ],
  'creditOverrides' => [
    'heading' => 'Translation Credits',
    'description' => 'Customize how you appear in the translation credits for each language where you are a contributor.',
    'displayName' => 'Display Name',
    'avatarProvider' => 'Avatar',
    'avatarProviders' => [
        'discord' => 'Discord',
        'gravatar' => 'Gravatar',
        'crowdin' => 'Crowdin',
    ],
    'gravatarEmail' => 'Email address',
    'gravatarDescription' => '<1>Gravatar</1> allows you to use a single avatar across multiple websites that support it. Your e-mail address will be saved as an MD5 hash.',
    'avatarAccount' => 'Account',
    'url' => 'Link',
    'visibility' => 'Visibility',
    'submit' => 'Submit for approval',
    'saveSuccess' => 'Submitted for approval',
    'saveHideSuccess' => 'Visibility updated',
    'cancel' => 'Cancel changes',
    'statusPrefix' => 'Status',
    'status' => [
      'approved' => 'Approved',
      'inReview' => 'In review',
      'rejected' => 'Rejected',
    ],
    'currentlyApproved' => 'Currently approved values',
    'reApprovalWarning' => 'Changing anything besides visibility will require a manual review. You can cancel the review request at any time from this page.',
    'deleteOverride' => 'Remove override',
    'deleteOverrideConfirm' => 'Are you sure you want to remove your translation credit override? Your entry will revert to the default information from Crowdin.',
    'approvedValues' => [
      'displayName' => 'Name',
      'avatarProvider' => 'Avatar provider',
      'avatarId' => 'Avatar ID',
      'url' => 'Profile URL',
      'visible' => 'Visible',
      'hidden' => 'Hidden',
    ],
  ],
  'deletion' => [
    'heading' => 'Penghapusan Akun',
    'description' => 'Setelah akun Anda dihapus, semua sumber daya dan data di dalamnya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.',
    'deleteButton' => 'Hapus Akun',
    'confirmDialog' => [
      'header' => 'Apakah Anda yakin ingin menghapus akun Anda?',
      'body' => 'Setelah akun Anda dihapus, semua sumber daya dan data di dalamnya akan dihapus secara permanen.',
    ],
  ],
];
