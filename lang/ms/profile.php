<?php

return [
  'title' => 'Profil',
  'intro' => 'Halaman profil membolehkan anda menguruskan maklumat akaun anda khususnya yang berkaitan dengan laman sesawang. Sekiranya anda mencari cara untuk mengubah nilai lalai dan tetapan lain untuk aplikasi Discord, lawati halaman <1>Tetapan Apl</1>.',
  'information' => [
    'heading' => 'Maklumat Profil',
    'description' => "Kemas kini maklumat profil akaun anda.",
    'displayName' => 'Nama Paparan',
    'hiddenFormats' => 'Format yang disembunyikan dari jadual pemungut',
    'saveSuccess' => 'Profil anda telah berjaya dikemas kini.',
  ],
  'accounts' => [
    'heading' => 'Akaun Tersambung',
    'description' => 'Anda boleh memautkan beberapa akaun anda ke akaun HammerTime anda untuk membolehkan pengurusan di satu tempat. Maklumat asas pengguna yang dipaparkan di sini dikemaskinikan secara automatik maksimum sejam sekali apabila anda memuatkan halaman ini.',
    'discord' => 'Akaun Discord',
    'crowdin' => 'Akaun Crowdin',
    'noConnectedAccounts' => 'Anda tidak mempunyai sebarang akaun yang tersambung ketika ini',
    'linkAdditional' => [
      'heading' => 'Pautkan Akaun Tambahan',
      'description' => 'Gunakan butang di bawah untuk menyambungkan akaun tembahan ke akaun HammerTime anda yang semasa.',
      'discord' => [
        'description' => 'Sekiranya gambar profil atau nama paparan anda berubah, anda juga boleh menggunakan butang ini untuk mengemaskinikan maklumat tersebut bagi sebarang akaun Discord yang sudah dipautkan.',
        'authorize' => 'Beri keizinan akaun Discord',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account lets you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Beri keizinan akaun Crowdin',
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
    'heading' => 'Pemadaman Akaun',
    'description' => 'Apabila akaun anda dipadamkan, kesemua sumber dan datanya akan dipadamkan secara kekal. Sebelum memadam akaun anda, sila muat turun sebarang data atau maklumat yang anda ingin simpan.',
    'deleteButton' => 'Padam Akaun',
    'confirmDialog' => [
      'header' => 'Adakah anda pasti anda ingin memadamkan akaun anda?',
      'body' => 'Apabila akaun anda dipadam, kesemua sumber dan datanya akan dipadamkan secara kekal.',
    ],
  ],
];
