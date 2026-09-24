<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Bekreftelse med passnøkkel',
            'below_content' => 'Bruk en passnøkkel på denne enheten (Face ID, Touch ID, Windows Hello, Android, sikkerhetsnøkkel) for å bekrefte identiteten din ved innlogging. Legg til en for hver enhet du logger inn fra.',
            'messages' => [
                'enabled' => 'Aktivert',
                'disabled' => 'Deaktivert',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passnøkkel',
                'last_used_at' => 'Sist brukt',
                'actions' => 'Handlinger',
            ],
            'never_used' => 'Aldri',
        ],
    ],
    'login_form' => [
        'label' => 'Bruk en passnøkkel',
        'credential' => [
            'label' => 'passnøkkel',
            'messages' => [
                'invalid' => 'Passnøkkelen kunne ikke bekreftes. Prøv igjen.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Bekreft med passnøkkel',
            ],
        ],
    ],
];
