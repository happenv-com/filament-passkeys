<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Sarbide-gako bidezko egiaztapena',
            'below_content' => 'Erabili gailu honetako sarbide-gako bat (Face ID, Touch ID, Windows Hello, segurtasun-gakoa) saioa hastean zure identitatea egiaztatzeko.',
            'messages' => [
                'enabled' => 'Gaituta',
                'disabled' => 'Desgaituta',
            ],
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
