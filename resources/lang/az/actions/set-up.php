<?php

return [
    'label' => 'Quraşdır',
    'modal' => [
        'heading' => 'Giriş açarı ilə doğrulamanı quraşdırın',
        'description' => 'Bu cihazda giriş açarını qeydiyyatdan keçirin. Sizdən barmaq izinizi, üzünüzü, ekran kilidini və ya təhlükəsizlik açarını istifadə etməyiniz istəniləcək. Qeydiyyatdan sonra bu giriş açarı ilə daxil ola biləcəksiniz.',
        'form' => [
            'name' => [
                'label' => 'Giriş açarının adı',
                'placeholder' => 'məs. MacBook Touch ID, YubiKey 5C',
            ],
            'submit' => [
                'label' => 'Giriş açarını qeydiyyatdan keçirin',
            ],
            'errors' => [
                'failed' => 'Giriş açarınızı qeydiyyatdan keçirmək mümkün olmadı. Zəhmət olmasa, yenidən cəhd edin.',
            ],
        ],
    ],
    'notifications' => [
        'enabled' => [
            'title' => 'Giriş açarı uğurla qeydiyyatdan keçirildi',
        ],
    ],
];
