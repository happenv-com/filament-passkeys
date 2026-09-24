<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificação por chave de acesso',
            'below_content' => 'Use uma chave de acesso neste dispositivo (Face ID, Touch ID, Windows Hello, Android, chave de segurança) para verificar a sua identidade ao iniciar sessão. Adicione uma para cada dispositivo a partir do qual inicia sessão.',
            'messages' => [
                'enabled' => 'Ativada',
                'disabled' => 'Desativada',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Chave de acesso',
                'last_used_at' => 'Última utilização',
                'actions' => 'Ações',
            ],
            'never_used' => 'Nunca',
        ],
    ],
    'login_form' => [
        'label' => 'Use uma chave de acesso',
        'credential' => [
            'label' => 'chave de acesso',
            'messages' => [
                'invalid' => 'Não foi possível verificar a chave de acesso. Tente novamente.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verificar com chave de acesso',
            ],
        ],
    ],
];
