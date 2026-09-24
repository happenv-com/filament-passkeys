<?php

return [
    'label' => 'Weka',
    'add_label' => 'Ongeza passkey',
    'modal' => [
        'heading' => 'Weka uthibitishaji wa passkey',
        'add_heading' => 'Ongeza passkey',
        'description' => 'Sajili passkey kwenye kifaa hiki. Utaombwa kutumia alama ya kidole, uso, kifungio cha skrini, au ufunguo wa usalama. Baada ya usajili, utaweza kuingia kwa kutumia passkey hii.',
        'form' => [
            'name' => [
                'label' => 'Jina la passkey',
                'placeholder' => 'k.m. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Hiari. Acha wazi ili iitwe kwa jina la kifaa chako au kidhibiti cha nywila.',
                'default' => 'Passkey',
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
        'already_registered' => [
            'title' => 'Kifaa hiki tayari kina passkey',
            'body' => 'Passkey ya akaunti yako tayari imehifadhiwa kwenye kifaa hiki au kidhibiti cha nywila. Badala yake, ongeza moja kutoka kwa kifaa kingine.',
        ],
    ],
];
