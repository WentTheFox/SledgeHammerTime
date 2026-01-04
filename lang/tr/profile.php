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
