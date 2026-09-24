<?php

return [
    'label' => 'Remover',
    'modal' => [
        'heading' => 'Remover a chave de acesso ":name"',
        'description' => 'Deixará de poder iniciar sessão com esta chave de acesso. As suas outras chaves de acesso continuam a funcionar.',
        'description_last' => 'Esta é a sua última chave de acesso. Removê-la desativa a verificação por chave de acesso, o que remove uma camada extra de segurança da sua conta.',
        'actions' => [
            'submit' => [
                'label' => 'Remover chave de acesso',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Chave de acesso removida',
        ],
    ],
];
