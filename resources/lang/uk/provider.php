<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Підтвердження ключем доступу',
            'below_content' => 'Використовуйте ключ доступу (Face ID, Touch ID, Windows Hello, Android, ключ безпеки) для підтвердження особи під час входу. Додайте по одному для кожного пристрою, з якого ви входите.',
            'messages' => [
                'enabled' => 'Увімкнено',
                'disabled' => 'Вимкнено',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Ключ доступу',
                'last_used_at' => 'Востаннє використано',
                'actions' => 'Дії',
            ],
            'never_used' => 'Ніколи',
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
