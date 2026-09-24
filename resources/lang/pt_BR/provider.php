<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificação por passkey',
            'below_content' => 'Use uma passkey (Face ID, Touch ID, Windows Hello, Android, chave de segurança) para verificar sua identidade durante o login. Adicione uma para cada dispositivo em que você faz login.',
            'messages' => [
                'enabled' => 'Ativado',
                'disabled' => 'Desativado',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Passkey',
                'last_used_at' => 'Último uso',
                'actions' => 'Ações',
            ],
            'never_used' => 'Nunca',
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
