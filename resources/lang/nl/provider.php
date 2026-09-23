<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificatie met toegangssleutel',
            'below_content' => 'Gebruik een toegangssleutel op dit apparaat (Face ID, Touch ID, Windows Hello, beveiligingssleutel) om je identiteit te verifiëren tijdens het inloggen.',
            'messages' => [
                'enabled' => 'Ingeschakeld',
                'disabled' => 'Uitgeschakeld',
            ],
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
