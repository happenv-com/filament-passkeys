<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificação por chave de acesso',
            'below_content' => 'Use uma chave de acesso neste dispositivo (Face ID, Touch ID, Windows Hello, chave de segurança) para verificar a sua identidade ao iniciar sessão.',
            'messages' => [
                'enabled' => 'Ativada',
                'disabled' => 'Desativada',
            ],
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
