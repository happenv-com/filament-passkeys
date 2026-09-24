<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Kirish kaliti orqali tasdiqlash',
            'below_content' => 'Tizimga kirishda shaxsingizni tasdiqlash uchun ushbu qurilmadagi kirish kalitidan (Face ID, Touch ID, Windows Hello, Android, xavfsizlik kaliti) foydalaning. Tizimga kiradigan har bir qurilma uchun bittadan qo\'shing.',
            'messages' => [
                'enabled' => 'Yoqilgan',
                'disabled' => 'O\'chirilgan',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Kirish kaliti',
                'last_used_at' => 'Oxirgi foydalanish',
                'actions' => 'Amallar',
            ],
            'never_used' => 'Hech qachon',
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
