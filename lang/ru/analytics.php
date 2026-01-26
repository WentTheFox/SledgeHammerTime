<?php

return [
  'heading' => 'Аналитика просмотров страниц',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last 30 days.',
  'collectionMethod' => 'Данные собираются на стороне сервера, основанного на ответах отправленных определённому набору страниц. Просмотры страниц записаны индивидуально, но собраны ежедневно фоновым процессом.',
  'lastUpdated' => 'The information on this page is cached for a short period to reduce server load. The data you see was last updated <1/>.',
  'charts' => [
    'dailyTotal' => 'Общие ежедневные просмотры страниц',
    'breakdown' => 'Разбивка отображения страниц',
    'byPage' => 'По страницам',
    'byLanguage' => 'По языкам',
    'hideUnknown' => 'Скрыть неизвестные значения',
  ],
  'values' => [
    'unknown' => 'Неизвестный',
  ],
];
