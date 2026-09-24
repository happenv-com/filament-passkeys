<?php

return [
    'label' => 'Nastaviť',
    'add_label' => 'Pridať prístupový kľúč',
    'modal' => [
        'heading' => 'Nastaviť overenie prístupovým kľúčom',
        'add_heading' => 'Pridať prístupový kľúč',
        'description' => 'Zaregistrujte prístupový kľúč v tomto zariadení. Budete požiadaní o použitie odtlačku prsta, tváre, zámky obrazovky alebo bezpečnostného kľúča. Po registrácii sa budete môcť prihlasovať pomocou tohto prístupového kľúča.',
        'form' => [
            'name' => [
                'label' => 'Názov prístupového kľúča',
                'placeholder' => 'napr. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Nepovinné. Ponechajte prázdne, ak ho chcete pomenovať podľa zariadenia alebo správcu hesiel.',
                'default' => 'Prístupový kľúč',
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
        'already_registered' => [
            'title' => 'Toto zariadenie už má prístupový kľúč',
            'body' => 'Prístupový kľúč pre váš účet je už uložený v tomto zariadení alebo správcovi hesiel. Namiesto toho pridajte ďalší z iného zariadenia.',
        ],
    ],
];
