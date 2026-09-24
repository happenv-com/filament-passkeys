<?php

return [
    'label' => 'Fjern',
    'modal' => [
        'heading' => 'Fjern adgangsnøglen ":name"',
        'description' => 'Du vil ikke længere kunne logge ind med denne adgangsnøgle. Dine øvrige adgangsnøgler fortsætter med at virke.',
        'description_last' => 'Dette er din sidste adgangsnøgle. Hvis du fjerner den, slås bekræftelse med adgangsnøgle fra, hvilket fjerner et ekstra sikkerhedslag fra din konto.',
        'actions' => [
            'submit' => [
                'label' => 'Fjern adgangsnøgle',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Adgangsnøgle fjernet',
        ],
    ],
];
