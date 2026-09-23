<?php

return [
    'label' => 'Nastavit',
    'modal' => [
        'heading' => 'Nastavit ověření přístupovým klíčem',
        'description' => 'Zaregistrujte přístupový klíč na tomto zařízení. Budete vyzváni k použití otisku prstu, obličeje, zámku obrazovky nebo bezpečnostního klíče. Po registraci se budete moci přihlašovat pomocí tohoto přístupového klíče.',
        'form' => [
            'name' => [
                'label' => 'Název přístupového klíče',
                'placeholder' => 'např. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Zaregistrovat přístupový klíč',
            ],
            'errors' => [
                'failed' => 'Váš přístupový klíč se nepodařilo zaregistrovat. Zkuste to znovu.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Přístupový klíč byl úspěšně zaregistrován',
        ],
    ],
];
