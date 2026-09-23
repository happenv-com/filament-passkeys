<?php

return [
    'label' => 'Iestatīt',
    'modal' => [
        'heading' => 'Iestatīt verifikāciju ar piekļuves atslēgu',
        'description' => 'Reģistrējiet piekļuves atslēgu šajā ierīcē. Jums tiks lūgts izmantot pirksta nospiedumu, seju, ekrāna bloķēšanu vai drošības atslēgu. Pēc reģistrācijas varēsiet pierakstīties, izmantojot šo piekļuves atslēgu.',
        'form' => [
            'name' => [
                'label' => 'Piekļuves atslēgas nosaukums',
                'placeholder' => 'piem., MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Reģistrēt piekļuves atslēgu',
            ],
            'errors' => [
                'failed' => 'Neizdevās reģistrēt jūsu piekļuves atslēgu. Lūdzu, mēģiniet vēlreiz.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Piekļuves atslēga ir veiksmīgi reģistrēta',
        ],
    ],
];
