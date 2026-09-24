<?php

return [
    'label' => 'Iestatīt',
    'add_label' => 'Pievienot piekļuves atslēgu',
    'modal' => [
        'heading' => 'Iestatīt verifikāciju ar piekļuves atslēgu',
        'add_heading' => 'Pievienot piekļuves atslēgu',
        'description' => 'Reģistrējiet piekļuves atslēgu šajā ierīcē. Jums tiks lūgts izmantot pirksta nospiedumu, seju, ekrāna bloķēšanu vai drošības atslēgu. Pēc reģistrācijas varēsiet pierakstīties, izmantojot šo piekļuves atslēgu.',
        'form' => [
            'name' => [
                'label' => 'Piekļuves atslēgas nosaukums',
                'placeholder' => 'piem., MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Nav obligāti. Atstājiet tukšu, lai nosauktu to pēc jūsu ierīces vai paroļu pārvaldnieka.',
                'default' => 'Piekļuves atslēga',
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
        'already_registered' => [
            'title' => 'Šai ierīcei jau ir piekļuves atslēga',
            'body' => 'Jūsu konta piekļuves atslēga jau ir saglabāta šajā ierīcē vai paroļu pārvaldniekā. Tā vietā pievienojiet to no citas ierīces.',
        ],
    ],
];
