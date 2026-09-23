<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifiering med lösennyckel',
            'below_content' => 'Använd en lösennyckel på den här enheten (Face ID, Touch ID, Windows Hello, säkerhetsnyckel) för att verifiera din identitet vid inloggning.',
            'messages' => [
                'enabled' => 'Aktiverad',
                'disabled' => 'Inaktiverad',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Använd en lösennyckel',
        'credential' => [
            'label' => 'lösennyckel',
            'messages' => [
                'invalid' => 'Lösennyckeln kunde inte verifieras. Försök igen.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verifiera med lösennyckel',
            ],
        ],
    ],
];
