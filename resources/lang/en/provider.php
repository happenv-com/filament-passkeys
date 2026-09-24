<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Passkey verification',
            'below_content' => 'Use a passkey (Face ID, Touch ID, Windows Hello, Android, security key) to verify your identity during login. Add one for every device you sign in from.',
            'messages' => [
                'enabled' => 'Enabled',
                'disabled' => 'Disabled',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'Last used',
                'actions' => 'Actions',
            ],
            'never_used' => 'Never',
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
