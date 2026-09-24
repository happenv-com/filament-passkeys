<?php

return [
    'label' => 'Configurar',
    'add_label' => 'Adicionar chave de acesso',
    'modal' => [
        'heading' => 'Configurar verificação por chave de acesso',
        'add_heading' => 'Adicionar uma chave de acesso',
        'description' => 'Registe uma chave de acesso neste dispositivo. Ser-lhe-á pedido que use a sua impressão digital, rosto, bloqueio de ecrã ou uma chave de segurança. Após o registo, poderá iniciar sessão com esta chave de acesso.',
        'form' => [
            'name' => [
                'label' => 'Nome da chave de acesso',
                'placeholder' => 'p. ex. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opcional. Deixe em branco para a nomear de acordo com o seu dispositivo ou gestor de palavras-passe.',
                'default' => 'Chave de acesso',
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
        'already_registered' => [
            'title' => 'Este dispositivo já tem uma chave de acesso',
            'body' => 'Já existe uma chave de acesso da sua conta guardada neste dispositivo ou gestor de palavras-passe. Adicione uma a partir de outro dispositivo.',
        ],
    ],
];
