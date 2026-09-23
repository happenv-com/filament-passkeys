<?php

return [
    'label' => 'Postavi',
    'modal' => [
        'heading' => 'Postavite verifikaciju pristupnim ključem',
        'description' => 'Registrujte pristupni ključ na ovom uređaju. Bit ćete zamoljeni da koristite otisak prsta, lice, zaključavanje ekrana ili sigurnosni ključ. Nakon registracije moći ćete se prijaviti pomoću ovog pristupnog ključa.',
        'form' => [
            'name' => [
                'label' => 'Naziv pristupnog ključa',
                'placeholder' => 'npr. MacBook Touch ID, YubiKey 5C',
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
    ],
];
