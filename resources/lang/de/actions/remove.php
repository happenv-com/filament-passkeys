<?php

return [
    'label' => 'Entfernen',
    'modal' => [
        'heading' => 'Passkey ":name" entfernen',
        'description' => 'Sie können sich nicht mehr mit diesem Passkey anmelden. Ihre anderen Passkeys funktionieren weiterhin.',
        'description_last' => 'Dies ist Ihr letzter Passkey. Wenn Sie ihn entfernen, wird die Passkey-Verifizierung deaktiviert, wodurch eine zusätzliche Sicherheitsebene für Ihr Konto entfällt.',
        'actions' => [
            'submit' => [
                'label' => 'Passkey entfernen',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Passkey entfernt',
        ],
    ],
];
