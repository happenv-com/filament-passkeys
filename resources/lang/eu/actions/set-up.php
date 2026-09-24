<?php

return [
    'label' => 'Konfiguratu',
    'add_label' => 'Gehitu sarbide-gakoa',
    'modal' => [
        'heading' => 'Sarbide-gako bidezko egiaztapena konfiguratu',
        'add_heading' => 'Gehitu sarbide-gako bat',
        'description' => 'Erregistratu sarbide-gako bat gailu honetan. Hatz-marka, aurpegia, pantaila-blokeoa edo segurtasun-gako bat erabiltzeko eskatuko zaizu. Erregistratu ondoren, sarbide-gako honekin saioa hasi ahal izango duzu.',
        'form' => [
            'name' => [
                'label' => 'Sarbide-gakoaren izena',
                'placeholder' => 'adib. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Aukerakoa. Utzi hutsik zure gailuaren edo pasahitz-kudeatzailearen izena erabiltzeko.',
                'default' => 'Sarbide-gakoa',
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
        'already_registered' => [
            'title' => 'Gailu honek badu jada sarbide-gako bat',
            'body' => 'Zure konturako sarbide-gako bat jada gordeta dago gailu honetan edo pasahitz-kudeatzailean. Gehitu bat beste gailu batetik.',
        ],
    ],
];
