<?php

return [
    'label' => 'Configurar',
    'modal' => [
        'heading' => 'Configurar la verificación con llave de acceso',
        'description' => 'Registre una llave de acceso en este dispositivo. Se le pedirá que use su huella digital, su rostro, el bloqueo de pantalla o una llave de seguridad. Después del registro, podrá iniciar sesión con esta llave de acceso.',
        'form' => [
            'name' => [
                'label' => 'Nombre de la llave de acceso',
                'placeholder' => 'p. ej., MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Registrar llave de acceso',
            ],
            'errors' => [
                'failed' => 'No se pudo registrar su llave de acceso. Inténtelo de nuevo.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Llave de acceso registrada correctamente',
        ],
    ],
];
