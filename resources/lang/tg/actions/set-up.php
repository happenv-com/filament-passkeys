<?php

return [
    'label' => 'Фаъол кардан',
    'modal' => [
        'heading' => 'Танзим кардани тасдиқ бо passkey',
        'description' => 'Дар ин дастгоҳ passkey сабт кунед. Аз шумо хоҳиш карда мешавад, ки изи ангушт, чеҳра, қулфи экран ё калиди амниятиро истифода баред. Пас аз сабт шумо метавонед бо ин passkey ворид шавед.',
        'form' => [
            'name' => [
                'label' => 'Номи passkey',
                'placeholder' => 'масалан, MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Сабт кардани passkey',
            ],
            'errors' => [
                'failed' => 'Мо passkey-и шуморо сабт карда натавонистем. Лутфан бори дигар кӯшиш кунед.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Passkey бомуваффақият сабт шуд',
        ],
    ],
];
