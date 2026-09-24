<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Passkey-Verifizierung',
            'below_content' => 'Verwenden Sie einen Passkey auf diesem Gerät (Face ID, Touch ID, Windows Hello, Android, Sicherheitsschlüssel), um Ihre Identität bei der Anmeldung zu verifizieren. Fügen Sie für jedes Gerät, mit dem Sie sich anmelden, einen hinzu.',
            'messages' => [
                'enabled' => 'Aktiviert',
                'disabled' => 'Deaktiviert',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'Zuletzt verwendet',
                'actions' => 'Aktionen',
            ],
            'never_used' => 'Nie',
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
