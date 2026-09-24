<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificación con llave de acceso',
            'below_content' => 'Utilice una llave de acceso (Face ID, Touch ID, Windows Hello, Android, llave de seguridad) para verificar su identidad durante el inicio de sesión. Añada una por cada dispositivo desde el que inicie sesión.',
            'messages' => [
                'enabled' => 'Habilitada',
                'disabled' => 'Deshabilitada',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Llave de acceso',
                'last_used_at' => 'Último uso',
                'actions' => 'Acciones',
            ],
            'never_used' => 'Nunca',
        ],
    ],
    'login_form' => [
        'label' => 'Use una llave de acceso',
        'credential' => [
            'label' => 'llave de acceso',
            'messages' => [
                'invalid' => 'No se pudo verificar la llave de acceso. Inténtelo de nuevo.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Verificar con llave de acceso',
            ],
        ],
    ],
];
