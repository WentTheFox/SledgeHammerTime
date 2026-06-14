<?php

return [
  'heading' => '页面浏览分析',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => '数据在服务器端收集，基于发送给特定一组页面的响应。页面浏览量会被逐条记录，随后由后台进程按日进行汇总。',
  'lastUpdated' => '为减少服务器负载，本页面上的信息会在短期内缓存。您所看到的数据最后更新于<1/> 。',
  'charts' => [
    'dailyTotal' => '每日页面总浏览量',
    'breakdown' => '访问量构成分析',
    'byPage' => '按页面分类',
    'byLanguage' => '按语言分类',
  ],
  'values' => [
    'unknown' => '未知',
  ],
];
