<?php

return [
    'label' => 'Odebrat',
    'modal' => [
        'heading' => 'Odebrat přístupový klíč ":name"',
        'description' => 'Pomocí tohoto přístupového klíče se už nebudete moci přihlásit. Vaše ostatní přístupové klíče budou nadále fungovat.',
        'description_last' => 'Toto je váš poslední přístupový klíč. Jeho odebráním se vypne ověření přístupovým klíčem, což z vašeho účtu odstraní další vrstvu zabezpečení.',
        'actions' => [
            'submit' => [
                'label' => 'Odebrat přístupový klíč',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Přístupový klíč odebrán',
        ],
    ],
];
