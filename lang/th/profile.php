<?php

return [
  'title' => 'โปรไฟล์',
  'intro' => 'หน้าโปรไฟล์ช่วยให้คุณจัดการข้อมูลบัญชีของคุณที่เกี่ยวข้องกับเว็บไซต์โดยเฉพาะ
หากคุณต้องการเปลี่ยนค่าพื้นฐานหรือการตั้งค่าอื่น ๆ สำหรับแอป Discord โปรดไปที่หน้า <1>การตั้งค่าแอป</1>',
  'information' => [
    'heading' => 'ข้อมูลโปรไฟล์',
    'description' => "อัปเดตข้อมูลโปรไฟล์บัญชีของคุณ",
    'displayName' => 'ชื่อที่ใช้แสดง',
    'hiddenFormats' => 'รูปแบบเวลาต่างๆ ที่ถูกซ่อนจากตารางตัวอย่าง',
    'saveSuccess' => 'โปรไฟล์ของคุณได้รับการอัปเดตเรียบร้อยแล้ว',
  ],
  'accounts' => [
    'heading' => 'บัญชีที่เชื่อมต่อ',
    'description' => 'คุณสามารถเชื่อมโยงบัญชีหลายบัญชีเข้ากับบัญชี HammerTime ของคุณได้เพื่อให้สามารถจัดการได้ในที่เดียว ข้อมูลผู้ใช้พื้นฐานที่แสดงไว้ที่นี่จะได้รับการอัปเดตโดยอัตโนมัติอย่างน้อยที่สุดหนึ่งครั้งต่อชั่วโมงเมื่อคุณโหลดหน้านี้',
    'discord' => 'บัญชี Discord',
    'crowdin' => 'บัญชี Crowdin',
    'noConnectedAccounts' => 'ขณะนี้คุณยังไม่มีบัญชีที่เชื่อมต่ออยู่',
    'linkAdditional' => [
      'heading' => 'เชื่อมโยงบัญชีเพิ่มเติม',
      'description' => 'ใช้ปุ่มด้านล่างเพื่อเชื่อมต่อบัญชีเพิ่มเติมกับบัญชี HammerTime ของคุณ',
      'discord' => [
        'description' => 'หากรูปโปรไฟล์หรือชื่อที่แสดงของคุณมีการเปลี่ยนแปลง คุณสามารถใช้ฟังก์ชันนี้เพื่ออัปเดตข้อมูลนั้นให้กับบัญชี Discord ใด ๆ ที่เชื่อมโยงไว้แล้วได้เช่นกัน',
        'authorize' => 'อนุญาตบัญชี Discord',
      ],
      'crowdin' => [
        'description' => 'หากคุณเป็นผู้แปลสำหรับโปรเจ็กต์นี้ การเชื่อมโยงบัญชี Crowdin ของคุณจะช่วยให้คุณสามารถปรับแต่งวิธีการแสดงชื่อของคุณในส่วนเครดิตของการแปลได้ในภายหลัง และยังทำหน้าที่เป็นระดับการยืนยันเพิ่มเติม เพื่อยืนยันว่าบัญชีเหล่านี้เป็นของคุณจริง หากคุณเข้าร่วมเซิร์ฟเวอร์ Discord ของโปรเจ็กต์',
        'authorize' => 'อนุญาตบัญชี Crowdin',
      ],
    ],
  ],
  'creditOverrides' => [
    'heading' => 'Translation Credits',
    'description' => 'Customize how you appear in the translation credits for each language where you are a contributor.',
    'displayName' => 'Display Name',
    'avatarProvider' => 'Avatar',
    'avatarProviders' => [
        'discord' => 'Discord',
        'gravatar' => 'Gravatar',
        'crowdin' => 'Crowdin',
    ],
    'gravatarEmail' => 'Email address',
    'gravatarDescription' => '<1>Gravatar</1> allows you to use a single avatar across multiple websites that support it. Your e-mail address will be saved as an MD5 hash.',
    'avatarAccount' => 'Account',
    'url' => 'Link',
    'visibility' => 'Visibility',
    'submit' => 'Submit for approval',
    'saveSuccess' => 'Submitted for approval',
    'saveHideSuccess' => 'Visibility updated',
    'cancel' => 'Cancel changes',
    'statusPrefix' => 'Status',
    'status' => [
      'approved' => 'Approved',
      'inReview' => 'In review',
      'rejected' => 'Rejected',
    ],
    'currentlyApproved' => 'Currently approved values',
    'reApprovalWarning' => 'Changing anything besides visibility will require a manual review. You can cancel the review request at any time from this page.',
    'deleteOverride' => 'Remove override',
    'deleteOverrideConfirm' => 'Are you sure you want to remove your translation credit override? Your entry will revert to the default information from Crowdin.',
    'approvedValues' => [
      'displayName' => 'Name',
      'avatarProvider' => 'Avatar provider',
      'avatarId' => 'Avatar ID',
      'url' => 'Profile URL',
      'visible' => 'Visible',
      'hidden' => 'Hidden',
    ],
  ],
  'deletion' => [
    'heading' => 'การลบบัญชี',
    'description' => 'เมื่อบัญชีของคุณถูกลบ ข้อมูลและทรัพยากรทั้งหมดที่เกี่ยวข้องกับบัญชีนั้นจะถูกลบอย่างถาวร ก่อนที่จะทำการลบบัญชี โปรดดาวน์โหลดข้อมูลหรือรายละเอียดใด ๆ ที่คุณต้องการเก็บไว้ก่อน',
    'deleteButton' => 'ลบบัญชีผู้ใช้',
    'confirmDialog' => [
      'header' => 'คุณแน่ใจหรือไม่ว่าต้องการลบบัญชีของคุณ?',
      'body' => 'เมื่อบัญชีของคุณถูกลบแล้ว ทรัพยากรและข้อมูลทั้งหมดจะถูกลบอย่างถาวร',
    ],
  ],
];
