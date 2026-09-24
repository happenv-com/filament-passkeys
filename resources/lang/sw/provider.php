<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Uthibitishaji wa passkey',
            'below_content' => 'Tumia passkey (Face ID, Touch ID, Windows Hello, Android, ufunguo wa usalama) kuthibitisha utambulisho wako wakati wa kuingia. Ongeza moja kwa kila kifaa unachotumia kuingia.',
            'messages' => [
                'enabled' => 'Imewashwa',
                'disabled' => 'Imezimwa',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'Ilitumika mara ya mwisho',
                'actions' => 'Vitendo',
            ],
            'never_used' => 'Kamwe',
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
