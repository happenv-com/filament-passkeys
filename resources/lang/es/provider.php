<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Verificación con llave de acceso',
            'below_content' => 'Utilice una llave de acceso en este dispositivo (Face ID, Touch ID, Windows Hello, llave de seguridad) para verificar su identidad durante el inicio de sesión.',
            'messages' => [
                'enabled' => 'Habilitada',
                'disabled' => 'Deshabilitada',
            ],
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
