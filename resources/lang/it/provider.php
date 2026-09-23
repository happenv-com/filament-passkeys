<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifica tramite passkey',
            'below_content' => 'Usa una passkey su questo dispositivo (Face ID, Touch ID, Windows Hello, chiave di sicurezza) per verificare la tua identità durante l\'accesso.',
            'messages' => [
                'enabled' => 'Abilitato',
                'disabled' => 'Disabilitato',
            ],
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
