<?php

return [
    'label' => 'Weka',
    'modal' => [
        'heading' => 'Weka uthibitishaji wa passkey',
        'description' => 'Sajili passkey kwenye kifaa hiki. Utaombwa kutumia alama ya kidole, uso, kifungio cha skrini, au ufunguo wa usalama. Baada ya usajili, utaweza kuingia kwa kutumia passkey hii.',
        'form' => [
            'name' => [
                'label' => 'Jina la passkey',
                'placeholder' => 'k.m. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Sajili passkey',
            ],
            'errors' => [
                'failed' => 'Hatukuweza kusajili passkey yako. Tafadhali jaribu tena.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Passkey imesajiliwa kikamilifu',
        ],
    ],
];
