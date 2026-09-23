<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verifikimi me çelës kalimi',
            'below_content' => 'Përdorni një çelës kalimi në këtë pajisje (Face ID, Touch ID, Windows Hello, çelës sigurie) për të verifikuar identitetin tuaj gjatë hyrjes.',
            'messages' => [
                'enabled' => 'Aktivizuar',
                'disabled' => 'Çaktivizuar',
            ],
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
