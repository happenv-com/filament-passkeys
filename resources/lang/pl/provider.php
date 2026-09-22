<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Weryfikacja kluczem dostępu',
            'below_content' => 'Używaj klucza dostępu na tym urządzeniu (Face ID, Touch ID, Windows Hello, klucz bezpieczeństwa), aby potwierdzić swoją tożsamość podczas logowania.',
            'messages' => [
                'enabled' => 'Włączona',
                'disabled' => 'Wyłączona',
            ],
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
