<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Patvirtinimas slaptarakčiu',
            'below_content' => 'Naudokite slaptaraktį (Face ID, Touch ID, Windows Hello, Android, saugos raktą), kad prisijungdami patvirtintumėte savo tapatybę. Pridėkite po vieną kiekvienam įrenginiui, iš kurio prisijungiate.',
            'messages' => [
                'enabled' => 'Įjungta',
                'disabled' => 'Išjungta',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Slaptaraktis',
                'last_used_at' => 'Paskutinį kartą naudotas',
                'actions' => 'Veiksmai',
            ],
            'never_used' => 'Niekada',
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
                'label' => 'Patvirtinti slaptarakčiu',
            ],
        ],
    ],
];
