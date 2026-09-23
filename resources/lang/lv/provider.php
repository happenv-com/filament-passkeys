<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikācija ar piekļuves atslēgu',
            'below_content' => 'Izmantojiet piekļuves atslēgu šajā ierīcē (Face ID, Touch ID, Windows Hello, drošības atslēgu), lai pierakstīšanās laikā apliecinātu savu identitāti.',
            'messages' => [
                'enabled' => 'Iespējota',
                'disabled' => 'Atspējota',
            ],
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
