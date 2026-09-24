<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifiering med lösennyckel',
            'below_content' => 'Använd en lösennyckel (Face ID, Touch ID, Windows Hello, Android, säkerhetsnyckel) för att verifiera din identitet vid inloggning. Lägg till en för varje enhet du loggar in från.',
            'messages' => [
                'enabled' => 'Aktiverad',
                'disabled' => 'Inaktiverad',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Lösennyckel',
                'last_used_at' => 'Senast använd',
                'actions' => 'Åtgärder',
            ],
            'never_used' => 'Aldrig',
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
