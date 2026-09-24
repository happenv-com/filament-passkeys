<?php

return [
    'label' => 'Eliminar',
    'modal' => [
        'heading' => 'Eliminar la llave de acceso ":name"',
        'description' => 'Ya no podrá iniciar sesión con esta llave de acceso. Sus otras llaves de acceso seguirán funcionando.',
        'description_last' => 'Esta es su última llave de acceso. Eliminarla desactiva la verificación con llave de acceso, lo que elimina una capa adicional de seguridad de su cuenta.',
        'actions' => [
            'submit' => [
                'label' => 'Eliminar llave de acceso',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Llave de acceso eliminada',
        ],
    ],
];
