<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Верификација приступним кључем',
            'below_content' => 'Користите приступни кључ (Face ID, Touch ID, Windows Hello, Android, сигурносни кључ) за верификацију идентитета приликом пријаве. Додајте по један за сваки уређај са ког се пријављујете.',
            'messages' => [
                'enabled' => 'Укључено',
                'disabled' => 'Искључено',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Приступни кључ',
                'last_used_at' => 'Последња употреба',
                'actions' => 'Радње',
            ],
            'never_used' => 'Никад',
        ],
    ],
    'login_form' => [
        'label' => 'Користите приступни кључ',
        'credential' => [
            'label' => 'приступни кључ',
            'messages' => [
                'invalid' => 'Приступни кључ није могуће верификовати. Покушајте поново.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Верификуј приступним кључем',
            ],
        ],
    ],
];
