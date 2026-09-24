<?php

return [
    'label' => 'Set up',
    'add_label' => 'Add passkey',
    'modal' => [
        'heading' => 'Set up passkey verification',
        'add_heading' => 'Add a passkey',
        'description' => 'Register a passkey on this device. You will be asked to use your fingerprint, face, screen lock, or a security key. After registration, you will be able to sign in using this passkey.',
        'form' => [
            'name' => [
                'label' => 'Passkey name',
                'placeholder' => 'e.g. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Optional. Leave empty to name it after your device or password manager.',
                'default' => 'Passkey',
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
        'already_registered' => [
            'title' => 'This device already has a passkey',
            'body' => 'A passkey for your account is already stored on this device or password manager. Add one from another device instead.',
        ],
    ],
];
