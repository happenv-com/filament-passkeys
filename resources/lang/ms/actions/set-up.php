<?php

return [
    'label' => 'Tetapkan',
    'modal' => [
        'heading' => 'Tetapkan pengesahan kunci laluan',
        'description' => 'Daftarkan kunci laluan pada peranti ini. Anda akan diminta menggunakan cap jari, wajah, kunci skrin atau kunci keselamatan. Selepas pendaftaran, anda boleh log masuk menggunakan kunci laluan ini.',
        'form' => [
            'name' => [
                'label' => 'Nama kunci laluan',
                'placeholder' => 'cth. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Daftarkan kunci laluan',
            ],
            'errors' => [
                'failed' => 'Kami tidak dapat mendaftarkan kunci laluan anda. Sila cuba lagi.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Kunci laluan berjaya didaftarkan',
        ],
    ],
];
