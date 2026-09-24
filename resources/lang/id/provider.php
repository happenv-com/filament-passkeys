<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikasi kunci sandi',
            'below_content' => 'Gunakan kunci sandi (Face ID, Touch ID, Windows Hello, Android, kunci keamanan) untuk memverifikasi identitas Anda saat login. Tambahkan satu untuk setiap perangkat yang Anda gunakan untuk masuk.',
            'messages' => [
                'enabled' => 'Aktif',
                'disabled' => 'Nonaktif',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Kunci sandi',
                'last_used_at' => 'Terakhir digunakan',
                'actions' => 'Tindakan',
            ],
            'never_used' => 'Tidak pernah',
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
