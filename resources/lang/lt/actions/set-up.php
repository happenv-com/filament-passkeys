<?php

return [
    'label' => 'Nustatyti',
    'modal' => [
        'heading' => 'Nustatyti patvirtinimą slaptaraktiu',
        'description' => 'Užregistruokite slaptaraktį šiame įrenginyje. Jūsų bus paprašyta naudoti piršto atspaudą, veidą, ekrano užraktą arba saugos raktą. Užregistravę galėsite prisijungti naudodami šį slaptaraktį.',
        'form' => [
            'name' => [
                'label' => 'Slaptarakčio pavadinimas',
                'placeholder' => 'pvz., MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Užregistruoti slaptaraktį',
            ],
            'errors' => [
                'failed' => 'Nepavyko užregistruoti jūsų slaptarakčio. Bandykite dar kartą.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Slaptaraktis sėkmingai užregistruotas',
        ],
    ],
];
