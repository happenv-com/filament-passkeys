<?php

return [
    'label' => 'Configura',
    'add_label' => 'Aggiungi passkey',
    'modal' => [
        'heading' => 'Configura la verifica tramite passkey',
        'add_heading' => 'Aggiungi una passkey',
        'description' => 'Registra una passkey su questo dispositivo. Ti verrà chiesto di usare l\'impronta digitale, il riconoscimento del volto, il blocco schermo o una chiave di sicurezza. Dopo la registrazione potrai accedere con questa passkey.',
        'form' => [
            'name' => [
                'label' => 'Nome della passkey',
                'placeholder' => 'es. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Facoltativo. Lascia vuoto per assegnarle il nome del tuo dispositivo o del gestore delle password.',
                'default' => 'Passkey',
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
        'already_registered' => [
            'title' => 'Questo dispositivo ha già una passkey',
            'body' => 'Una passkey per il tuo account è già memorizzata su questo dispositivo o nel gestore delle password. Aggiungine una da un altro dispositivo.',
        ],
    ],
];
