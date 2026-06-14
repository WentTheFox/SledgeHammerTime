<?php

return [
  'heading' => 'สถิติการดูหน้าเว็บไซต์',
  'description' => 'This page contains basic analytics (both stored and displayed without any personally identifiable details) for aggregate total page views in the app over the last :days days.',
  'collectionMethod' => 'ข้อมูลถูกเก็บรวบรวมไว้ที่เซิร์ฟเวอร์ โดยอาศัยการตอบกลับจากชุดหน้าเว็บที่ถูกจำกัดไว้ จำนวนครั้งที่หน้าเว็บถูกดูจะถูกบันทึกไว้เป็นรายบุคคล แต่จะถูกรวบรวมเป็นรายวันทั้งหมดโดยระบบเบื้องหลังในเซิร์ฟเวอร์',
  'lastUpdated' => 'ข้อมูลบนหน้านี้ถูกเก็บไว้ชั่วคราวเพื่อลดภาระของเซิร์ฟเวอร์ ข้อมูลที่คุณเห็นได้รับการอัปเดตครั้งล่าสุดเมื่อ<1/>',
  'charts' => [
    'dailyTotal' => 'จำนวนการเข้าชมหน้าทั้งหมดต่อวัน',
    'breakdown' => 'แยกรายการยอดการดูหน้าเว็บ',
    'byPage' => 'แยกตามหน้า',
    'byLanguage' => 'แยกด้วยภาษา',
  ],
  'values' => [
    'unknown' => 'ไม่ทราบ',
  ],
];
