<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Ověření přístupovým klíčem',
            'below_content' => 'Použijte přístupový klíč na tomto zařízení (Face ID, Touch ID, Windows Hello, bezpečnostní klíč) k ověření své identity při přihlášení.',
            'messages' => [
                'enabled' => 'Povoleno',
                'disabled' => 'Zakázáno',
            ],
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
