<?php

return [
  'title' => 'الملف الشخصي',
  'intro' => 'The profile page allows you to manage your account information specifically related to the website. If you are looking for where to change defaults and other settings for the Discord app, visit the <1>App Settings</1> page.',
  'information' => [
    'heading' => 'معلومات الملف الشخصي',
    'description' => "تحديث معلومات الملف الشخصي لحسابك.",
    'displayName' => 'اسم العرض',
    'hiddenFormats' => 'Formats hidden from picker table',
    'saveSuccess' => 'تم تحديث ملفك الشخصي بنجاح.',
  ],
  'accounts' => [
    'heading' => 'الحسابات المتصلة',
    'description' => [
      'سيسمح لك حساب HammerTime بربط حسابات ديسكورد متعددة لتتمكن من إدارة مواردها في مكان واحد في المستقبل.',
      'يمكنك العثور أدناه على قائمة بجميع حسابات ديسكورد المرتبطة بحساب HammerTime هذا.',
    ],
    'discord' => 'Discord Accounts',
    'crowdin' => 'Crowdin Accounts',
    'noConnectedAccounts' => 'You do not have any accounts connected at the moment',
    'linkAdditional' => [
      'heading' => 'Link or Update Account',
      'description' => 'By linking multiple accounts to a single HammerTime account, you can manage all connected accounts\' settings in a single place.',
      'discord' => [
        'description' => 'If your profile picture or display name changed, you can also use this to update that information for any Discord account which is already linked.',
        'authorize' => 'Authorize Discord account',
      ],
      'crowdin' => [
        'description' => 'If you are a translator for the project, linking your Crowdin account will eventually let you customize how your name appears in the translation credits, and also serves as an extra level of verification that these accounts belong to you in case you join the project\'s Discord server.',
        'authorize' => 'Authorize Crowdin account',
      ],
    ],
  ],
  'deletion' => [
    'heading' => 'حذف الحساب',
    'description' => 'بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته بشكل دائم. قبل حذف حسابك، يرجى تنزيل أي بيانات أو معلومات ترغب في الاحتفاظ بها.',
    'deleteButton' => 'حذف الحساب',
    'confirmDialog' => [
      'header' => 'هل أنت متأكد أنك تريد حذف حسابك؟',
      'body' => 'بمجرد حذف حسابك، سيتم حذف جميع موارده وبياناته نهائيا.',
    ],
  ],
];
