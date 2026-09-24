<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificació amb clau d\'accés',
            'below_content' => 'Fes servir una clau d\'accés en aquest dispositiu (Face ID, Touch ID, Windows Hello, Android, clau de seguretat) per verificar la teva identitat durant l\'inici de sessió. Afegeix-ne una per a cada dispositiu des del qual iniciïs sessió.',
            'messages' => [
                'enabled' => 'Activada',
                'disabled' => 'Desactivada',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Clau d\'accés',
                'last_used_at' => 'Últim ús',
                'actions' => 'Accions',
            ],
            'never_used' => 'Mai',
        ],
    ],
    'login_form' => [
        'label' => 'Fes servir una clau d\'accés',
        'credential' => [
            'label' => 'clau d\'accés',
            'messages' => [
                'invalid' => 'No s\'ha pogut verificar la clau d\'accés. Torna-ho a provar.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verifica amb la clau d\'accés',
            ],
        ],
    ],
];
