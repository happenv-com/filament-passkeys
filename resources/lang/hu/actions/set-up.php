<?php

return [
    'label' => 'Bekapcsolás',
    'modal' => [
        'heading' => 'Azonosítókulcsos ellenőrzés bekapcsolása',
        'description' => 'Regisztrálj egy azonosítókulcsot ezen az eszközön. A rendszer az ujjlenyomatod, az arcod, a képernyőzár vagy egy biztonsági kulcs használatát fogja kérni. A regisztráció után ezzel az azonosítókulccsal is bejelentkezhetsz.',
        'form' => [
            'name' => [
                'label' => 'Azonosítókulcs neve',
                'placeholder' => 'pl. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Azonosítókulcs regisztrálása',
            ],
            'errors' => [
                'failed' => 'Nem sikerült regisztrálni az azonosítókulcsodat. Próbáld újra.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Az azonosítókulcs sikeresen regisztrálva',
        ],
    ],
];
