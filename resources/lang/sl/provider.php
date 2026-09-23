<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Preverjanje s ključem za dostop',
            'below_content' => 'Za potrditev identitete ob prijavi uporabite ključ za dostop v tej napravi (Face ID, Touch ID, Windows Hello, varnostni ključ).',
            'messages' => [
                'enabled' => 'Omogočeno',
                'disabled' => 'Onemogočeno',
            ],
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
