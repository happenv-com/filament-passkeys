<?php

return [
    'label' => 'Skonfiguruj',
    'modal' => [
        'heading' => 'Skonfiguruj weryfikację kluczem dostępu',
        'description' => 'Zarejestruj klucz dostępu na tym urządzeniu. Zostaniesz poproszony o użycie odcisku palca, rozpoznawania twarzy, blokady ekranu lub klucza bezpieczeństwa. Po rejestracji będziesz mógł logować się tym kluczem dostępu.',
        'form' => [
            'name' => [
                'label' => 'Nazwa klucza dostępu',
                'placeholder' => 'np. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Zarejestruj klucz dostępu',
                'loading_label' => 'Oczekiwanie na urządzenie...',
            ],
            'errors' => [
                'failed' => 'Nie udało się zarejestrować klucza dostępu. Spróbuj ponownie.',
            ],
        ],
        'actions' => [
            'cancel' => [
                'label' => 'Zamknij',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Klucz dostępu został zarejestrowany',
        ],
    ],
];
