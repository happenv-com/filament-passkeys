<?php

return [
    'label' => 'Postavi',
    'modal' => [
        'heading' => 'Postavi provjeru pristupnim ključem',
        'description' => 'Registrirajte pristupni ključ na ovom uređaju. Od vas će se tražiti da upotrijebite otisak prsta, lice, zaključavanje zaslona ili sigurnosni ključ. Nakon registracije moći ćete se prijaviti ovim pristupnim ključem.',
        'form' => [
            'name' => [
                'label' => 'Naziv pristupnog ključa',
                'placeholder' => 'npr. MacBook Touch ID, YubiKey 5C',
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
    ],
];
