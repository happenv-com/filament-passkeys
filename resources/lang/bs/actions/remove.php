<?php

return [
    'label' => 'Ukloni',
    'modal' => [
        'heading' => 'Uklonite pristupni ključ ":name"',
        'description' => 'Više nećete moći da se prijavite ovim pristupnim ključem. Vaši ostali pristupni ključevi i dalje rade.',
        'description_last' => 'Ovo je vaš posljednji pristupni ključ. Njegovim uklanjanjem isključujete verifikaciju pristupnim ključem, čime se uklanja dodatni sloj sigurnosti sa vašeg računa.',
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
