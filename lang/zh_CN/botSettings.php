<?php

return [
  'title' => 'App 设置',
  'description' => '在下面您可以看到每个连接帐户在 HammerTime Bot 中的当前设置。',
  'learnMore' => '不了解该应用功能或想探索更多用法？访问<1>Discord应用</1>链接以获取详细信息。',
  'advancedSettings' => [
    'toggleText' => '高级设置',
  ],
  'defaultOption' => '默认',
  'fields' => [
    'timezone' => [
      'displayName' => '时区',
    ],
    'format' => [
      'displayName' => '格式',
    ],
    'formatMinimalReply' => [
      'displayName' => 'Preview-only reply when using format option',
    ],
    'columns' => [
      'displayName' => '列',
    ],
    'ephemeral' => [
      'displayName' => '仅自己可见',
    ],
    'header' => [
      'displayName' => '表头',
    ],
    'boldPreview' => [
      'displayName' => '将预览设置为粗体',
    ],
    'defaultAtHour' => [
      'displayName' => '/:atCommandName 命令的默认 ":hourOptionName" 选项',
    ],
    'defaultAtMinute' => [
      'displayName' => '/:atCommandName command 命令的默认 ":minuteOptionName" 选项',
    ],
    'defaultAtSecond' => [
      'displayName' => '/:atCommandName command 命令的默认 ":secondOptionName" 选项',
    ],
    'telemetry' => [
      'displayName' => '允许收集遥测数据',
      'explanation' => '此功能为可选配置，不影响机器人核心功能的使用。详细信息请访问<1/>说明页面。',
    ],
    'defaultAt12Hour' => [
      'displayName' => 'Default ":hourOptionName" option for /:at12CommandName command',
    ],
  ],
  'saveSuccess' => '您的设置已成功保存。',
];
