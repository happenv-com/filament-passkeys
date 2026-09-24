<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Ověření přístupovým klíčem',
            'below_content' => 'Použijte přístupový klíč (Face ID, Touch ID, Windows Hello, Android, bezpečnostní klíč) k ověření své identity při přihlášení. Přidejte jej pro každé zařízení, ze kterého se přihlašujete.',
            'messages' => [
                'enabled' => 'Povoleno',
                'disabled' => 'Zakázáno',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Přístupový klíč',
                'last_used_at' => 'Naposledy použito',
                'actions' => 'Akce',
            ],
            'never_used' => 'Nikdy',
        ],
    ],
    'login_form' => [
        'label' => 'Použijte přístupový klíč',
        'credential' => [
            'label' => 'přístupový klíč',
            'messages' => [
                'invalid' => 'Přístupový klíč se nepodařilo ověřit. Zkuste to znovu.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Ověřit přístupovým klíčem',
            ],
        ],
    ],
];
