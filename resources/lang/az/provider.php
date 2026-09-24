<?php

return [
    'management_schema' => [
        'actions' => [
            'label' => 'Giriş açarı ilə doğrulama',
            'below_content' => 'Giriş zamanı şəxsiyyətinizi təsdiqləmək üçün bu cihazda giriş açarından (Face ID, Touch ID, Windows Hello, Android, təhlükəsizlik açarı) istifadə edin. Daxil olduğunuz hər cihaz üçün bir dənə əlavə edin.',
            'messages' => [
                'enabled' => 'Aktivdir',
                'disabled' => 'Deaktivdir',
            ],
        ],
        'passkeys' => [
            'columns' => [
                'name' => 'Giriş açarı',
                'last_used_at' => 'Son istifadə',
                'actions' => 'Əməliyyatlar',
            ],
            'never_used' => 'Heç vaxt',
        ],
    ],
    'login_form' => [
        'label' => 'Giriş açarından istifadə edin',
        'credential' => [
            'label' => 'giriş açarı',
            'messages' => [
                'invalid' => 'Giriş açarını doğrulamaq mümkün olmadı. Zəhmət olmasa, yenidən cəhd edin.',
            ],
        ],
        'actions' => [
            'verify' => [
                'label' => 'Giriş açarı ilə doğrulayın',
            ],
        ],
    ],
];
