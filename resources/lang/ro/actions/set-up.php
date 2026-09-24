<?php

return [
    'label' => 'Configurează',
    'add_label' => 'Adaugă o cheie de acces',
    'modal' => [
        'heading' => 'Configurare verificare cu cheie de acces',
        'add_heading' => 'Adăugare cheie de acces',
        'description' => 'Înregistrați o cheie de acces pe acest dispozitiv. Vi se va cere să folosiți amprenta, fața, blocarea ecranului sau o cheie de securitate. După înregistrare, vă veți putea autentifica folosind această cheie de acces.',
        'form' => [
            'name' => [
                'label' => 'Numele cheii de acces',
                'placeholder' => 'ex. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opțional. Lăsați necompletat pentru a o denumi după dispozitiv sau managerul de parole.',
                'default' => 'Cheie de acces',
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
        'already_registered' => [
            'title' => 'Acest dispozitiv are deja o cheie de acces',
            'body' => 'O cheie de acces pentru contul dumneavoastră este deja stocată pe acest dispozitiv sau în managerul de parole. Adăugați una de pe alt dispozitiv.',
        ],
    ],
];
