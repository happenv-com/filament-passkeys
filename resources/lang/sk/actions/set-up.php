<?php

return [
    'label' => 'Nastaviť',
    'modal' => [
        'heading' => 'Nastaviť overenie prístupovým kľúčom',
        'description' => 'Zaregistrujte prístupový kľúč v tomto zariadení. Budete požiadaní o použitie odtlačku prsta, tváre, zámky obrazovky alebo bezpečnostného kľúča. Po registrácii sa budete môcť prihlasovať pomocou tohto prístupového kľúča.',
        'form' => [
            'name' => [
                'label' => 'Názov prístupového kľúča',
                'placeholder' => 'napr. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Zaregistrovať prístupový kľúč',
            ],
            'errors' => [
                'failed' => 'Prístupový kľúč sa nepodarilo zaregistrovať. Skúste to znova.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Prístupový kľúč bol úspešne zaregistrovaný',
        ],
    ],
];
