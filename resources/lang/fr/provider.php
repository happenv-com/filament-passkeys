<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Vérification par clé d\'accès',
            'below_content' => 'Utilisez une clé d\'accès sur cet appareil (Face ID, Touch ID, Windows Hello, clé de sécurité) pour vérifier votre identité lors de la connexion.',
            'messages' => [
                'enabled' => 'Activé',
                'disabled' => 'Désactivé',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Utilisez une clé d\'accès',
        'credential' => [
            'label' => 'clé d\'accès',
            'messages' => [
                'invalid' => 'La clé d\'accès n\'a pas pu être vérifiée. Veuillez réessayer.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Vérifier avec une clé d\'accès',
            ],
        ],
    ],
];
