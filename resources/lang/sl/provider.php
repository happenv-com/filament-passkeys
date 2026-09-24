<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Preverjanje s ključem za dostop',
            'below_content' => 'Za potrditev identitete ob prijavi uporabite ključ za dostop (Face ID, Touch ID, Windows Hello, Android, varnostni ključ). Dodajte ga za vsako napravo, iz katere se prijavljate.',
            'messages' => [
                'enabled' => 'Omogočeno',
                'disabled' => 'Onemogočeno',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Ključ za dostop',
                'last_used_at' => 'Nazadnje uporabljeno',
                'actions' => 'Dejanja',
            ],
            'never_used' => 'Nikoli',
        ],
    ],
    'login_form' => [
        'label' => 'Uporabite ključ za dostop',
        'credential' => [
            'label' => 'ključ za dostop',
            'messages' => [
                'invalid' => 'Ključa za dostop ni bilo mogoče preveriti. Poskusite znova.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Preveri s ključem za dostop',
            ],
        ],
    ],
];
