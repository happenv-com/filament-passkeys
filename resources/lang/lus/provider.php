<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Passkey verification',
            'below_content' => 'Login lai in nangmah ngei i nih finfiah nan passkey (Face ID, Touch ID, Windows Hello, Android, security key) hi hmang rawh. I lut na device tin atan pakhat belh rawh.',
            'messages' => [
                'enabled' => 'Enabled',
                'disabled' => 'Disabled',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'Hman Hnuhnung Ber',
                'actions' => 'Actions',
            ],
            'never_used' => 'Hman ngai lo',
        ],
    ],
    'login_form' => [
        'label' => 'Passkey hmang rawh',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'Passkey finfiah theih a ni lo. Khawngaihin ti nawn leh rawh.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Passkey hmangin finfiah rawh',
            ],
        ],
    ],
];
