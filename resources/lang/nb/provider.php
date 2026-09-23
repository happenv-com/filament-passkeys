<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Bekreftelse med passnøkkel',
            'below_content' => 'Bruk en passnøkkel på denne enheten (Face ID, Touch ID, Windows Hello, sikkerhetsnøkkel) for å bekrefte identiteten din ved innlogging.',
            'messages' => [
                'enabled' => 'Aktivert',
                'disabled' => 'Deaktivert',
            ],
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
