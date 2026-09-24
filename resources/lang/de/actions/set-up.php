<?php

return [
    'label' => 'Einrichten',
    'add_label' => 'Passkey hinzufügen',
    'modal' => [
        'heading' => 'Passkey-Verifizierung einrichten',
        'add_heading' => 'Einen Passkey hinzufügen',
        'description' => 'Registrieren Sie einen Passkey auf diesem Gerät. Sie werden aufgefordert, Ihren Fingerabdruck, Ihr Gesicht, die Bildschirmsperre oder einen Sicherheitsschlüssel zu verwenden. Nach der Registrierung können Sie sich mit diesem Passkey anmelden.',
        'form' => [
            'name' => [
                'label' => 'Name des Passkeys',
                'placeholder' => 'z. B. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Optional. Leer lassen, um ihn nach Ihrem Gerät oder Passwort-Manager zu benennen.',
                'default' => 'Passkey',
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
        'already_registered' => [
            'title' => 'Dieses Gerät hat bereits einen Passkey',
            'body' => 'Für Ihr Konto ist bereits ein Passkey auf diesem Gerät oder in diesem Passwort-Manager gespeichert. Fügen Sie stattdessen einen von einem anderen Gerät hinzu.',
        ],
    ],
];
