<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Pag-verify gamit ang passkey',
            'below_content' => 'Gumamit ng passkey sa device na ito (Face ID, Touch ID, Windows Hello, security key) para i-verify ang pagkakakilanlan mo sa pag-log in.',
            'messages' => [
                'enabled' => 'Naka-enable',
                'disabled' => 'Naka-disable',
            ],
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
