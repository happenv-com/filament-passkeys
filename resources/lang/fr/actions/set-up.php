<?php

return [
    'label' => 'Configurer',
    'modal' => [
        'heading' => 'Configurer la vérification par clé d\'accès',
        'description' => 'Enregistrez une clé d\'accès sur cet appareil. Il vous sera demandé d\'utiliser votre empreinte digitale, votre visage, le verrouillage de l\'écran ou une clé de sécurité. Après l\'enregistrement, vous pourrez vous connecter avec cette clé d\'accès.',
        'form' => [
            'name' => [
                'label' => 'Nom de la clé d\'accès',
                'placeholder' => 'p. ex. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Enregistrer la clé d\'accès',
            ],
            'errors' => [
                'failed' => 'Nous n\'avons pas pu enregistrer votre clé d\'accès. Veuillez réessayer.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Clé d\'accès enregistrée avec succès',
        ],
    ],
];
