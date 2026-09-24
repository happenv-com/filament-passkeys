<?php

return [
    'label' => 'Instellen',
    'add_label' => 'Toegangssleutel toevoegen',
    'modal' => [
        'heading' => 'Verificatie met toegangssleutel instellen',
        'add_heading' => 'Een toegangssleutel toevoegen',
        'description' => 'Registreer een toegangssleutel op dit apparaat. Je wordt gevraagd je vingerafdruk, gezicht, schermvergrendeling of een beveiligingssleutel te gebruiken. Na de registratie kun je inloggen met deze toegangssleutel.',
        'form' => [
            'name' => [
                'label' => 'Naam van de toegangssleutel',
                'placeholder' => 'bijv. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Optioneel. Laat dit leeg om de naam van je apparaat of wachtwoordmanager te gebruiken.',
                'default' => 'Toegangssleutel',
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
        'already_registered' => [
            'title' => 'Dit apparaat heeft al een toegangssleutel',
            'body' => 'Er is al een toegangssleutel voor je account opgeslagen op dit apparaat of in je wachtwoordmanager. Voeg er in plaats daarvan een toe vanaf een ander apparaat.',
        ],
    ],
];
