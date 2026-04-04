<?php

return [
  'title' => 'Profil',
  'intro' => 'Profil sayfası, özellikle web sitesiyle ilgili hesap bilgilerinizi yönetmenizi sağlar. Discord uygulamasına ait varsayılanları ve diğer ayarları değiştirmek istiyorsanız, <1>Uygulama Ayarları</1> sayfasını ziyaret edin.',
  'information' => [
    'heading' => 'Profil Bilgileri',
    'description' => "Hesabınızın profil bilgilerini güncelleyin.",
    'displayName' => 'Görünen Ad',
    'hiddenFormats' => 'Seçici tablosundan gizlenen biçimler',
    'saveSuccess' => 'Profiliniz başarıyla güncellendi.',
  ],
  'accounts' => [
    'heading' => 'Bağlı Hesaplar',
    'description' => 'Tek bir yerden yönetebilmek için HammerTime hesabınıza birden fazla hesap bağlayabilirsiniz. Burada görüntülenen temel kullanıcı bilgileri, bu sayfayı yüklediğinizde saatte en fazla bir kez otomatik olarak güncellenir.',
    'discord' => 'Discord Hesapları',
    'crowdin' => 'Crowdin Hesapları',
    'noConnectedAccounts' => 'Şu anda bağlı bir hesabınız yok',
    'linkAdditional' => [
      'heading' => 'Ek Hesaplar Bağlayın',
      'description' => 'Mevcut HammerTime hesabınıza ek hesaplar bağlamak için aşağıdaki düğmeleri kullanın.',
      'discord' => [
        'description' => 'Profil resminiz veya görünen adınız değiştiyse, halihazırda bağlı olan herhangi bir Discord hesabındaki bu bilgileri güncellemek için de bunu kullanabilirsiniz.',
        'authorize' => 'Discord hesabını yetkilendir',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account lets you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Crowdin hesabını yetkilendir',
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
    'heading' => 'Hesap Silme',
    'description' => 'Hesabınız silindiğinde, tüm kaynakları ve verileri kalıcı olarak silinecektir. Hesabınızı silmeden önce, lütfen saklamak istediğiniz tüm veri veya bilgileri indirin.',
    'deleteButton' => 'Hesabı Sil',
    'confirmDialog' => [
      'header' => 'Hesabınızı silmek istediğinizden emin misiniz?',
      'body' => 'Hesabınız silindiğinde, tüm kaynakları ve verileri kalıcı olarak silinecektir.',
    ],
  ],
];
