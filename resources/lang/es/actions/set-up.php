<?php

return [
    'label' => 'Set up',
    'modal' => [
        'heading' => 'Set up passkey verification',
        'description' => 'Register a passkey on this device. You will be asked to use your fingerprint, face, screen lock, or a security key. After registration, you will be able to sign in using this passkey.',
        'form' => [
            'name' => [
                'label' => 'Passkey name',
                'placeholder' => 'e.g. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Register passkey',
            ],
            'errors' => [
                'failed' => 'We could not register your passkey. Please try again.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Passkey registered successfully',
        ],
    ],
];
