<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Тасдиқ бо passkey',
            'below_content' => 'Барои тасдиқи шахсияти худ ҳангоми воридшавӣ аз passkey (Face ID, Touch ID, Windows Hello, Android, калиди амниятӣ) истифода баред. Барои ҳар дастгоҳе, ки аз он ворид мешавед, якто илова кунед.',
            'messages' => [
                'enabled' => 'Фаъол',
                'disabled' => 'Ғайрифаъол',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'Истифодаи охирин',
                'actions' => 'Амалҳо',
            ],
            'never_used' => 'Ҳеҷ гоҳ',
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
