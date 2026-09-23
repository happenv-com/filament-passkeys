<?php

return [
    'label' => 'Set up',
    'modal' => [
        'heading' => 'Passkey verification siamna',
        'description' => 'He device-ah hian passkey register rawh. Fingerprint, hmai, screen lock emaw security key hman turin an zawt ang che. Register zawh hnuah he passkey hmang hian i lut thei ang.',
        'form' => [
            'name' => [
                'label' => 'Passkey hming',
                'placeholder' => 'entirnan MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Passkey register rawh',
            ],
            'errors' => [
                'failed' => 'I passkey kan register thei lo. Khawngaihin ti nawn leh rawh.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Passkey register a ni ta',
        ],
    ],
];
