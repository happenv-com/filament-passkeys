<?php

return [
    'label' => 'Konfigurer',
    'modal' => [
        'heading' => 'Konfigurer bekræftelse med adgangsnøgle',
        'description' => 'Registrer en adgangsnøgle på denne enhed. Du bliver bedt om at bruge dit fingeraftryk, dit ansigt, skærmlåsen eller en sikkerhedsnøgle. Efter registreringen kan du logge ind med denne adgangsnøgle.',
        'form' => [
            'name' => [
                'label' => 'Navn på adgangsnøgle',
                'placeholder' => 'f.eks. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Registrer adgangsnøgle',
            ],
            'errors' => [
                'failed' => 'Vi kunne ikke registrere din adgangsnøgle. Prøv igen.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Adgangsnøglen er registreret',
        ],
    ],
];
