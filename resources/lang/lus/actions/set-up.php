<?php

return [
    'label' => 'Set up',
    'add_label' => 'Add passkey',
    'modal' => [
        'heading' => 'Passkey verification siamna',
        'add_heading' => 'Passkey belh',
        'description' => 'He device-ah hian passkey register rawh. Fingerprint, hmai, screen lock emaw security key hman turin an zawt ang che. Register zawh hnuah he passkey hmang hian i lut thei ang.',
        'form' => [
            'name' => [
                'label' => 'Passkey hming',
                'placeholder' => 'entirnan MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Duh a duh a ni. Chhuah loh pawhin, i device emaw password manager hming hi hmang vek ang.',
                'default' => 'Passkey',
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
        'already_registered' => [
            'title' => 'He device hian passkey a nei tawh',
            'body' => 'I account atan passkey chu he device emaw password manager-ah hian a dah tawh a ni. Device dang atangin belh zawk rawh.',
        ],
    ],
];
