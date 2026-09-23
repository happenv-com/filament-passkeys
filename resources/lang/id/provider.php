<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikasi kunci sandi',
            'below_content' => 'Gunakan kunci sandi di perangkat ini (Face ID, Touch ID, Windows Hello, kunci keamanan) untuk memverifikasi identitas Anda saat login.',
            'messages' => [
                'enabled' => 'Aktif',
                'disabled' => 'Nonaktif',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Gunakan kunci sandi',
        'credential' => [
            'label' => 'kunci sandi',
            'messages' => [
                'invalid' => 'Kunci sandi tidak dapat diverifikasi. Silakan coba lagi.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verifikasi dengan kunci sandi',
            ],
        ],
    ],
];
