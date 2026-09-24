<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifica tramite passkey',
            'below_content' => 'Usa una passkey (Face ID, Touch ID, Windows Hello, Android, chiave di sicurezza) per verificare la tua identità durante l\'accesso. Aggiungine una per ogni dispositivo da cui accedi.',
            'messages' => [
                'enabled' => 'Abilitato',
                'disabled' => 'Disabilitato',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'Ultimo utilizzo',
                'actions' => 'Azioni',
            ],
            'never_used' => 'Mai',
        ],
    ],
    'login_form' => [
        'label' => 'Usa una passkey',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'Impossibile verificare la passkey. Riprova.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verifica con passkey',
            ],
        ],
    ],
];
