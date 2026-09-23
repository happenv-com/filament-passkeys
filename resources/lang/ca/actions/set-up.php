<?php

return [
    'label' => 'Configurar',
    'modal' => [
        'heading' => 'Configurar la verificació amb clau d\'accés',
        'description' => 'Registra una clau d\'accés en aquest dispositiu. Se\'t demanarà que facis servir l\'empremta digital, la cara, el bloqueig de pantalla o una clau de seguretat. Després del registre, podràs iniciar la sessió amb aquesta clau d\'accés.',
        'form' => [
            'name' => [
                'label' => 'Nom de la clau d\'accés',
                'placeholder' => 'p. ex. MacBook Touch ID, YubiKey 5C',
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
    ],
];
