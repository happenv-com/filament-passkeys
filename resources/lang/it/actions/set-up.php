<?php

return [
    'label' => 'Configura',
    'modal' => [
        'heading' => 'Configura la verifica tramite passkey',
        'description' => 'Registra una passkey su questo dispositivo. Ti verrà chiesto di usare l\'impronta digitale, il riconoscimento del volto, il blocco schermo o una chiave di sicurezza. Dopo la registrazione potrai accedere con questa passkey.',
        'form' => [
            'name' => [
                'label' => 'Nome della passkey',
                'placeholder' => 'es. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Registra la passkey',
            ],
            'errors' => [
                'failed' => 'Impossibile registrare la passkey. Riprova.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Passkey registrata correttamente',
        ],
    ],
];
