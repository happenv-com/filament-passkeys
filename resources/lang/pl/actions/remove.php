<?php

return [
    'label' => 'Usuń',
    'modal' => [
        'heading' => 'Usuń klucz dostępu ":name"',
        'description' => 'Nie będziesz już mógł zalogować się tym kluczem dostępu. Twoje pozostałe klucze dostępu nadal będą działać.',
        'description_last' => 'To Twój ostatni klucz dostępu. Jego usunięcie wyłączy weryfikację kluczem dostępu, co usunie dodatkową warstwę zabezpieczeń z Twojego konta.',
        'actions' => [
            'submit' => [
                'label' => 'Usuń klucz dostępu',
            ],
        ],
    ],
    'notifications' => [
        'removed' => [
            'title' => 'Klucz dostępu został usunięty',
        ],
    ],
];
