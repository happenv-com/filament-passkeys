<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Overenie prístupovým kľúčom',
            'below_content' => 'Použite prístupový kľúč v tomto zariadení (Face ID, Touch ID, Windows Hello, Android, bezpečnostný kľúč) na overenie svojej identity pri prihlásení. Pridajte jeden pre každé zariadenie, z ktorého sa prihlasujete.',
            'messages' => [
                'enabled' => 'Povolené',
                'disabled' => 'Zakázané',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Prístupový kľúč',
                'last_used_at' => 'Naposledy použitý',
                'actions' => 'Akcie',
            ],
            'never_used' => 'Nikdy',
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
