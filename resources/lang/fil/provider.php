<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Pag-verify gamit ang passkey',
            'below_content' => 'Gumamit ng passkey (Face ID, Touch ID, Windows Hello, Android, security key) para i-verify ang pagkakakilanlan mo sa pag-log in. Magdagdag ng isa para sa bawat device na ginagamit mong mag-sign in.',
            'messages' => [
                'enabled' => 'Naka-enable',
                'disabled' => 'Naka-disable',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'Huling ginamit',
                'actions' => 'Mga Aksyon',
            ],
            'never_used' => 'Hindi Pa',
        ],
    ],
    'login_form' => [
        'label' => 'Gumamit ng passkey',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'Hindi ma-verify ang passkey. Pakisubukan ulit.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'I-verify gamit ang passkey',
            ],
        ],
    ],
];
