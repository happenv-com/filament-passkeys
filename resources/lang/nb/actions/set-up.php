<?php

return [
    'label' => 'Aktiver',
    'modal' => [
        'heading' => 'Aktiver bekreftelse med passnøkkel',
        'description' => 'Registrer en passnøkkel på denne enheten. Du blir bedt om å bruke fingeravtrykk, ansikt, skjermlås eller en sikkerhetsnøkkel. Etter registreringen kan du logge inn med denne passnøkkelen.',
        'form' => [
            'name' => [
                'label' => 'Navn på passnøkkel',
                'placeholder' => 'f.eks. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Registrer passnøkkel',
            ],
            'errors' => [
                'failed' => 'Vi kunne ikke registrere passnøkkelen din. Prøv igjen.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Passnøkkelen ble registrert',
        ],
    ],
];
