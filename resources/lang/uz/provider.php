<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Kirish kaliti orqali tasdiqlash',
            'below_content' => 'Tizimga kirishda shaxsingizni tasdiqlash uchun ushbu qurilmadagi kirish kalitidan (Face ID, Touch ID, Windows Hello, xavfsizlik kaliti) foydalaning.',
            'messages' => [
                'enabled' => 'Yoqilgan',
                'disabled' => 'O\'chirilgan',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Kirish kalitidan foydalanish',
        'credential' => [
            'label' => 'kirish kaliti',
            'messages' => [
                'invalid' => 'Kirish kalitini tasdiqlab bo\'lmadi. Iltimos, qaytadan urinib ko\'ring.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Kirish kaliti bilan tasdiqlash',
            ],
        ],
    ],
];
