<?php

return [
    'label' => 'Remover',
    'modal' => [
        'heading' => 'Remover passkey ":name"',
        'description' => 'Você não poderá mais entrar com essa passkey. Suas outras passkeys continuam funcionando.',
        'description_last' => 'Esta é sua última passkey. Removê-la desativa a verificação por passkey, o que remove uma camada extra de segurança da sua conta.',
        'actions' => [
            'submit' => [
                'label' => 'Remover passkey',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Passkey removida',
        ],
    ],
];
