<?php

return [
    'label' => 'Remove',
    'modal' => [
        'heading' => 'Remove passkey ":name"',
        'description' => 'You will no longer be able to sign in with this passkey. Your other passkeys keep working.',
        'description_last' => 'This is your last passkey. Removing it turns passkey verification off, which removes an extra layer of security from your account.',
        'actions' => [
            'submit' => [
                'label' => 'Remove passkey',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Passkey removed',
        ],
    ],
];
