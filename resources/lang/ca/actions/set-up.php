<?php

return [
    'label' => 'Configurar',
    'add_label' => 'Afegeix una clau d\'accés',
    'modal' => [
        'heading' => 'Configurar la verificació amb clau d\'accés',
        'add_heading' => 'Afegeix una clau d\'accés',
        'description' => 'Registra una clau d\'accés en aquest dispositiu. Se\'t demanarà que facis servir l\'empremta digital, la cara, el bloqueig de pantalla o una clau de seguretat. Després del registre, podràs iniciar la sessió amb aquesta clau d\'accés.',
        'form' => [
            'name' => [
                'label' => 'Nom de la clau d\'accés',
                'placeholder' => 'p. ex. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opcional. Deixa-ho buit perquè s\'anomeni segons el teu dispositiu o gestor de contrasenyes.',
                'default' => 'Clau d\'accés',
            ],
            'submit' => [
                'label' => 'Registrar la clau d\'accés',
            ],
            'errors' => [
                'failed' => 'No hem pogut registrar la teva clau d\'accés. Torna-ho a provar.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'La clau d\'accés s\'ha registrat correctament',
        ],
        'already_registered' => [
            'title' => 'Aquest dispositiu ja té una clau d\'accés',
            'body' => 'Ja hi ha una clau d\'accés del teu compte desada en aquest dispositiu o gestor de contrasenyes. Afegeix-ne una des d\'un altre dispositiu.',
        ],
    ],
];
