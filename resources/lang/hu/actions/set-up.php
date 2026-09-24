<?php

return [
    'label' => 'Bekapcsolás',
    'add_label' => 'Azonosítókulcs hozzáadása',
    'modal' => [
        'heading' => 'Azonosítókulcsos ellenőrzés bekapcsolása',
        'add_heading' => 'Azonosítókulcs hozzáadása',
        'description' => 'Regisztrálj egy azonosítókulcsot ezen az eszközön. A rendszer az ujjlenyomatod, az arcod, a képernyőzár vagy egy biztonsági kulcs használatát fogja kérni. A regisztráció után ezzel az azonosítókulccsal is bejelentkezhetsz.',
        'form' => [
            'name' => [
                'label' => 'Azonosítókulcs neve',
                'placeholder' => 'pl. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Nem kötelező. Hagyd üresen, hogy az eszközöd vagy jelszókezelőd neve alapján nevezze el.',
                'default' => 'Azonosítókulcs',
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
        'already_registered' => [
            'title' => 'Ezen az eszközön már van azonosítókulcs',
            'body' => 'A fiókodhoz tartozó azonosítókulcs már el van tárolva ezen az eszközön vagy jelszókezelőben. Adj hozzá egyet egy másik eszközről.',
        ],
    ],
];
