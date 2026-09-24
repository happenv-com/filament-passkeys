<?php

return [
    'label' => 'Configurar',
    'add_label' => 'Añadir llave de acceso',
    'modal' => [
        'heading' => 'Configurar la verificación con llave de acceso',
        'add_heading' => 'Añadir una llave de acceso',
        'description' => 'Registre una llave de acceso en este dispositivo. Se le pedirá que use su huella digital, su rostro, el bloqueo de pantalla o una llave de seguridad. Después del registro, podrá iniciar sesión con esta llave de acceso.',
        'form' => [
            'name' => [
                'label' => 'Nombre de la llave de acceso',
                'placeholder' => 'p. ej., MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opcional. Déjelo vacío para nombrarla según su dispositivo o gestor de contraseñas.',
                'default' => 'Llave de acceso',
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
        'already_registered' => [
            'title' => 'Este dispositivo ya tiene una llave de acceso',
            'body' => 'Ya hay una llave de acceso de su cuenta almacenada en este dispositivo o gestor de contraseñas. Añada una desde otro dispositivo.',
        ],
    ],
];
