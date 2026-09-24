<?php

return [
    'label' => 'Ta bort',
    'modal' => [
        'heading' => 'Ta bort lösennyckel ":name"',
        'description' => 'Du kommer inte längre att kunna logga in med den här lösennyckeln. Dina andra lösennycklar fortsätter att fungera.',
        'description_last' => 'Det här är din sista lösennyckel. Om du tar bort den inaktiveras verifiering med lösennyckel, vilket tar bort ett extra säkerhetslager från ditt konto.',
        'actions' => [
            'submit' => [
                'label' => 'Ta bort lösennyckel',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Lösennyckeln har tagits bort',
        ],
    ],
];
