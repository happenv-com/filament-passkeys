<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Pääsuvõtmega kinnitamine',
            'below_content' => 'Kasutage pääsuvõtit (Face ID, Touch ID, Windows Hello, Android, turvavõti), et sisselogimisel oma identiteeti kinnitada. Lisage üks iga seadme jaoks, millest sisse logite.',
            'messages' => [
                'enabled' => 'Lubatud',
                'disabled' => 'Keelatud',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Pääsuvõti',
                'last_used_at' => 'Viimati kasutatud',
                'actions' => 'Toimingud',
            ],
            'never_used' => 'Mitte kunagi',
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
