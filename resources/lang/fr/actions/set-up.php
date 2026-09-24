<?php

return [
    'label' => 'Configurer',
    'add_label' => 'Ajouter une clé d\'accès',
    'modal' => [
        'heading' => 'Configurer la vérification par clé d\'accès',
        'add_heading' => 'Ajouter une clé d\'accès',
        'description' => 'Enregistrez une clé d\'accès sur cet appareil. Il vous sera demandé d\'utiliser votre empreinte digitale, votre visage, le verrouillage de l\'écran ou une clé de sécurité. Après l\'enregistrement, vous pourrez vous connecter avec cette clé d\'accès.',
        'form' => [
            'name' => [
                'label' => 'Nom de la clé d\'accès',
                'placeholder' => 'p. ex. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Facultatif. Laissez vide pour la nommer d\'après votre appareil ou votre gestionnaire de mots de passe.',
                'default' => 'Clé d\'accès',
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
        'already_registered' => [
            'title' => 'Cet appareil possède déjà une clé d\'accès',
            'body' => 'Une clé d\'accès pour votre compte est déjà enregistrée sur cet appareil ou dans ce gestionnaire de mots de passe. Ajoutez-en une depuis un autre appareil.',
        ],
    ],
];
