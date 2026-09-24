<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Pengesahan kunci laluan',
            'below_content' => 'Gunakan kunci laluan (Face ID, Touch ID, Windows Hello, Android, kunci keselamatan) untuk mengesahkan identiti anda semasa log masuk. Tambah satu untuk setiap peranti yang anda gunakan untuk log masuk.',
            'messages' => [
                'enabled' => 'Diaktifkan',
                'disabled' => 'Dinyahaktifkan',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Kunci Laluan',
                'last_used_at' => 'Terakhir digunakan',
                'actions' => 'Tindakan',
            ],
            'never_used' => 'Tidak pernah',
        ],
    ],
    'login_form' => [
        'label' => 'Gunakan kunci laluan',
        'credential' => [
            'label' => 'kunci laluan',
            'messages' => [
                'invalid' => 'Kunci laluan tidak dapat disahkan. Sila cuba lagi.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Sahkan dengan kunci laluan',
            ],
        ],
    ],
];
