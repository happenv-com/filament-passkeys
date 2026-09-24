<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Geçiş anahtarı doğrulaması',
            'below_content' => 'Giriş sırasında kimliğinizi doğrulamak için bir geçiş anahtarı (Face ID, Touch ID, Windows Hello, Android, güvenlik anahtarı) kullanın. Giriş yaptığınız her cihaz için bir tane ekleyin.',
            'messages' => [
                'enabled' => 'Etkin',
                'disabled' => 'Devre dışı',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Geçiş anahtarı',
                'last_used_at' => 'Son kullanım',
                'actions' => 'İşlemler',
            ],
            'never_used' => 'Hiç',
        ],
    ],
    'login_form' => [
        'label' => 'Geçiş anahtarı kullan',
        'credential' => [
            'label' => 'geçiş anahtarı',
            'messages' => [
                'invalid' => 'Geçiş anahtarı doğrulanamadı. Lütfen tekrar deneyin.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Geçiş anahtarıyla doğrula',
            ],
        ],
    ],
];
