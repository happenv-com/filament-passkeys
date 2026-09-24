<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikacija pristupnim ključem',
            'below_content' => 'Koristite pristupni ključ (Face ID, Touch ID, Windows Hello, Android, sigurnosni ključ) da potvrdite svoj identitet prilikom prijave. Dodajte po jedan za svaki uređaj s kojeg se prijavljujete.',
            'messages' => [
                'enabled' => 'Uključeno',
                'disabled' => 'Isključeno',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Pristupni ključ',
                'last_used_at' => 'Posljednja upotreba',
                'actions' => 'Radnje',
            ],
            'never_used' => 'Nikad',
        ],
    ],
    'login_form' => [
        'label' => 'Koristite pristupni ključ',
        'credential' => [
            'label' => 'pristupni ključ',
            'messages' => [
                'invalid' => 'Pristupni ključ nije moguće verificirati. Pokušajte ponovo.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verificirajte pristupnim ključem',
            ],
        ],
    ],
];
