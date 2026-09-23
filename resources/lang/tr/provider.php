<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Geçiş anahtarı doğrulaması',
            'below_content' => 'Giriş sırasında kimliğinizi doğrulamak için bu cihazdaki bir geçiş anahtarını (Face ID, Touch ID, Windows Hello, güvenlik anahtarı) kullanın.',
            'messages' => [
                'enabled' => 'Etkin',
                'disabled' => 'Devre dışı',
            ],
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
