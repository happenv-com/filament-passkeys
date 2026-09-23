<?php

return [
    'label' => 'Aktifkan',
    'modal' => [
        'heading' => 'Aktifkan verifikasi kunci sandi',
        'description' => 'Daftarkan kunci sandi di perangkat ini. Anda akan diminta menggunakan sidik jari, wajah, kunci layar, atau kunci keamanan. Setelah terdaftar, Anda dapat masuk menggunakan kunci sandi ini.',
        'form' => [
            'name' => [
                'label' => 'Nama kunci sandi',
                'placeholder' => 'mis. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Daftarkan kunci sandi',
            ],
            'errors' => [
                'failed' => 'Kami tidak dapat mendaftarkan kunci sandi Anda. Silakan coba lagi.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Kunci sandi berhasil didaftarkan',
        ],
    ],
];
