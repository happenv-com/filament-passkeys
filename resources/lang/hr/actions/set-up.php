<?php

return [
    'label' => 'Postavi',
    'add_label' => 'Dodaj pristupni ključ',
    'modal' => [
        'heading' => 'Postavi provjeru pristupnim ključem',
        'add_heading' => 'Dodaj pristupni ključ',
        'description' => 'Registrirajte pristupni ključ na ovom uređaju. Od vas će se tražiti da upotrijebite otisak prsta, lice, zaključavanje zaslona ili sigurnosni ključ. Nakon registracije moći ćete se prijaviti ovim pristupnim ključem.',
        'form' => [
            'name' => [
                'label' => 'Naziv pristupnog ključa',
                'placeholder' => 'npr. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Neobavezno. Ostavite prazno kako biste ga nazvali prema svom uređaju ili upravitelju lozinki.',
                'default' => 'Pristupni ključ',
            ],
            'submit' => [
                'label' => 'Registriraj pristupni ključ',
            ],
            'errors' => [
                'failed' => 'Nismo uspjeli registrirati vaš pristupni ključ. Pokušajte ponovno.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Pristupni ključ je uspješno registriran',
        ],
        'already_registered' => [
            'title' => 'Ovaj uređaj već ima pristupni ključ',
            'body' => 'Pristupni ključ za vaš račun već je pohranjen na ovom uređaju ili u upravitelju lozinki. Umjesto toga dodajte ga s drugog uređaja.',
        ],
    ],
];
