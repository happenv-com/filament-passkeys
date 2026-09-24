<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificatie met toegangssleutel',
            'below_content' => 'Gebruik een toegangssleutel (Face ID, Touch ID, Windows Hello, Android, beveiligingssleutel) om je identiteit te verifiëren tijdens het inloggen. Voeg er een toe voor elk apparaat waarmee je inlogt.',
            'messages' => [
                'enabled' => 'Ingeschakeld',
                'disabled' => 'Uitgeschakeld',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Toegangssleutel',
                'last_used_at' => 'Laatst gebruikt',
                'actions' => 'Acties',
            ],
            'never_used' => 'Nooit',
        ],
    ],
    'login_form' => [
        'label' => 'Gebruik een toegangssleutel',
        'credential' => [
            'label' => 'toegangssleutel',
            'messages' => [
                'invalid' => 'De toegangssleutel kon niet worden geverifieerd. Probeer het opnieuw.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verifiëren met toegangssleutel',
            ],
        ],
    ],
];
