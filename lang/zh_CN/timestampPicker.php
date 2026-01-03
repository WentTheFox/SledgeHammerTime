<?php

return [
  'howTo' => '选择一个日期，从 :syntaxColName 列复制想要的时间戳代码，然后粘贴到 Discord 消息中。在聊天消息中，该时间戳会动态地根据每个用户的时区更改显示的时间。',
  'picker' => [
    'label' => [
      'date' => '日期',
      'time' => '时间',
      'dateAndTime' => '日期与时间',
      'timezone' => '时区',
      'naturalLanguageInput' => '@time input',
      'modeOffset' => 'Absolute Offset',
      'modeZoneName' => 'Zone Name',
    ],
    'button' => [
      'jumpToToday' => 'Jump to current month',
    ],
    'tooltip' => [
      'setToCurrent' => '设为当前时间',
      'lock' => '通过 URL 锁定时间戳',
      'unlock' => '解锁时间戳',
      'previousYear' => 'Previous year',
      'previousMonth' => 'Previous month',
      'nextMonth' => 'Next month',
      'nextYear' => 'Next year',
    ],
    'validation' => [
      'naturalLanguageParseError' => 'Could not parse natural language input'
    ]
  ],
  'table' => [
    'syntaxColumn' => '代码语法',
    'resultColumn' => '示例显示效果',
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
      'header' => 'HammerTime Old Website',
      'p' => 'The old website of the project, still available until this Beta goes live',
    ],
    'textColor' => [
      'header' => 'Rebane 的<1>彩色</1>文本生成器',
      'p' => '一个简单的应用，使用 ANSI 颜色代码创建带颜色文本的 Discord 消息',
    ],
    "subreddit" => [
      "header" => "r/SplitSecond",
      "p" => "这个Reddit社群讨论一款好玩不火的赛车游戏，其举办的每周挑战赛是本项目的创作灵感",
    ],
  ],
];
