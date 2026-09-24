<?php

return [
    'label' => 'Aktiver',
    'add_label' => 'Legg til passnøkkel',
    'modal' => [
        'heading' => 'Aktiver bekreftelse med passnøkkel',
        'add_heading' => 'Legg til en passnøkkel',
        'description' => 'Registrer en passnøkkel på denne enheten. Du blir bedt om å bruke fingeravtrykk, ansikt, skjermlås eller en sikkerhetsnøkkel. Etter registreringen kan du logge inn med denne passnøkkelen.',
        'form' => [
            'name' => [
                'label' => 'Navn på passnøkkel',
                'placeholder' => 'f.eks. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Valgfritt. La stå tomt for å navngi den etter enheten din eller passordbehandleren din.',
                'default' => 'Passnøkkel',
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
        'already_registered' => [
            'title' => 'Denne enheten har allerede en passnøkkel',
            'body' => 'En passnøkkel for kontoen din er allerede lagret på denne enheten eller i denne passordbehandleren. Legg til en fra en annen enhet i stedet.',
        ],
    ],
];
