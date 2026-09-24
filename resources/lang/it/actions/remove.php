<?php

return [
    'label' => 'Rimuovi',
    'modal' => [
        'heading' => 'Rimuovi la passkey ":name"',
        'description' => 'Non potrai più accedere con questa passkey. Le tue altre passkey continueranno a funzionare.',
        'description_last' => 'Questa è la tua ultima passkey. Rimuovendola disattiverai la verifica tramite passkey, eliminando un ulteriore livello di sicurezza dal tuo account.',
        'actions' => [
            'submit' => [
                'label' => 'Rimuovi passkey',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Passkey rimossa',
        ],
    ],
];
