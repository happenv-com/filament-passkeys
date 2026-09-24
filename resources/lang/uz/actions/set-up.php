<?php

return [
    'label' => 'Sozlash',
    'add_label' => 'Kirish kalitini qo\'shish',
    'modal' => [
        'heading' => 'Kirish kaliti orqali tasdiqlashni sozlash',
        'add_heading' => 'Kirish kalitini qo\'shish',
        'description' => 'Ushbu qurilmada kirish kalitini ro\'yxatdan o\'tkazing. Sizdan barmoq izi, yuz, ekran qulfi yoki xavfsizlik kalitidan foydalanish so\'raladi. Ro\'yxatdan o\'tgandan so\'ng, ushbu kirish kaliti yordamida tizimga kira olasiz.',
        'form' => [
            'name' => [
                'label' => 'Kirish kaliti nomi',
                'placeholder' => 'masalan, MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Ixtiyoriy. Uni qurilmangiz yoki parol menejeringiz nomi bilan nomlash uchun bo\'sh qoldiring.',
                'default' => 'Kirish kaliti',
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
        'already_registered' => [
            'title' => 'Bu qurilmada allaqachon kirish kaliti mavjud',
            'body' => 'Hisobingiz uchun kirish kaliti allaqachon shu qurilmada yoki parol menejerida saqlangan. Buning o\'rniga boshqa qurilmadan qo\'shing.',
        ],
    ],
];
