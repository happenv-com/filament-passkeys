<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Vérification par clé d\'accès',
            'below_content' => 'Utilisez une clé d\'accès sur cet appareil (Face ID, Touch ID, Windows Hello, Android, clé de sécurité) pour vérifier votre identité lors de la connexion. Ajoutez-en une pour chaque appareil à partir duquel vous vous connectez.',
            'messages' => [
                'enabled' => 'Activé',
                'disabled' => 'Désactivé',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Clé d\'accès',
                'last_used_at' => 'Dernière utilisation',
                'actions' => 'Actions',
            ],
            'never_used' => 'Jamais',
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
