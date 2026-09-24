<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Weryfikacja kluczem dostępu',
            'below_content' => 'Używaj klucza dostępu (Face ID, Touch ID, Windows Hello, Android, klucz bezpieczeństwa), aby potwierdzić swoją tożsamość podczas logowania. Dodaj po jednym dla każdego urządzenia, z którego się logujesz.',
            'messages' => [
                'enabled' => 'Włączona',
                'disabled' => 'Wyłączona',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Klucz dostępu',
                'last_used_at' => 'Ostatnio użyty',
                'actions' => 'Akcje',
            ],
            'never_used' => 'Nigdy',
        ],
    ],
    'login_form' => [
        'label' => 'Użyj klucza dostępu',
        'credential' => [
            'label' => 'klucz dostępu',
            'messages' => [
                'invalid' => 'Nie udało się zweryfikować klucza dostępu. Spróbuj ponownie.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Zweryfikuj kluczem dostępu',
            ],
        ],
    ],
];
