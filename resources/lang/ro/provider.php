<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificare cu cheie de acces',
            'below_content' => 'Folosiți o cheie de acces (Face ID, Touch ID, Windows Hello, Android, cheie de securitate) pentru a vă verifica identitatea la autentificare. Adăugați una pentru fiecare dispozitiv de pe care vă conectați.',
            'messages' => [
                'enabled' => 'Activat',
                'disabled' => 'Dezactivat',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Cheie de acces',
                'last_used_at' => 'Ultima utilizare',
                'actions' => 'Acțiuni',
            ],
            'never_used' => 'Niciodată',
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
