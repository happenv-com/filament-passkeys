<?php

return [
    'label' => 'I-set up',
    'add_label' => 'Magdagdag ng passkey',
    'modal' => [
        'heading' => 'I-set up ang pag-verify gamit ang passkey',
        'add_heading' => 'Magdagdag ng passkey',
        'description' => 'Mag-register ng passkey sa device na ito. Hihilingin sa iyong gamitin ang fingerprint, mukha, screen lock, o security key mo. Pagkatapos mag-register, makakapag-sign in ka na gamit ang passkey na ito.',
        'form' => [
            'name' => [
                'label' => 'Pangalan ng passkey',
                'placeholder' => 'hal. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Opsyonal. Iwanang blangko para pangalanan ito ayon sa iyong device o password manager.',
                'default' => 'Passkey',
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
        'already_registered' => [
            'title' => 'May passkey na ang device na ito',
            'body' => 'May naka-store nang passkey para sa account mo sa device na ito o password manager. Magdagdag na lang ng isa mula sa ibang device.',
        ],
    ],
];
