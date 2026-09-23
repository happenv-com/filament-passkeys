<?php

return [
    'label' => 'Configurar',
    'modal' => [
        'heading' => 'Configurar verificação por chave de acesso',
        'description' => 'Registe uma chave de acesso neste dispositivo. Ser-lhe-á pedido que use a sua impressão digital, rosto, bloqueio de ecrã ou uma chave de segurança. Após o registo, poderá iniciar sessão com esta chave de acesso.',
        'form' => [
            'name' => [
                'label' => 'Nome da chave de acesso',
                'placeholder' => 'p. ex. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Registar chave de acesso',
            ],
            'errors' => [
                'failed' => 'Não foi possível registar a sua chave de acesso. Tente novamente.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Chave de acesso registada com sucesso',
        ],
    ],
];
