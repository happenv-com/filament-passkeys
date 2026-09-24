<?php

return [
    'label' => 'Nastavit',
    'add_label' => 'Přidat přístupový klíč',
    'modal' => [
        'heading' => 'Nastavit ověření přístupovým klíčem',
        'add_heading' => 'Přidat přístupový klíč',
        'description' => 'Zaregistrujte přístupový klíč na tomto zařízení. Budete vyzváni k použití otisku prstu, obličeje, zámku obrazovky nebo bezpečnostního klíče. Po registraci se budete moci přihlašovat pomocí tohoto přístupového klíče.',
        'form' => [
            'name' => [
                'label' => 'Název přístupového klíče',
                'placeholder' => 'např. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Nepovinné. Ponechte prázdné, chcete-li jej pojmenovat podle svého zařízení nebo správce hesel.',
                'default' => 'Přístupový klíč',
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
        'already_registered' => [
            'title' => 'Toto zařízení už má přístupový klíč',
            'body' => 'Přístupový klíč pro váš účet je již uložen v tomto zařízení nebo správci hesel. Přidejte jej místo toho z jiného zařízení.',
        ],
    ],
];
