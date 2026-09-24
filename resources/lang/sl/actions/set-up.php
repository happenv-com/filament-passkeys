<?php

return [
    'label' => 'Nastavi',
    'add_label' => 'Dodaj ključ za dostop',
    'modal' => [
        'heading' => 'Nastavi preverjanje s ključem za dostop',
        'add_heading' => 'Dodaj ključ za dostop',
        'description' => 'Registrirajte ključ za dostop v tej napravi. Pozvani boste, da uporabite prstni odtis, obraz, zaklepanje zaslona ali varnostni ključ. Po registraciji se boste lahko prijavili s tem ključem za dostop.',
        'form' => [
            'name' => [
                'label' => 'Ime ključa za dostop',
                'placeholder' => 'npr. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Neobvezno. Pustite prazno, da ga poimenujete po napravi ali upravitelju gesel.',
                'default' => 'Ključ za dostop',
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
        'already_registered' => [
            'title' => 'Ta naprava že ima ključ za dostop',
            'body' => 'Ključ za dostop za vaš račun je že shranjen v tej napravi ali upravitelju gesel. Namesto tega dodajte enega iz druge naprave.',
        ],
    ],
];
