<?php

return [
    'label' => 'Konfigurera',
    'add_label' => 'Lägg till lösennyckel',
    'modal' => [
        'heading' => 'Konfigurera verifiering med lösennyckel',
        'add_heading' => 'Lägg till en lösennyckel',
        'description' => 'Registrera en lösennyckel på den här enheten. Du kommer att ombes att använda ditt fingeravtryck, ditt ansikte, skärmlåset eller en säkerhetsnyckel. Efter registreringen kan du logga in med den här lösennyckeln.',
        'form' => [
            'name' => [
                'label' => 'Namn på lösennyckel',
                'placeholder' => 't.ex. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Valfritt. Lämna tomt för att namnge den efter din enhet eller lösenordshanterare.',
                'default' => 'Lösennyckel',
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
        'already_registered' => [
            'title' => 'Den här enheten har redan en lösennyckel',
            'body' => 'En lösennyckel för ditt konto finns redan sparad på den här enheten eller lösenordshanteraren. Lägg till en från en annan enhet istället.',
        ],
    ],
];
