<?php

return [
    'label' => 'Konfiguratu',
    'modal' => [
        'heading' => 'Sarbide-gako bidezko egiaztapena konfiguratu',
        'description' => 'Erregistratu sarbide-gako bat gailu honetan. Hatz-marka, aurpegia, pantaila-blokeoa edo segurtasun-gako bat erabiltzeko eskatuko zaizu. Erregistratu ondoren, sarbide-gako honekin saioa hasi ahal izango duzu.',
        'form' => [
            'name' => [
                'label' => 'Sarbide-gakoaren izena',
                'placeholder' => 'adib. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Erregistratu sarbide-gakoa',
            ],
            'errors' => [
                'failed' => 'Ezin izan dugu zure sarbide-gakoa erregistratu. Saiatu berriro.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Sarbide-gakoa behar bezala erregistratu da',
        ],
    ],
];
