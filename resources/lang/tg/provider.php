<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Тасдиқ бо passkey',
            'below_content' => 'Барои тасдиқи шахсияти худ ҳангоми воридшавӣ аз passkey дар ин дастгоҳ (Face ID, Touch ID, Windows Hello, калиди амниятӣ) истифода баред.',
            'messages' => [
                'enabled' => 'Фаъол',
                'disabled' => 'Ғайрифаъол',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Passkey-ро истифода баред',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'Passkey тасдиқ карда нашуд. Лутфан бори дигар кӯшиш кунед.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Тасдиқ бо passkey',
            ],
        ],
    ],
];
