<?php

return [
  'howTo' => '选择一个日期，从 :syntaxColName 列复制想要的时间戳代码，然后粘贴到 Discord 消息中。在聊天消息中，该时间戳会动态地根据每个用户的时区更改显示的时间。',
  'picker' => [
    'label' => [
      'date' => '日期',
      'time' => '时间',
      'dateAndTime' => '日期与时间',
      'timezone' => '时区',
      'naturalLanguageInput' => '@time 输入',
      'modeOffset' => '绝对偏移量',
      'modeZoneName' => '时区名字',
    ],
    'button' => [
      'jumpToToday' => '跳转到当前月份',
      'contextRange' => '<0/>–<2/>',
    ],
    'tooltip' => [
      'setToCurrent' => '设为当前时间',
      'lock' => '通过 URL 锁定时间戳',
      'unlock' => '解锁时间戳',
      'previousYear' => '上一年',
      'previousMonth' => '上个月',
      'previousDecade' => '上一个十年',
      'nextMonth' => '下个月',
      'nextYear' => '下一年',
      'nextDecade' => '下一个十年',
    ],
    'validation' => [
      'naturalLanguageParseError' => '无法解析自然语言输入'
    ]
  ],
  'table' => [
    'syntaxColumn' => '代码语法',
    'resultColumn' => '示例显示效果',
    'editFormats' => '自定义格式排列方式',
    'resetFormats' => '重置为默认值',
    'hideFormat' => '隐藏此格式',
    'showFormat' => '显示此格式',
    'unhideInProfile' => '在个人资料设置中取消隐藏',
  ],
  'faq' => [
    'title' => '常见问题解答',
    'description' => '本节目前仅提供英文版本，内容很大程度上基于<1>我们Discord服务器</1>上的讨论。若非成员，部分链接可能无法正常访问。',
  ],
  'usefulLinks' => [
    'lead' => '也许您也想看看这些链接：',
    'server' => [
      'header' => '官方 HammerTime 服务器',
      'p' => '讨论本网站，测试语法，提出建议',
    ],
    'bot' => [
      'header' => 'HammerTime App',
      'p' => '使用斜杠指令在 Discord 内生成时间戳',
    ],
    'oldSite' => [
      'header' => 'HammerTime 旧网站',
      'p' => '该项目的旧网站，在另行通知前仍可使用',
    ],
    'textColor' => [
      'header' => 'Rebane 的<1>彩色</1>文本生成器',
      'p' => '一个简单的应用，使用 ANSI 颜色代码创建带颜色文本的 Discord 消息',
    ],
    "subreddit" => [
      "p" => "这个Reddit社群讨论一款好玩不火的赛车游戏，其举办的每周挑战赛是本项目的创作灵感",
    ],
    'competitors' => [
      'lead' => [
        'p1' => '你是否知道 HammerTime 并不是唯一能生成时间戳的工具？',
        'p2' => '你可能会想看看这些其他的 Discord 时间戳生成器，找到最适合你的那一个：',
      ],
      '3vfi' => [
        'header' => '',
        'p' => '由 3ventic 制作的简易快速时间戳生成器',
      ],
      'dabric' => [
        'header' => '',
        'p' => '由 dabric 制作的自然语言 Discord 时间戳生成器',
      ],
      'discordtimestampCom' => [
        'p' => '由 Sellframe Ltd. 提供的免费 Discord 时间戳生成器，支持本地时区。',
      ],
      'discordtimestampOrg' => [
        'p' => 'Discord 时间戳生成器与时间转换器，来自 DiscordTimestamp.org',
      ],
      'sesh' => [
        'p' => '由 Tunks 开发，可通过 Sesh 日程安排机器人生态创建 Discord Markdown 时间戳',
      ],
    ],
  ],
];
