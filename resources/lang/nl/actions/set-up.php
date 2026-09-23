<?php

return [
    'label' => 'Instellen',
    'modal' => [
        'heading' => 'Verificatie met toegangssleutel instellen',
        'description' => 'Registreer een toegangssleutel op dit apparaat. Je wordt gevraagd je vingerafdruk, gezicht, schermvergrendeling of een beveiligingssleutel te gebruiken. Na de registratie kun je inloggen met deze toegangssleutel.',
        'form' => [
            'name' => [
                'label' => 'Naam van de toegangssleutel',
                'placeholder' => 'bijv. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Toegangssleutel registreren',
            ],
            'errors' => [
                'failed' => 'We konden je toegangssleutel niet registreren. Probeer het opnieuw.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Toegangssleutel is geregistreerd',
        ],
    ],
];
