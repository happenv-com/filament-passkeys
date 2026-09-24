<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Sarbide-gako bidezko egiaztapena',
            'below_content' => 'Erabili gailu honetako sarbide-gako bat (Face ID, Touch ID, Windows Hello, Android, segurtasun-gakoa) saioa hastean zure identitatea egiaztatzeko. Gehitu bat saioa hasten duzun gailu bakoitzerako.',
            'messages' => [
                'enabled' => 'Gaituta',
                'disabled' => 'Desgaituta',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Sarbide-gakoa',
                'last_used_at' => 'Azken erabilera',
                'actions' => 'Ekintzak',
            ],
            'never_used' => 'Inoiz ez',
        ],
    ],
    'login_form' => [
        'label' => 'Erabili sarbide-gako bat',
        'credential' => [
            'label' => 'sarbide-gakoa',
            'messages' => [
                'invalid' => 'Ezin izan da sarbide-gakoa egiaztatu. Saiatu berriro.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Egiaztatu sarbide-gakoarekin',
            ],
        ],
    ],
];
