<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikimi me çelës kalimi',
            'below_content' => 'Përdorni një çelës kalimi (Face ID, Touch ID, Windows Hello, Android, çelës sigurie) për të verifikuar identitetin tuaj gjatë hyrjes. Shtoni një për çdo pajisje nga e cila hyni.',
            'messages' => [
                'enabled' => 'Aktivizuar',
                'disabled' => 'Çaktivizuar',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Çelësi i kalimit',
                'last_used_at' => 'Përdorur së fundmi',
                'actions' => 'Veprime',
            ],
            'never_used' => 'Kurrë',
        ],
    ],
    'login_form' => [
        'label' => 'Përdorni një çelës kalimi',
        'credential' => [
            'label' => 'çelës kalimi',
            'messages' => [
                'invalid' => 'Çelësi i kalimit nuk mund të verifikohej. Ju lutemi provoni përsëri.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verifiko me çelës kalimi',
            ],
        ],
    ],
];
