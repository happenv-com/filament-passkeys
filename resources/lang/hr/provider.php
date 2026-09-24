<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Provjera pristupnim ključem',
            'below_content' => 'Koristite pristupni ključ (Face ID, Touch ID, Windows Hello, Android, sigurnosni ključ) za potvrdu identiteta prilikom prijave. Dodajte po jedan za svaki uređaj s kojeg se prijavljujete.',
            'messages' => [
                'enabled' => 'Uključena',
                'disabled' => 'Isključena',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Pristupni ključ',
                'last_used_at' => 'Zadnja upotreba',
                'actions' => 'Radnje',
            ],
            'never_used' => 'Nikada',
        ],
    ],
    'login_form' => [
        'label' => 'Koristi pristupni ključ',
        'credential' => [
            'label' => 'pristupni ključ',
            'messages' => [
                'invalid' => 'Pristupni ključ nije moguće provjeriti. Pokušajte ponovno.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Potvrdi pristupnim ključem',
            ],
        ],
    ],
];
