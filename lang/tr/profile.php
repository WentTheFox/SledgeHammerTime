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
    'description' => 'You can link multiple accounts to your HammerTime account to be able to manage them in one place. The basic user information displayed here is automatically updated at most once an hour when you load this page.',
    'discord' => 'Discord Hesapları',
    'crowdin' => 'Crowdin Hesapları',
    'noConnectedAccounts' => 'Şu anda bağlı bir hesabınız yok',
    'linkAdditional' => [
      'heading' => 'Link Additional Accounts',
      'description' => 'Use the buttons below to connect additional accounts to your current HammerTime account.',
      'discord' => [
        'description' => 'Profil resminiz veya görünen adınız değiştiyse, halihazırda bağlı olan herhangi bir Discord hesabındaki bu bilgileri güncellemek için de bunu kullanabilirsiniz.',
        'authorize' => 'Discord hesabını yetkilendir',
      ],
      'crowdin' => [
        'description' => 'Proje çevirmenlerinden biriyseniz, Crowdin hesabınızı bağlamak, ileride çeviri emeği geçenler listesinde isminizin nasıl görüneceğini özelleştirmenize olanak tanıyacaktır. Ayrıca bu işlem, projenin Discord sunucusuna katılmanız durumunda bu hesapların size ait olduğunu gösteren ek bir doğrulama düzeyi işlevi de görür.',
        'authorize' => 'Crowdin hesabını yetkilendir',
      ],
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
