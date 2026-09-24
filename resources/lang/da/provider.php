<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Bekræftelse med adgangsnøgle',
            'below_content' => 'Brug en adgangsnøgle (Face ID, Touch ID, Windows Hello, Android, sikkerhedsnøgle) til at bekræfte din identitet, når du logger ind. Tilføj én for hver enhed, du logger ind fra.',
            'messages' => [
                'enabled' => 'Aktiveret',
                'disabled' => 'Deaktiveret',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Adgangsnøgle',
                'last_used_at' => 'Sidst brugt',
                'actions' => 'Handlinger',
            ],
            'never_used' => 'Aldrig',
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
