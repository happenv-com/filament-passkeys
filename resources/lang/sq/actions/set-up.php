<?php

return [
    'label' => 'Konfiguro',
    'modal' => [
        'heading' => 'Konfiguro verifikimin me çelës kalimi',
        'description' => 'Regjistroni një çelës kalimi në këtë pajisje. Do t\'ju kërkohet të përdorni gjurmën e gishtit, fytyrën, kyçjen e ekranit ose një çelës sigurie. Pas regjistrimit, do të mund të hyni duke përdorur këtë çelës kalimi.',
        'form' => [
            'name' => [
                'label' => 'Emri i çelësit të kalimit',
                'placeholder' => 'p.sh. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Regjistro çelësin e kalimit',
            ],
            'errors' => [
                'failed' => 'Nuk mundëm të regjistrojmë çelësin tuaj të kalimit. Ju lutemi provoni përsëri.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Çelësi i kalimit u regjistrua me sukses',
        ],
    ],
];
