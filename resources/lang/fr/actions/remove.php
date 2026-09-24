<?php

return [
    'label' => 'Supprimer',
    'modal' => [
        'heading' => 'Supprimer la clé d\'accès ":name"',
        'description' => 'Vous ne pourrez plus vous connecter avec cette clé d\'accès. Vos autres clés d\'accès continueront de fonctionner.',
        'description_last' => 'Il s\'agit de votre dernière clé d\'accès. La supprimer désactivera la vérification par clé d\'accès, ce qui retirera une couche de sécurité supplémentaire de votre compte.',
        'actions' => [
            'submit' => [
                'label' => 'Supprimer la clé d\'accès',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Clé d\'accès supprimée',
        ],
    ],
];
