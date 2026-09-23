<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Passkey verification',
            'below_content' => 'Login lai in nangmah ngei i nih finfiah nan he device-a passkey (Face ID, Touch ID, Windows Hello, security key) hi hmang rawh.',
            'messages' => [
                'enabled' => 'Enabled',
                'disabled' => 'Disabled',
            ],
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
