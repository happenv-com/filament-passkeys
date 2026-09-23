<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Patvirtinimas slaptaraktiu',
            'below_content' => 'Naudokite šio įrenginio slaptaraktį (Face ID, Touch ID, Windows Hello, saugos raktą), kad prisijungdami patvirtintumėte savo tapatybę.',
            'messages' => [
                'enabled' => 'Įjungta',
                'disabled' => 'Išjungta',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Naudoti slaptaraktį',
        'credential' => [
            'label' => 'slaptaraktis',
            'messages' => [
                'invalid' => 'Nepavyko patvirtinti slaptarakčio. Bandykite dar kartą.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Patvirtinti slaptaraktiu',
            ],
        ],
    ],
];
