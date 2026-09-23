<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificare cu cheie de acces',
            'below_content' => 'Folosiți o cheie de acces pe acest dispozitiv (Face ID, Touch ID, Windows Hello, cheie de securitate) pentru a vă verifica identitatea la autentificare.',
            'messages' => [
                'enabled' => 'Activat',
                'disabled' => 'Dezactivat',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Folosiți o cheie de acces',
        'credential' => [
            'label' => 'cheie de acces',
            'messages' => [
                'invalid' => 'Cheia de acces nu a putut fi verificată. Vă rugăm să încercați din nou.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verifică cu cheia de acces',
            ],
        ],
    ],
];
