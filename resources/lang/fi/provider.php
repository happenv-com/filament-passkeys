<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Pääsyavainvahvistus',
            'below_content' => 'Käytä pääsyavainta (Face ID, Touch ID, Windows Hello, Android, suojausavain) henkilöllisyytesi vahvistamiseen kirjautumisen yhteydessä. Lisää yksi jokaiselle laitteelle, jolla kirjaudut sisään.',
            'messages' => [
                'enabled' => 'Käytössä',
                'disabled' => 'Pois käytöstä',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Pääsyavain',
                'last_used_at' => 'Viimeksi käytetty',
                'actions' => 'Toiminnot',
            ],
            'never_used' => 'Ei koskaan',
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
