<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Azonosítókulcsos ellenőrzés',
            'below_content' => 'Használj azonosítókulcsot ezen az eszközön (Face ID, Touch ID, Windows Hello, Android, biztonsági kulcs) a személyazonosságod igazolásához bejelentkezéskor. Adj hozzá egyet minden eszközhöz, amelyről bejelentkezel.',
            'messages' => [
                'enabled' => 'Bekapcsolva',
                'disabled' => 'Kikapcsolva',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Azonosítókulcs',
                'last_used_at' => 'Utoljára használva',
                'actions' => 'Műveletek',
            ],
            'never_used' => 'Soha',
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
