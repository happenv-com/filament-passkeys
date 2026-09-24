<?php

return [
    'label' => 'Fjern',
    'modal' => [
        'heading' => 'Fjern passnøkkelen ":name"',
        'description' => 'Du vil ikke lenger kunne logge inn med denne passnøkkelen. De andre passnøklene dine fortsetter å fungere.',
        'description_last' => 'Dette er din siste passnøkkel. Hvis du fjerner den, slås bekreftelse med passnøkkel av, noe som fjerner et ekstra sikkerhetslag fra kontoen din.',
        'actions' => [
            'submit' => [
                'label' => 'Fjern passnøkkel',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Passnøkkelen ble fjernet',
        ],
    ],
];
