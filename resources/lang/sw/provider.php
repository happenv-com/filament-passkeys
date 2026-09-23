<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Uthibitishaji wa passkey',
            'below_content' => 'Tumia passkey kwenye kifaa hiki (Face ID, Touch ID, Windows Hello, ufunguo wa usalama) kuthibitisha utambulisho wako wakati wa kuingia.',
            'messages' => [
                'enabled' => 'Imewashwa',
                'disabled' => 'Imezimwa',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Tumia passkey',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'Passkey haikuweza kuthibitishwa. Tafadhali jaribu tena.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Thibitisha kwa passkey',
            ],
        ],
    ],
];
