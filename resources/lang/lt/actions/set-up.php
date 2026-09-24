<?php

return [
    'label' => 'Nustatyti',
    'add_label' => 'Pridėti slaptaraktį',
    'modal' => [
        'heading' => 'Nustatyti patvirtinimą slaptaraktiu',
        'add_heading' => 'Pridėti slaptaraktį',
        'description' => 'Užregistruokite slaptaraktį šiame įrenginyje. Jūsų bus paprašyta naudoti piršto atspaudą, veidą, ekrano užraktą arba saugos raktą. Užregistravę galėsite prisijungti naudodami šį slaptaraktį.',
        'form' => [
            'name' => [
                'label' => 'Slaptarakčio pavadinimas',
                'placeholder' => 'pvz., MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Neprivaloma. Palikite tuščią, kad jis būtų pavadintas pagal jūsų įrenginį arba slaptažodžių tvarkyklę.',
                'default' => 'Slaptaraktis',
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
        'already_registered' => [
            'title' => 'Šiame įrenginyje jau yra slaptaraktis',
            'body' => 'Jūsų paskyros slaptaraktis jau saugomas šiame įrenginyje arba slaptažodžių tvarkyklėje. Vietoj to pridėkite jį iš kito įrenginio.',
        ],
    ],
];
