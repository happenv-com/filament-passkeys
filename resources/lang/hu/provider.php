<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Azonosítókulcsos ellenőrzés',
            'below_content' => 'Használj azonosítókulcsot ezen az eszközön (Face ID, Touch ID, Windows Hello, biztonsági kulcs) a személyazonosságod igazolásához bejelentkezéskor.',
            'messages' => [
                'enabled' => 'Bekapcsolva',
                'disabled' => 'Kikapcsolva',
            ],
        ],
    ],
    'login_form' => [
        'label' => 'Használj azonosítókulcsot',
        'credential' => [
            'label' => 'azonosítókulcs',
            'messages' => [
                'invalid' => 'Az azonosítókulcsot nem sikerült ellenőrizni. Próbáld újra.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Ellenőrzés azonosítókulccsal',
            ],
        ],
    ],
];
