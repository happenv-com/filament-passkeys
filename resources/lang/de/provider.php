<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Passkey-Verifizierung',
            'below_content' => 'Verwenden Sie einen Passkey auf diesem Gerät (Face ID, Touch ID, Windows Hello, Sicherheitsschlüssel), um Ihre Identität bei der Anmeldung zu verifizieren.',
            'messages' => [
                'enabled' => 'Aktiviert',
                'disabled' => 'Deaktiviert',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Verwenden Sie einen Passkey',
        'credential' => [
            'label' => 'Passkey',
            'messages' => [
                'invalid' => 'Der Passkey konnte nicht verifiziert werden. Bitte versuchen Sie es erneut.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Mit Passkey verifizieren',
            ],
        ],
    ],
];
