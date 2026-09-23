<?php

return [
    'label' => 'Einrichten',
    'modal' => [
        'heading' => 'Passkey-Verifizierung einrichten',
        'description' => 'Registrieren Sie einen Passkey auf diesem Gerät. Sie werden aufgefordert, Ihren Fingerabdruck, Ihr Gesicht, die Bildschirmsperre oder einen Sicherheitsschlüssel zu verwenden. Nach der Registrierung können Sie sich mit diesem Passkey anmelden.',
        'form' => [
            'name' => [
                'label' => 'Name des Passkeys',
                'placeholder' => 'z. B. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Passkey registrieren',
            ],
            'errors' => [
                'failed' => 'Ihr Passkey konnte nicht registriert werden. Bitte versuchen Sie es erneut.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Passkey wurde erfolgreich registriert',
        ],
    ],
];
