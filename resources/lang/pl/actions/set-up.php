<?php

return [
    'label' => 'Skonfiguruj',
    'add_label' => 'Dodaj klucz dostępu',
    'modal' => [
        'heading' => 'Skonfiguruj weryfikację kluczem dostępu',
        'add_heading' => 'Dodaj klucz dostępu',
        'description' => 'Zarejestruj klucz dostępu na tym urządzeniu. Zostaniesz poproszony o użycie odcisku palca, rozpoznawania twarzy, blokady ekranu lub klucza bezpieczeństwa. Po rejestracji będziesz mógł logować się tym kluczem dostępu.',
        'form' => [
            'name' => [
                'label' => 'Nazwa klucza dostępu',
                'placeholder' => 'np. MacBook Touch ID, YubiKey 5C',
                'helper_text' => 'Pole opcjonalne. Jeśli zostawisz je puste, klucz otrzyma nazwę urządzenia lub menedżera haseł.',
                'default' => 'Klucz dostępu',
            ],
            'submit' => [
                'label' => 'Zarejestruj klucz dostępu',
            ],
            'errors' => [
                'failed' => 'Nie udało się zarejestrować klucza dostępu. Spróbuj ponownie.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Klucz dostępu został zarejestrowany',
        ],
        'already_registered' => [
            'title' => 'To urządzenie ma już klucz dostępu',
            'body' => 'Klucz dostępu do Twojego konta jest już zapisany na tym urządzeniu lub w menedżerze haseł. Zamiast tego dodaj go z innego urządzenia.',
        ],
    ],
];
