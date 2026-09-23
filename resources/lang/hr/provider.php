<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Provjera pristupnim ključem',
            'below_content' => 'Koristite pristupni ključ na ovom uređaju (Face ID, Touch ID, Windows Hello, sigurnosni ključ) za potvrdu identiteta prilikom prijave.',
            'messages' => [
                'enabled' => 'Uključena',
                'disabled' => 'Isključena',
            ],
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
