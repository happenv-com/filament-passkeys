<?php

return [
    'label' => 'Konfiguro',
    'add_label' => 'Shto çelës kalimi',
    'modal' => [
        'heading' => 'Konfiguro verifikimin me çelës kalimi',
        'add_heading' => 'Shto një çelës kalimi',
        'description' => 'Regjistroni një çelës kalimi në këtë pajisje. Do t\'ju kërkohet të përdorni gjurmën e gishtit, fytyrën, kyçjen e ekranit ose një çelës sigurie. Pas regjistrimit, do të mund të hyni duke përdorur këtë çelës kalimi.',
        'form' => [
            'name' => [
                'label' => 'Emri i çelësit të kalimit',
                'placeholder' => 'p.sh. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opsionale. Lëreni bosh për ta emërtuar sipas pajisjes suaj ose menaxherit të fjalëkalimeve.',
                'default' => 'Çelës kalimi',
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
        'already_registered' => [
            'title' => 'Kjo pajisje ka tashmë një çelës kalimi',
            'body' => 'Një çelës kalimi për llogarinë tuaj është ruajtur tashmë në këtë pajisje ose menaxher fjalëkalimesh. Në vend të kësaj, shtoni një nga një pajisje tjetër.',
        ],
    ],
];
