<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Passkey verification',
            'below_content' => 'Use a passkey on this device (Face ID, Touch ID, Windows Hello, security key) to verify your identity during login.',
            'messages' => [
                'enabled' => 'Enabled',
                'disabled' => 'Disabled',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Use a passkey',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'The passkey could not be verified. Please try again.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verify with passkey',
            ],
        ],
    ],
];
