<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'การยืนยันตัวตนด้วยพาสคีย์',
            'below_content' => 'ใช้พาสคีย์บนอุปกรณ์นี้ (Face ID, Touch ID, Windows Hello, Android, คีย์ความปลอดภัย) เพื่อยืนยันตัวตนของคุณระหว่างการเข้าสู่ระบบ เพิ่มพาสคีย์สำหรับทุกอุปกรณ์ที่คุณใช้เข้าสู่ระบบ',
            'messages' => [
                'enabled' => 'เปิดใช้งานแล้ว',
                'disabled' => 'ปิดใช้งานแล้ว',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'พาสคีย์',
                'last_used_at' => 'ใช้งานล่าสุด',
                'actions' => 'การดำเนินการ',
            ],
            'never_used' => 'ไม่เคยใช้งาน',
        ],
    ],
    'login_form' => [
        'label' => 'ใช้พาสคีย์',
        'credential' => [
            'label' => 'พาสคีย์',
            'messages' => [
                'invalid' => 'ไม่สามารถยืนยันพาสคีย์ได้ โปรดลองอีกครั้ง',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'ยืนยันด้วยพาสคีย์',
            ],
        ],
    ],
];
