<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Pengesahan kunci laluan',
            'below_content' => 'Gunakan kunci laluan pada peranti ini (Face ID, Touch ID, Windows Hello, kunci keselamatan) untuk mengesahkan identiti anda semasa log masuk.',
            'messages' => [
                'enabled' => 'Diaktifkan',
                'disabled' => 'Dinyahaktifkan',
            ],
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
