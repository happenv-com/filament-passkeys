<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'การยืนยันตัวตนด้วยพาสคีย์',
            'below_content' => 'ใช้พาสคีย์บนอุปกรณ์นี้ (Face ID, Touch ID, Windows Hello, คีย์ความปลอดภัย) เพื่อยืนยันตัวตนของคุณระหว่างการเข้าสู่ระบบ',
            'messages' => [
                'enabled' => 'เปิดใช้งานแล้ว',
                'disabled' => 'ปิดใช้งานแล้ว',
            ],
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
