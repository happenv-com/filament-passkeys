<?php

return [
    'label' => 'I-set up',
    'modal' => [
        'heading' => 'I-set up ang pag-verify gamit ang passkey',
        'description' => 'Mag-register ng passkey sa device na ito. Hihilingin sa iyong gamitin ang fingerprint, mukha, screen lock, o security key mo. Pagkatapos mag-register, makakapag-sign in ka na gamit ang passkey na ito.',
        'form' => [
            'name' => [
                'label' => 'Pangalan ng passkey',
                'placeholder' => 'hal. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'I-register ang passkey',
            ],
            'errors' => [
                'failed' => 'Hindi namin ma-register ang passkey mo. Pakisubukan ulit.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Matagumpay na na-register ang passkey',
        ],
    ],
];
