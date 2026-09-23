<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Bekræftelse med adgangsnøgle',
            'below_content' => 'Brug en adgangsnøgle på denne enhed (Face ID, Touch ID, Windows Hello, sikkerhedsnøgle) til at bekræfte din identitet, når du logger ind.',
            'messages' => [
                'enabled' => 'Aktiveret',
                'disabled' => 'Deaktiveret',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Brug en adgangsnøgle',
        'credential' => [
            'label' => 'adgangsnøgle',
            'messages' => [
                'invalid' => 'Adgangsnøglen kunne ikke bekræftes. Prøv igen.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Bekræft med adgangsnøgle',
            ],
        ],
    ],
];
