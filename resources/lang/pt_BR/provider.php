<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificação por passkey',
            'below_content' => 'Use uma passkey neste dispositivo (Face ID, Touch ID, Windows Hello, chave de segurança) para verificar sua identidade durante o login.',
            'messages' => [
                'enabled' => 'Ativado',
                'disabled' => 'Desativado',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Usar uma passkey',
        'credential' => [
            'label' => 'passkey',
            'messages' => [
                'invalid' => 'Não foi possível verificar a passkey. Tente novamente.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verificar com passkey',
            ],
        ],
    ],
];
