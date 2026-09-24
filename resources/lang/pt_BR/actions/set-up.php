<?php

return [
    'label' => 'Configurar',
    'add_label' => 'Adicionar passkey',
    'modal' => [
        'heading' => 'Configurar verificação por passkey',
        'add_heading' => 'Adicionar uma passkey',
        'description' => 'Registre uma passkey neste dispositivo. Você será solicitado a usar sua digital, rosto, bloqueio de tela ou uma chave de segurança. Após o registro, você poderá entrar usando essa passkey.',
        'form' => [
            'name' => [
                'label' => 'Nome da passkey',
                'placeholder' => 'ex.: MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opcional. Deixe em branco para nomeá-la com base no seu dispositivo ou gerenciador de senhas.',
                'default' => 'Passkey',
            ],
            'submit' => [
                'label' => 'Registrar passkey',
            ],
            'errors' => [
                'failed' => 'Não foi possível registrar sua passkey. Tente novamente.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Passkey registrada com sucesso',
        ],
        'already_registered' => [
            'title' => 'Este dispositivo já tem uma passkey',
            'body' => 'Uma passkey da sua conta já está armazenada neste dispositivo ou gerenciador de senhas. Em vez disso, adicione uma a partir de outro dispositivo.',
        ],
    ],
];
