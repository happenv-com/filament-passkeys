<?php

return [
    'label' => 'Фаъол кардан',
    'add_label' => 'Илова кардани passkey',
    'modal' => [
        'heading' => 'Танзим кардани тасдиқ бо passkey',
        'add_heading' => 'Илова кардани passkey',
        'description' => 'Дар ин дастгоҳ passkey сабт кунед. Аз шумо хоҳиш карда мешавад, ки изи ангушт, чеҳра, қулфи экран ё калиди амниятиро истифода баред. Пас аз сабт шумо метавонед бо ин passkey ворид шавед.',
        'form' => [
            'name' => [
                'label' => 'Номи passkey',
                'placeholder' => 'масалан, MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Ихтиёрӣ. Барои номгузорӣ бо номи дастгоҳ ё менеҷери парол холӣ гузоред.',
                'default' => 'Passkey',
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
        'already_registered' => [
            'title' => 'Ин дастгоҳ аллакай passkey дорад',
            'body' => 'Passkey барои ҳисоби шумо аллакай дар ин дастгоҳ ё менеҷери парол захира шудааст. Ба ҷои он аз дастгоҳи дигар илова кунед.',
        ],
    ],
];
