<?php

return [
    'label' => 'Ukloni',
    'modal' => [
        'heading' => 'Ukloni pristupni ključ ":name"',
        'description' => 'Više se nećete moći prijaviti ovim pristupnim ključem. Vaši ostali pristupni ključevi i dalje rade.',
        'description_last' => 'Ovo je vaš posljednji pristupni ključ. Njegovim uklanjanjem isključuje se provjera pristupnim ključem, čime se s vašeg računa uklanja dodatni sloj sigurnosti.',
        'actions' => [
            'submit' => [
                'label' => 'Ukloni pristupni ključ',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Pristupni ključ je uklonjen',
        ],
    ],
];
