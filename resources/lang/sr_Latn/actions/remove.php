<?php

return [
    'label' => 'Ukloni',
    'modal' => [
        'heading' => 'Ukloni pristupni ključ ":name"',
        'description' => 'Više nećete moći da se prijavite ovim pristupnim ključem. Vaši ostali pristupni ključevi će i dalje raditi.',
        'description_last' => 'Ovo je vaš poslednji pristupni ključ. Uklanjanjem se isključuje verifikacija pristupnim ključem, čime se uklanja dodatni sloj bezbednosti sa vašeg naloga.',
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
