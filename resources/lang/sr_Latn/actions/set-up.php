<?php

return [
    'label' => 'Postavka',
    'add_label' => 'Dodaj pristupni ključ',
    'modal' => [
        'heading' => 'Postavka verifikacije pristupnim ključem',
        'add_heading' => 'Dodaj pristupni ključ',
        'description' => 'Registrujte pristupni ključ na ovom uređaju. Biće zatraženo da koristite otisak prsta, lice, zaključavanje ekrana ili sigurnosni ključ. Nakon registracije moći ćete da se prijavite ovim pristupnim ključem.',
        'form' => [
            'name' => [
                'label' => 'Naziv pristupnog ključa',
                'placeholder' => 'npr. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opciono. Ostavite prazno da bi se imenovao prema vašem uređaju ili menadžeru lozinki.',
                'default' => 'Pristupni ključ',
            ],
            'submit' => [
                'label' => 'Registruj pristupni ključ',
            ],
            'errors' => [
                'failed' => 'Nije moguće registrovati pristupni ključ. Pokušajte ponovo.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Pristupni ključ je uspešno registrovan',
        ],
        'already_registered' => [
            'title' => 'Ovaj uređaj već ima pristupni ključ',
            'body' => 'Pristupni ključ za vaš nalog je već sačuvan na ovom uređaju ili u menadžeru lozinki. Umesto toga, dodajte ga sa drugog uređaja.',
        ],
    ],
];
