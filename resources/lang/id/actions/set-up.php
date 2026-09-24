<?php

return [
    'label' => 'Aktifkan',
    'add_label' => 'Tambah kunci sandi',
    'modal' => [
        'heading' => 'Aktifkan verifikasi kunci sandi',
        'add_heading' => 'Tambahkan kunci sandi',
        'description' => 'Daftarkan kunci sandi di perangkat ini. Anda akan diminta menggunakan sidik jari, wajah, kunci layar, atau kunci keamanan. Setelah terdaftar, Anda dapat masuk menggunakan kunci sandi ini.',
        'form' => [
            'name' => [
                'label' => 'Nama kunci sandi',
                'placeholder' => 'mis. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opsional. Kosongkan untuk menamainya sesuai perangkat atau pengelola kata sandi Anda.',
                'default' => 'Kunci sandi',
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
        'already_registered' => [
            'title' => 'Perangkat ini sudah memiliki kunci sandi',
            'body' => 'Kunci sandi untuk akun Anda sudah tersimpan di perangkat atau pengelola kata sandi ini. Sebagai gantinya, tambahkan kunci sandi dari perangkat lain.',
        ],
    ],
];
