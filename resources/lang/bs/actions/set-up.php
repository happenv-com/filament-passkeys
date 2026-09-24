<?php

return [
    'label' => 'Postavi',
    'add_label' => 'Dodaj pristupni ključ',
    'modal' => [
        'heading' => 'Postavite verifikaciju pristupnim ključem',
        'add_heading' => 'Dodajte pristupni ključ',
        'description' => 'Registrujte pristupni ključ na ovom uređaju. Bit ćete zamoljeni da koristite otisak prsta, lice, zaključavanje ekrana ili sigurnosni ključ. Nakon registracije moći ćete se prijaviti pomoću ovog pristupnog ključa.',
        'form' => [
            'name' => [
                'label' => 'Naziv pristupnog ključa',
                'placeholder' => 'npr. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opcionalno. Ostavite prazno da biste ga nazvali po svom uređaju ili menadžeru lozinki.',
                'default' => 'Pristupni ključ',
            ],
            'submit' => [
                'label' => 'Registruj pristupni ključ',
            ],
            'errors' => [
                'failed' => 'Nismo uspjeli registrovati vaš pristupni ključ. Pokušajte ponovo.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Pristupni ključ je uspješno registrovan',
        ],
        'already_registered' => [
            'title' => 'Ovaj uređaj već ima pristupni ključ',
            'body' => 'Pristupni ključ za vaš račun je već sačuvan na ovom uređaju ili u menadžeru lozinki. Umjesto toga dodajte ga s drugog uređaja.',
        ],
    ],
];
