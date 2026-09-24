<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikacija pristupnim ključem',
            'below_content' => 'Koristite pristupni ključ na ovom uređaju (Face ID, Touch ID, Windows Hello, Android, sigurnosni ključ) za verifikaciju identiteta prilikom prijave. Dodajte po jedan za svaki uređaj sa kog se prijavljujete.',
            'messages' => [
                'enabled' => 'Uključeno',
                'disabled' => 'Isključeno',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Pristupni ključ',
                'last_used_at' => 'Poslednja upotreba',
                'actions' => 'Radnje',
            ],
            'never_used' => 'Nikada',
        ],
    ],
    'login_form' => [
        'label' => 'Koristite pristupni ključ',
        'credential' => [
            'label' => 'pristupni ključ',
            'messages' => [
                'invalid' => 'Pristupni ključ nije moguće verifikovati. Pokušajte ponovo.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verifikuj pristupnim ključem',
            ],
        ],
    ],
];
