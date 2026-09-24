<?php

return [
    'label' => 'Tetapkan',
    'add_label' => 'Tambah kunci laluan',
    'modal' => [
        'heading' => 'Tetapkan pengesahan kunci laluan',
        'add_heading' => 'Tambahkan kunci laluan',
        'description' => 'Daftarkan kunci laluan pada peranti ini. Anda akan diminta menggunakan cap jari, wajah, kunci skrin atau kunci keselamatan. Selepas pendaftaran, anda boleh log masuk menggunakan kunci laluan ini.',
        'form' => [
            'name' => [
                'label' => 'Nama kunci laluan',
                'placeholder' => 'cth. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Pilihan sahaja. Biarkan kosong untuk menamakannya mengikut peranti atau pengurus kata laluan anda.',
                'default' => 'Kunci Laluan',
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
        'already_registered' => [
            'title' => 'Peranti ini sudah mempunyai kunci laluan',
            'body' => 'Kunci laluan untuk akaun anda sudah disimpan pada peranti ini atau pengurus kata laluan. Sebaliknya, tambah satu daripada peranti lain.',
        ],
    ],
];
