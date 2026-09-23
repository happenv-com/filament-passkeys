<?php

return [
    'label' => 'Postavka',
    'modal' => [
        'heading' => 'Postavka verifikacije pristupnim ključem',
        'description' => 'Registrujte pristupni ključ na ovom uređaju. Biće zatraženo da koristite otisak prsta, lice, zaključavanje ekrana ili sigurnosni ključ. Nakon registracije moći ćete da se prijavite ovim pristupnim ključem.',
        'form' => [
            'name' => [
                'label' => 'Naziv pristupnog ključa',
                'placeholder' => 'npr. MacBook Touch ID, YubiKey 5C',
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
    ],
];
