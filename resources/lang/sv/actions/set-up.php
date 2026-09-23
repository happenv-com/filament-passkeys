<?php

return [
    'label' => 'Konfigurera',
    'modal' => [
        'heading' => 'Konfigurera verifiering med lösennyckel',
        'description' => 'Registrera en lösennyckel på den här enheten. Du kommer att ombes att använda ditt fingeravtryck, ditt ansikte, skärmlåset eller en säkerhetsnyckel. Efter registreringen kan du logga in med den här lösennyckeln.',
        'form' => [
            'name' => [
                'label' => 'Namn på lösennyckel',
                'placeholder' => 't.ex. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Registrera lösennyckel',
            ],
            'errors' => [
                'failed' => 'Vi kunde inte registrera din lösennyckel. Försök igen.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Lösennyckeln har registrerats',
        ],
    ],
];
