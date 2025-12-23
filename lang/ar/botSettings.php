<?php

return [
  'title' => 'إعدادات التطبيق',
  'description' => 'Below you can see your current settings in the HammerTime App for each connected account.',
  'learnMore' => 'Not sure what the app is or curious about what it can do? Visit the <1>Discord App</1> link to learn more.',
  'advancedSettings' => [
    'toggleText' => 'Advanced settings',
  ],
  'defaultOption' => 'افتراضي',
  'fields' => [
    'timezone' => [
      'displayName' => 'المنطقة الزمنية',
    ],
    'format' => [
      'displayName' => 'تنسيق',
    ],
    'formatMinimalReply' => [
      'displayName' => 'المعاينة-فقط الرد عند استخدام خيار التنسيق',
    ],
    'columns' => [
      'displayName' => 'أعمدة',
    ],
    'ephemeral' => [
      'displayName' => 'سريع الزوال',
    ],
    'header' => [
      'displayName' => 'رأس',
    ],
    'boldPreview' => [
      'displayName' => 'تنسيق المعاينة بخط عريض',
    ],
    'defaultAtHour' => [
      'displayName' => 'الخيار الافتراضي ":hourOptionName" للأمر /:atCommandName',
    ],
    'defaultAtMinute' => [
      'displayName' => 'خيار ":minuteOptionName" الافتراضي للأمر /:atCommandName',
    ],
    'defaultAtSecond' => [
      'displayName' => 'الخيار الافتراضي ":secondOptionName" لـ /:atcommandName الأمر',
    ],
    'telemetry' => [
      'displayName' => 'Allow Telemetry collection',
      'explanation' => 'This is entirely optional and has no effect your ability to use the bot. See the <1/> page for details.',
    ],
    'defaultAt12Hour' => [
      'displayName' => 'Default ":hourOptionName" option for /:at12CommandName command',
    ],
  ],
  'saveSuccess' => 'تم حفظ إعداداتك بنجاح.',
];
