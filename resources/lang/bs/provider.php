<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikacija pristupnim ključem',
            'below_content' => 'Koristite pristupni ključ na ovom uređaju (Face ID, Touch ID, Windows Hello, sigurnosni ključ) da potvrdite svoj identitet prilikom prijave.',
            'messages' => [
                'enabled' => 'Uključeno',
                'disabled' => 'Isključeno',
            ],
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
