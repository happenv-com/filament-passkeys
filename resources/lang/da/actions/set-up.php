<?php

return [
    'label' => 'Konfigurer',
    'add_label' => 'Tilføj adgangsnøgle',
    'modal' => [
        'heading' => 'Konfigurer bekræftelse med adgangsnøgle',
        'add_heading' => 'Tilføj en adgangsnøgle',
        'description' => 'Registrer en adgangsnøgle på denne enhed. Du bliver bedt om at bruge dit fingeraftryk, dit ansigt, skærmlåsen eller en sikkerhedsnøgle. Efter registreringen kan du logge ind med denne adgangsnøgle.',
        'form' => [
            'name' => [
                'label' => 'Navn på adgangsnøgle',
                'placeholder' => 'f.eks. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Valgfrit. Lad feltet stå tomt for at navngive den efter din enhed eller adgangskodeadministrator.',
                'default' => 'Adgangsnøgle',
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
        'already_registered' => [
            'title' => 'Denne enhed har allerede en adgangsnøgle',
            'body' => 'Der er allerede gemt en adgangsnøgle til din konto på denne enhed eller i adgangskodeadministratoren. Tilføj i stedet en fra en anden enhed.',
        ],
    ],
];
