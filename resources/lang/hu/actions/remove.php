<?php

return [
    'label' => 'Eltávolítás',
    'modal' => [
        'heading' => '":name" azonosítókulcs eltávolítása',
        'description' => 'Ezzel az azonosítókulccsal többé nem tudsz bejelentkezni. A többi azonosítókulcsod továbbra is működik.',
        'description_last' => 'Ez az utolsó azonosítókulcsod. Eltávolítása kikapcsolja az azonosítókulcsos ellenőrzést, ami eltávolít egy extra biztonsági réteget a fiókodból.',
        'actions' => [
            'submit' => [
                'label' => 'Azonosítókulcs eltávolítása',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Azonosítókulcs eltávolítva',
        ],
    ],
];
