<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Підтвердження ключем доступу',
            'below_content' => 'Використовуйте ключ доступу на цьому пристрої (Face ID, Touch ID, Windows Hello, ключ безпеки) для підтвердження особи під час входу.',
            'messages' => [
                'enabled' => 'Увімкнено',
                'disabled' => 'Вимкнено',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Використати ключ доступу',
        'credential' => [
            'label' => 'ключ доступу',
            'messages' => [
                'invalid' => 'Не вдалося перевірити ключ доступу. Спробуйте ще раз.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Підтвердити ключем доступу',
            ],
        ],
    ],
];
