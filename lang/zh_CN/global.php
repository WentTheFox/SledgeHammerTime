<?php

return [
  'seoDescription' => '为 Discord 聊天消息生成时间戳',
  'changeLanguage' => '更改语言',
  "notFound" => [
    "heading" => "页面不存在",
    "content" => "这里空无一物。",
  ],
  "maintenanceMode" => [
    "heading" => "Maintenance Mode",
    "content" => [
      'pleaseWait' => "The application is currently being updated, please try again in a few seconds.",
      'joinSupportServer' => "If the issue persists for more than a few minutes, please join the Discord support server and let us know.",
      'contactDeveloper' => "If the issue persists for more than a few minutes, please contact the developer and let them know.",
    ],
    "supportServerButton" => "Support Server",
  ],
  'incompleteTranslations' => '翻译内容不完整',
  'contributeTranslations' => '参与贡献',
  'copyToClipboard' => '复制到剪切板',
  'copiedToClipboard' => '已复制到复制到剪切板！',
  'jsDisabled' => [
    'title' => '需要启用 JavaScript',
    'body' => "您的浏览器不支持 JavaScript 或当前已禁用了该功能。部分浏览器出于安全考虑会默认禁用 JavaScript，但本应用需启用 JavaScript 才能正常运行。请启用后刷新页面，或更换其他浏览器。",
  ],
  'nav' => [
    'botSettings' => 'App 设置',
    'profile' => '个人资料',
    'legal' => '法律信息',
  ],
  'sidebar' => [
    'inputSettings' => [
      'title' => '输入设置',
      'customDateInput' => [
        'label' => 'Custom date input',
        'description' => "Replace the browser default date input with a custom one.",
      ],
      'customTimeInput' => [
        'label' => 'Custom time input',
        'description' => "Replace the browser default time input with a custom one. This is especially useful if you have trouble selecting the time on mobile browsers.",
      ],
      'separateInputs' => [
        'label' => '独立输入',
        'description' => "分别显示日期和时间的独立输入框，而非合并显示（部分浏览器不支持此功能）",
      ],
      'flatUi' => [
        'label' => 'Flatten interface',
        'description' => "Disable shadow and height effects on inputs and buttons",
      ],
    ],
    'timeSync' => [
      'title' => 'Time Synchronization',
      'status' => [
        'syncing' => 'Your system clock is currently being synchronized with our servers, please wait.',
        'accurate' => 'Your system clock is accurate.',
        'potentiallyWrong' => 'Your system clock might be wrong.',
        'value' => 'The difference between the local and server time is :offset.',
      ],
      'autoTimeSync' => [
        'label' => 'Apply server time offset to calculations (beta)',
        'description' => 'If your system clock is over :offset off compared to the server time (excluding timezone differences), some time calculations will be adjusted to take this into account, so your timestamps will be less likely to be incorrect. <1>This is an experimental feature, use with caution!</1> Synchronization happens when the page is first loaded, and immediately after the setting is turned on.',
      ],
      'details' => '细节',
      'autoApplyCheckbox' => 'Apply calculated offset to DateTime library when pressing :syncButtonLabel manually (only applies if the difference is above the :offset threshold)',
      'syncButtonLabel' => 'Synchronize',
      'resetOffsetButtonLabel' => 'Reset applied offset',
      'roundTripDuration' => 'Round-trip duration',
      't0' => 'The client\'s timestamp of the request transmission',
      't1' => 'The server\'s timestamp of the request reception',
      't2' => 'The server\'s timestamp of the response transmission',
      't3' => 'The client\'s timestamp of the response reception',
      'dtlOffsetCell' => 'Active Calculation Offset',
      'timestampValue' => ':value s',
      'offsetAmount' => ':offset ms',
      'networkOffsetCell' => 'Detected Offset (via Network)',
    ],
    'localSettings' => [
      'title' => '本地设置',
    ],
    'credits' => [
      'title' => '鸣谢',
      'developedBy' => '开发者 <1></1>',
      'using' => '使用 <1></1>',
      'fontAwesomeFree' => 'Font Awesome 免费版',
      'laravel' => 'Laravel',
      'vueJs' => 'Vue.js',
      'dateFns' => 'date-fns',
      'vueTippy' => 'VueTippy',
      'translatedBy' => '翻译者 <1></1>',
      'openSourceSoftware' => '开源软件',
      'viewSourceCode' => '查看源代码',
      'notAffiliated' => '此项目不隶属于 Discord。',
    ],
    'themeButton' => [
      'dark' => 'Dark Theme',
      'light' => 'Light Theme',
      'system' => 'Use System Theme',
    ],
  ],
  'designEditor' => [
    'title' => '设计编辑器',
    'description' => '您可以通过下方表格中的输入项调整网站外观的多个方面。变量名基于代码中的标识符，因此无法进行翻译。刷新页面时，所有键值都将被重置。',
    'designPageLink' => '设计页面',
    'exportInfo' => '您可以将修改导出至 UserStyle 文件，通过<1>Stylus</1>等扩展程序实现应用外观的永久自定义。请注意：相关变量可能随时发生变更，届时需手动更新自定义样式。',
    'export' => '导出为 UserStyle',
    'variableColumnHeader' => 'CSS 变量',
    'valueColumnHeader' => '价值',
  ],
];
