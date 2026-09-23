<?php

return [
    'label' => 'Configurează',
    'modal' => [
        'heading' => 'Configurare verificare cu cheie de acces',
        'description' => 'Înregistrați o cheie de acces pe acest dispozitiv. Vi se va cere să folosiți amprenta, fața, blocarea ecranului sau o cheie de securitate. După înregistrare, vă veți putea autentifica folosind această cheie de acces.',
        'form' => [
            'name' => [
                'label' => 'Numele cheii de acces',
                'placeholder' => 'ex. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Înregistrează cheia de acces',
            ],
            'errors' => [
                'failed' => 'Nu am putut înregistra cheia de acces. Vă rugăm să încercați din nou.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Cheia de acces a fost înregistrată cu succes',
        ],
    ],
];
