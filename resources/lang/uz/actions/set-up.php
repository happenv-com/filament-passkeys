<?php

return [
    'label' => 'Sozlash',
    'modal' => [
        'heading' => 'Kirish kaliti orqali tasdiqlashni sozlash',
        'description' => 'Ushbu qurilmada kirish kalitini ro\'yxatdan o\'tkazing. Sizdan barmoq izi, yuz, ekran qulfi yoki xavfsizlik kalitidan foydalanish so\'raladi. Ro\'yxatdan o\'tgandan so\'ng, ushbu kirish kaliti yordamida tizimga kira olasiz.',
        'form' => [
            'name' => [
                'label' => 'Kirish kaliti nomi',
                'placeholder' => 'masalan, MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Kirish kalitini ro\'yxatdan o\'tkazish',
            ],
            'errors' => [
                'failed' => 'Kirish kalitingizni ro\'yxatdan o\'tkazib bo\'lmadi. Iltimos, qaytadan urinib ko\'ring.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Kirish kaliti muvaffaqiyatli ro\'yxatdan o\'tkazildi',
        ],
    ],
];
