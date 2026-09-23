<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Overenie prístupovým kľúčom',
            'below_content' => 'Použite prístupový kľúč v tomto zariadení (Face ID, Touch ID, Windows Hello, bezpečnostný kľúč) na overenie svojej identity pri prihlásení.',
            'messages' => [
                'enabled' => 'Povolené',
                'disabled' => 'Zakázané',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Použite prístupový kľúč',
        'credential' => [
            'label' => 'prístupový kľúč',
            'messages' => [
                'invalid' => 'Prístupový kľúč sa nepodarilo overiť. Skúste to znova.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Overiť prístupovým kľúčom',
            ],
        ],
    ],
];
