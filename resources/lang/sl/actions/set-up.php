<?php

return [
    'label' => 'Nastavi',
    'modal' => [
        'heading' => 'Nastavi preverjanje s ključem za dostop',
        'description' => 'Registrirajte ključ za dostop v tej napravi. Pozvani boste, da uporabite prstni odtis, obraz, zaklepanje zaslona ali varnostni ključ. Po registraciji se boste lahko prijavili s tem ključem za dostop.',
        'form' => [
            'name' => [
                'label' => 'Ime ključa za dostop',
                'placeholder' => 'npr. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Registriraj ključ za dostop',
            ],
            'errors' => [
                'failed' => 'Ključa za dostop ni bilo mogoče registrirati. Poskusite znova.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Ključ za dostop je bil uspešno registriran',
        ],
    ],
];
