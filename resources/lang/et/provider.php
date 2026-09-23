<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Pääsuvõtmega kinnitamine',
            'below_content' => 'Kasutage selle seadme pääsuvõtit (Face ID, Touch ID, Windows Hello, turvavõti), et sisselogimisel oma identiteeti kinnitada.',
            'messages' => [
                'enabled' => 'Lubatud',
                'disabled' => 'Keelatud',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Kasutage pääsuvõtit',
        'credential' => [
            'label' => 'pääsuvõti',
            'messages' => [
                'invalid' => 'Pääsuvõtit ei õnnestunud kinnitada. Palun proovige uuesti.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Kinnita pääsuvõtmega',
            ],
        ],
    ],
];
