<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikācija ar piekļuves atslēgu',
            'below_content' => 'Izmantojiet piekļuves atslēgu (Face ID, Touch ID, Windows Hello, Android, drošības atslēgu), lai pierakstīšanās laikā apliecinātu savu identitāti. Pievienojiet pa vienai katrai ierīcei, no kuras piesakāties.',
            'messages' => [
                'enabled' => 'Iespējota',
                'disabled' => 'Atspējota',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Piekļuves atslēga',
                'last_used_at' => 'Pēdējoreiz izmantota',
                'actions' => 'Darbības',
            ],
            'never_used' => 'Nekad',
        ],
    ],
    'login_form' => [
        'label' => 'Izmantot piekļuves atslēgu',
        'credential' => [
            'label' => 'piekļuves atslēga',
            'messages' => [
                'invalid' => 'Piekļuves atslēgu neizdevās verificēt. Lūdzu, mēģiniet vēlreiz.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verificēt ar piekļuves atslēgu',
            ],
        ],
    ],
];
