<?php

return [
  'howTo' => 'Bir tarih seçin, ":syntaxColName" sütunundan istediğiniz zaman damgasını kopyalayın ve ardından bunu mesajın herhangi bir yerine yapıştırın. Sonuç, herkes için kendi saat dilimine göre farklı görüntülenen dinamik bir zaman damgası olacaktır.',
  'picker' => [
    'label' => [
      'date' => 'Tarih',
      'time' => 'Zaman',
      'dateAndTime' => 'Tarih ve zaman',
      'timezone' => 'Zaman dilimi',
      'naturalLanguageInput' => '@time girişi',
      'modeOffset' => 'Mutlak Ofset',
      'modeZoneName' => 'Bölge Adı',
    ],
    'button' => [
      'jumpToToday' => 'Geçerli aya git',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => 'Geçerli zamana ayarla',
      'lock' => 'URL aracılığıyla zaman damgasını kilitle',
      'unlock' => 'Zaman damgasının kilidini aç',
      'previousYear' => 'Geçen yıl',
      'previousMonth' => 'Geçen ay',
      'previousDecade' => 'Geçmiş on yıl',
      'nextMonth' => 'Sonraki ay',
      'nextYear' => 'Gelecek yıl',
      'nextDecade' => 'Gelecek on yıl',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Doğal dil girişi çözümlenemedi'
    ]
  ],
  'table' => [
    'syntaxColumn' => 'Sohbet Görünümü',
    'resultColumn' => 'Örnek sonuç',
    'editFormats' => 'Biçimleri özelleştir',
    'resetFormats' => 'Varsayılanlara sıfırla',
    'hideFormat' => 'Bu biçimi gizle',
    'showFormat' => 'Bu biçimi göster',
    'unhideInProfile' => 'Profil ayarlarında gizliliği kaldır',
  ],
  'faq' => [
    'title' => 'Sıkça Sorulan Sorular',
    'description' => 'Bu bölüm şimdilik yalnızca İngilizcedir ve büyük ölçüde <1>Discord sunucumuzdaki</1> içeriklere dayanmaktadır. Üye olmadığınız sürece bazı bağlantılar beklendiği gibi çalışmayabilir.',
  ],
  'usefulLinks' => [
    'lead' => 'Bunları da faydalı bulabilirsiniz:',
    'server' => [
      'header' => 'Resmi HammerTime Sunucusu',
      'p' => 'Siteyi tartışın, zaman damgalarını test edin ve özellikler önerin',
    ],
    'bot' => [
      'header' => 'HammerTime Uygulaması',
      'p' => 'Slash komutlarını kullanarak Discord üzerinden zaman damgaları oluşturun',
    ],
    'oldSite' => [
      'header' => 'Eski HammerTime Sitesi',
      'p' => 'Projenin, bir sonraki duyuruya kadar hâlâ yayında olan eski sitesi',
    ],
    'textColor' => [
      'header' => 'Rebane\'in <1>Renkli</1> Metin Oluşturucusu',
      'p' => 'ANSI renk kodlarını kullanarak renkli Discord mesajları oluşturan basit bir uygulama',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "Bu projenin oluşturulmasına ilham veren, yeterince takdir edilmemiş bir yarış oyunu için haftalık meydan okumalara ev sahipliği yapan topluluk",
    ],
    'competitors' => [
      'lead' => [
        'p1' => 'Did you know that HammerTime is not the only tool for generating timestamps?',
        'p2' => 'You may want to check out these other Discord timestamp generators to find one that works best for you:',
      ],
      '3vfi' => [
        'header' => 'r.3v.fi/discord-timestamps',
        'p' => 'A simple and fast timestamp generator by 3ventic',
      ],
      'dabric' => [
        'header' => 'timestamp.dabric.xyz',
        'p' => 'Natural language Discord timestamp generator by dabric',
      ],
      'discordtimestampCom' => [
        'header' => 'DiscordTimestamp.com',
        'p' => 'Free Discord timestamp generator with local timezone support by Sellframe Ltd.',
      ],
      'discordtimestampOrg' => [
        'header' => 'DiscordTimestamp.org',
        'p' => 'Discord timestamp generator and time converter by DiscordTimestamp.org',
      ],
      'sesh' => [
        'header' => 'sesh.fyi/timestamp',
        'p' => 'Create Discord markdown timestamps from within the Sesh scheduling bot ecosystem by Tunks',
      ],
    ],
  ],
];
