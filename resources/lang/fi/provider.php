<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Pääsyavainvahvistus',
            'below_content' => 'Käytä tämän laitteen pääsyavainta (Face ID, Touch ID, Windows Hello, suojausavain) henkilöllisyytesi vahvistamiseen kirjautumisen yhteydessä.',
            'messages' => [
                'enabled' => 'Käytössä',
                'disabled' => 'Pois käytöstä',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Käytä pääsyavainta',
        'credential' => [
            'label' => 'pääsyavain',
            'messages' => [
                'invalid' => 'Pääsyavainta ei voitu vahvistaa. Yritä uudelleen.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Vahvista pääsyavaimella',
            ],
        ],
    ],
];
